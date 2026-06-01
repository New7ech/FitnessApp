@extends('layouts.shop')

@section('title', 'Paiement | Fitwinnie Store')

@section('content')
    <section class="shop-flow">
        <div class="flow-heading">
            <span>Etape 3</span>
            <h1>Finalisation du paiement</h1>
            <p>Renseignez le client, choisissez le paiement, puis confirmez. La commande creera automatiquement une facture.</p>
        </div>

        <div class="flow-grid">
            <form class="checkout-form" method="POST" action="{{ route('checkout.store') }}">
                @csrf

                <div class="checkout-section">
                    <h2>Informations client</h2>
                    <div class="form-grid">
                        <label>
                            <span>Nom complet</span>
                            <input type="text" name="client_nom" value="{{ old('client_nom') }}" autocomplete="name" required>
                        </label>

                        <label>
                            <span>Prenom</span>
                            <input type="text" name="client_prenom" value="{{ old('client_prenom') }}" autocomplete="given-name">
                        </label>

                        <label>
                            <span>Telephone</span>
                            <input type="tel" name="client_telephone" value="{{ old('client_telephone') }}" autocomplete="tel" required>
                        </label>

                        <label>
                            <span>Email</span>
                            <input type="email" name="client_email" value="{{ old('client_email') }}" autocomplete="email">
                        </label>
                    </div>

                    <label>
                        <span>Adresse de livraison</span>
                        <input type="text" name="client_adresse" value="{{ old('client_adresse') }}" autocomplete="street-address" required>
                    </label>
                </div>

                <div class="checkout-section">
                    <h2>Paiement</h2>
                    <div class="payment-options">
                        @foreach ($paymentModes as $value => $label)
                            <label class="payment-option">
                                <input type="radio" name="mode_paiement" value="{{ $value }}" @checked(old('mode_paiement', 'mobile_money') === $value) required>
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <p class="payment-note">Mobile Money et carte marquent la facture comme payee. Livraison, virement et cheque creent une facture impayee a regulariser.</p>
                </div>

                <div class="checkout-actions">
                    <a class="button button-muted" href="{{ route('cart.index') }}">Retour au panier</a>
                    <button class="button button-red" type="submit">Confirmer la commande</button>
                </div>
            </form>

            <aside class="order-summary">
                <h2>Commande</h2>
                <div class="summary-lines">
                    @foreach ($summary['items'] as $item)
                        <div>
                            <span>{{ $item['article']->name }} x {{ $item['quantity'] }}</span>
                            <strong>{{ number_format($item['line_total'], 0, ',', ' ') }} FCFA</strong>
                        </div>
                    @endforeach
                </div>
                <dl>
                    <div>
                        <dt>Sous-total</dt>
                        <dd>{{ number_format($summary['subtotal'], 0, ',', ' ') }} FCFA</dd>
                    </div>
                    <div>
                        <dt>TVA {{ number_format($summary['tax_rate'], 0) }}%</dt>
                        <dd>{{ number_format($summary['tax'], 0, ',', ' ') }} FCFA</dd>
                    </div>
                    <div class="summary-total">
                        <dt>Total a payer</dt>
                        <dd>{{ number_format($summary['total'], 0, ',', ' ') }} FCFA</dd>
                    </div>
                </dl>
            </aside>
        </div>
    </section>
@endsection

