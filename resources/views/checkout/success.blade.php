@extends('layouts.shop')

@section('title', 'Commande confirmee | Fitwinnie Store')

@section('content')
    <section class="shop-flow">
        <div class="flow-heading">
            <span>Commande confirmee</span>
            <h1>Facture {{ $facture->numero ?? $facture->id }}</h1>
            <p>La vente est enregistree, le stock a ete mis a jour et le PDF est disponible.</p>
        </div>

        <div class="success-panel">
            <div class="success-summary">
                <h2>Resume du paiement</h2>
                <dl>
                    <div>
                        <dt>Client</dt>
                        <dd>{{ $facture->client_nom }} {{ $facture->client_prenom }}</dd>
                    </div>
                    <div>
                        <dt>Statut</dt>
                        <dd>{{ ucfirst($facture->statut_paiement) }}</dd>
                    </div>
                    <div>
                        <dt>Mode</dt>
                        <dd>{{ $facture->mode_paiement ? ucfirst(str_replace('_', ' ', $facture->mode_paiement)) : 'Non renseigne' }}</dd>
                    </div>
                    <div class="summary-total">
                        <dt>Total TTC</dt>
                        <dd>{{ number_format((float) $facture->montant_ttc, 0, ',', ' ') }} FCFA</dd>
                    </div>
                </dl>
            </div>

            <div class="success-actions">
                <a class="button button-red" href="{{ route('checkout.pdf', $facture) }}">Telecharger la facture PDF</a>
                <a class="button button-muted" href="{{ route('home') }}">Retour au catalogue</a>
                <a class="summary-link" href="{{ route('factures.show', $facture) }}">Voir dans la gestion</a>
            </div>
        </div>
    </section>
@endsection

