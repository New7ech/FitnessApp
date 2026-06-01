<?php

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Emplacement;
use App\Models\Facture;
use App\Models\Fournisseur;
use App\Models\User;

test('gestion dashboard renders', function () {
    $response = $this->get(route('accueil'));

    $response->assertOk()
        ->assertSee('Tableau de Bord');

    if (ob_get_level() > 0 && trim((string) ob_get_contents()) === '') {
        ob_end_clean();
    }
});

test('an authenticated user can create an article', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $categorie = Categorie::factory()->create();
    $fournisseur = Fournisseur::factory()->create();
    $emplacement = Emplacement::factory()->create();

    $response = $this->post(route('articles.store'), [
        'name' => 'Article test integration',
        'description' => 'Produit de verification.',
        'prix' => 12500,
        'quantite' => 8,
        'category_id' => $categorie->id,
        'fournisseur_id' => $fournisseur->id,
        'emplacement_id' => $emplacement->id,
    ]);

    $response->assertRedirect(route('articles.index'));

    $this->assertDatabaseHas('articles', [
        'name' => 'Article test integration',
        'created_by' => $user->id,
        'quantite' => 8,
    ]);
});

test('facture creation decrements stock and returns a pdf', function () {
    $user = User::factory()->create(['notifications_enabled' => true]);
    $this->actingAs($user);

    $article = Article::factory()->create([
        'name' => 'Produit facture',
        'prix' => 1000,
        'prix_promotionnel' => null,
        'quantite' => 10,
    ]);

    $response = $this->post(route('factures.store'), [
        'client_nom' => 'Client Facture',
        'client_email' => 'client-facture@example.com',
        'statut_paiement' => Facture::STATUS_IMPAYEE,
        'mode_paiement' => 'carte',
        'articles' => [
            ['article_id' => $article->id, 'quantity' => 3],
        ],
    ]);

    $response->assertOk();

    expect($article->fresh()->quantite)->toBe(7);

    $this->assertDatabaseHas('factures', [
        'client_nom' => 'Client Facture',
        'montant_ht' => 3000,
    ]);
});

test('permission names are normalized', function () {
    $response = $this->post(route('permissions.store'), [
        'name' => '  Articles Lire  ',
    ]);

    $response->assertRedirect(route('permissions.index'));

    $this->assertDatabaseHas('permissions', [
        'name' => 'articles-lire',
        'guard_name' => 'web',
    ]);
});
