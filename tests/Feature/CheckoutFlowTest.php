<?php

use App\Models\Article;
use App\Models\Facture;

it('creates a paid invoice from the public checkout flow', function () {
    $article = Article::factory()->create([
        'name' => 'Produit checkout public',
        'est_visible' => true,
        'statut' => 'disponible',
        'prix' => 10000,
        'prix_promotionnel' => 8000,
        'quantite' => 5,
    ]);

    $this->post(route('cart.add', $article), [
        'quantity' => 2,
    ])->assertRedirect();

    $response = $this->post(route('checkout.store'), [
        'client_nom' => 'Client Public',
        'client_prenom' => 'Test',
        'client_email' => 'client@example.com',
        'client_telephone' => '+22677706991',
        'client_adresse' => 'Ouagadougou',
        'mode_paiement' => 'mobile_money',
    ]);

    $facture = Facture::query()->firstOrFail();

    $response->assertRedirect(route('checkout.success', $facture));

    $this->assertDatabaseHas('factures', [
        'client_nom' => 'Client Public',
        'statut_paiement' => Facture::STATUS_PAYEE,
        'mode_paiement' => 'mobile_money',
    ]);

    expect((float) $facture->montant_ht)->toBe(16000.0)
        ->and((float) $facture->montant_ttc)->toBe(18880.0)
        ->and($article->fresh()->quantite)->toBe(3)
        ->and(session('shop.cart'))->toBeNull();
});

