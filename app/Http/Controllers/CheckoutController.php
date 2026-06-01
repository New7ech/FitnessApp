<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Services\CartService;
use App\Services\FactureService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CartService $cart,
        private readonly FactureService $factureService,
    ) {
    }

    public function show(): View|RedirectResponse
    {
        $summary = $this->cart->summary();

        if ($summary['items']->isEmpty()) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Votre panier est vide. Ajoutez un article avant de finaliser la commande.']);
        }

        return view('checkout.show', [
            'summary' => $summary,
            'cartCount' => $this->cart->count(),
            'paymentModes' => $this->paymentModes(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $summary = $this->cart->summary();

        if ($summary['items']->isEmpty()) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Votre panier est vide.']);
        }

        $validated = $request->validate([
            'client_nom' => ['required', 'string', 'max:255'],
            'client_prenom' => ['nullable', 'string', 'max:255'],
            'client_email' => ['nullable', 'email', 'max:255'],
            'client_telephone' => ['required', 'string', 'max:20'],
            'client_adresse' => ['required', 'string', 'max:255'],
            'mode_paiement' => ['required', Rule::in(Facture::PAYMENT_MODES)],
        ], [
            'client_nom.required' => 'Le nom du client est obligatoire.',
            'client_telephone.required' => 'Le telephone est obligatoire pour confirmer la commande.',
            'client_adresse.required' => 'L adresse de livraison est obligatoire.',
            'mode_paiement.required' => 'Choisissez un mode de paiement.',
            'mode_paiement.in' => 'Le mode de paiement selectionne est invalide.',
        ]);

        $paymentStatus = $this->isImmediatePayment($validated['mode_paiement'])
            ? Facture::STATUS_PAYEE
            : Facture::STATUS_IMPAYEE;

        try {
            $payload = $this->factureService->create([
                ...$validated,
                'statut_paiement' => $paymentStatus,
                'articles' => $summary['items']
                    ->map(fn (array $item): array => [
                        'article_id' => $item['article']->id,
                        'quantity' => $item['quantity'],
                    ])
                    ->values()
                    ->all(),
            ]);
        } catch (ValidationException $exception) {
            return redirect()->route('checkout.show')
                ->withInput()
                ->withErrors($exception->errors());
        } catch (Throwable) {
            return redirect()->route('checkout.show')
                ->withInput()
                ->withErrors(['checkout' => 'Impossible de finaliser la commande pour le moment.']);
        }

        $this->cart->clear();

        return redirect()->route('checkout.success', $payload['facture'])
            ->with('success', 'Commande finalisee. Votre facture est disponible en PDF.');
    }

    public function success(Facture $facture): View
    {
        $facture->load('articles');

        return view('checkout.success', [
            'facture' => $facture,
            'cartCount' => $this->cart->count(),
        ]);
    }

    public function pdf(Facture $facture)
    {
        $payload = $this->factureService->buildPdfPayload($facture);
        $fileName = 'Facture_' . ($payload['facture']->numero ?? $payload['facture']->id) . '.pdf';

        return Pdf::loadView('factures.pdf', $payload)->download($fileName);
    }

    private function isImmediatePayment(string $modePaiement): bool
    {
        return in_array($modePaiement, ['carte', 'mobile_money'], true);
    }

    /**
     * @return array<string, string>
     */
    private function paymentModes(): array
    {
        return [
            'mobile_money' => 'Mobile Money',
            'carte' => 'Carte bancaire',
            'espèces' => 'Paiement a la livraison',
            'virement' => 'Virement bancaire',
            'chèque' => 'Cheque',
        ];
    }
}

