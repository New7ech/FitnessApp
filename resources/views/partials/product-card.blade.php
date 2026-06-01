@php
    $isArticle = $product instanceof \App\Models\Article;
    $productName = $isArticle ? $product->name : ($product['name'] ?? 'Produit');
    $productImage = $isArticle
        ? ($product->image_url ?? 'https://images.unsplash.com/photo-1517963879433-6ad2b056d712?auto=format&fit=crop&w=700&q=80')
        : ($product['image'] ?? 'https://images.unsplash.com/photo-1517963879433-6ad2b056d712?auto=format&fit=crop&w=700&q=80');
    $productPrice = $isArticle ? number_format((float) $product->prix_vente, 0, ',', ' ') . ' FCFA' : ($product['price'] ?? '');
    $productOldPrice = $isArticle && $product->prix_promotionnel
        ? number_format((float) $product->prix, 0, ',', ' ') . ' FCFA'
        : ($product['old'] ?? null);
    $productBadge = $isArticle
        ? ($product->prix_promotionnel ? 'Promo' : ((int) $product->quantite <= 5 ? 'Stock limite' : 'Disponible'))
        : ($product['badge'] ?? null);
    $canBuy = $isArticle && $product->is_available_for_sale;
@endphp

<article class="product-card" data-product-card data-product-name="{{ $productName }}">
    @if (!empty($productBadge))
        <span class="product-badge">{{ $productBadge }}</span>
    @endif
    <a class="product-image" href="#">
        <img src="{{ $productImage }}" alt="{{ $productName }}">
    </a>
    <div class="product-info">
        <h3>{{ $productName }}</h3>
        <div class="product-price">
            <strong>{{ $productPrice }}</strong>
            @if (!empty($productOldPrice))
                <span>{{ $productOldPrice }}</span>
            @endif
        </div>
        @if ($canBuy)
            <form class="product-cart-form" method="POST" action="{{ route('cart.add', $product) }}">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button class="product-action" type="submit" data-product-add aria-label="Ajouter {{ $productName }} au panier">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6 6h15l-2 8H8L6 3H3m6 18a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm9 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"/>
                    </svg>
                    <span>Ajouter</span>
                </button>
            </form>
        @else
            <button class="product-action product-action-disabled" type="button" disabled>
                <span>Indisponible</span>
            </button>
        @endif
    </div>
</article>
