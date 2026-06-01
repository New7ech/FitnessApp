@extends('layouts.shop')

@section('title', 'Panier | Fitwinnie Store')

@section('content')
    <section class="shop-flow">
        <div class="flow-heading">
            <span>Etape 2</span>
            <h1>Votre panier</h1>
            <p>Verifiez les articles, ajustez les quantites, puis passez au paiement.</p>
        </div>

        @if ($summary['items']->isEmpty())
            <div class="empty-cart">
                <h2>Votre panier est vide</h2>
                <p>Ajoutez un produit depuis le catalogue pour creer une facture apres paiement.</p>
                <a class="button button-red" href="{{ route('home') }}">Retour au catalogue</a>
            </div>
        @else
            <div class="flow-grid">
                <form class="cart-panel" method="POST" action="{{ route('cart.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="cart-lines">
                        @foreach ($summary['items'] as $item)
                            <article class="cart-line">
                                <img src="{{ $item['article']->image_url ?? 'https://images.unsplash.com/photo-1517963879433-6ad2b056d712?auto=format&fit=crop&w=700&q=80' }}" alt="{{ $item['article']->name }}">
                                <div>
                                    <h2>{{ $item['article']->name }}</h2>
                                    <p>{{ number_format($item['unit_price'], 0, ',', ' ') }} FCFA / unite</p>
                                    <small>Stock disponible : {{ $item['article']->quantite }}</small>
                                </div>
                                <label>
                                    <span>Quantite</span>
                                    <input type="number" name="quantities[{{ $item['article']->id }}]" min="0" max="{{ $item['article']->quantite }}" value="{{ $item['quantity'] }}">
                                    <small>0 retire la ligne</small>
                                </label>
                                <strong>{{ number_format($item['line_total'], 0, ',', ' ') }} FCFA</strong>
                            </article>
                        @endforeach
                    </div>

                    <div class="cart-actions">
                        <button class="button button-muted" type="submit">Mettre a jour</button>
                    </div>
                </form>

                <form class="cart-clear-form" method="POST" action="{{ route('cart.clear') }}">
                    @csrf
                    @method('DELETE')
                    <button class="button button-muted" type="submit">Vider le panier</button>
                </form>

                <aside class="order-summary">
                    <h2>Resume</h2>
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
                            <dt>Total</dt>
                            <dd>{{ number_format($summary['total'], 0, ',', ' ') }} FCFA</dd>
                        </div>
                    </dl>
                    <a class="button button-red" href="{{ route('checkout.show') }}">Finaliser le paiement</a>
                    <a class="summary-link" href="{{ route('home') }}">Continuer les achats</a>
                </aside>
            </div>
        @endif
    </section>
@endsection
