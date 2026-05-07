<article class="product-card" data-product-card data-product-name="{{ $product['name'] }}">
    @if (!empty($product['badge']))
        <span class="product-badge">{{ $product['badge'] }}</span>
    @endif
    <a class="product-image" href="#">
        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
    </a>
    <div class="product-info">
        <h3>{{ $product['name'] }}</h3>
        <div class="product-price">
            <strong>{{ $product['price'] }}</strong>
            @if (!empty($product['old']))
                <span>{{ $product['old'] }}</span>
            @endif
        </div>
        <button class="product-action" type="button" data-product-add aria-label="Ajouter {{ $product['name'] }} au panier">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6 6h15l-2 8H8L6 3H3m6 18a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm9 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"/>
            </svg>
            <span>Ajouter</span>
        </button>
    </div>
</article>
