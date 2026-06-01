<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fitwinnie Store, boutique fitness pour materiel, accessoires et nutrition sportive.">

    <title>@yield('title', 'Fitwinnie Store')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="top-announcement">
        <p class="contact-line">Contact +226 77706991</p>
        <div class="marquee" aria-label="Informations boutique">
            <div class="marquee-track">
                <span>Livraison partout a Ouagadougou</span>
                <span>Paiement mobile money, carte, virement ou livraison</span>
                <span>Facture PDF disponible apres commande</span>
                <span>Livraison partout a Ouagadougou</span>
                <span>Paiement mobile money, carte, virement ou livraison</span>
                <span>Facture PDF disponible apres commande</span>
            </div>
        </div>
        <p class="currency-line">FCFA XOF</p>
    </div>

    <header class="shop-header shop-header-compact" data-site-header>
        <a class="brand" href="{{ route('home') }}" aria-label="Accueil Fitwinnie Store">
            <span class="brand-box">Fitwinnie</span>
        </a>

        <nav class="checkout-steps" aria-label="Parcours commande">
            <a href="{{ route('home') }}">Catalogue</a>
            <a href="{{ route('cart.index') }}">Panier</a>
            <a href="{{ route('checkout.show') }}">Paiement</a>
        </nav>

        <div class="header-actions" aria-label="Actions boutique">
            <a class="cart-link" href="{{ route('cart.index') }}" aria-label="Panier">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6h15l-2 8H8L6 3H3m6 18a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm9 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"/></svg>
                <span>{{ $cartCount ?? 0 }}</span>
            </a>
        </div>
    </header>

    <main class="shop-page">
        @if (session('success') || session('status') || $errors->any())
            <div class="shop-alerts">
                @if (session('success') || session('status'))
                    <div class="status-banner" role="status">{{ session('success') ?? session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="form-errors" role="alert">
                        <strong>Merci de verifier les informations.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="shop-footer">
        <div>
            <span class="footer-logo">Fitwinnie</span>
            <p>Materiel fitness, musculation, cardio et nutrition sportive pour equiper votre entrainement.</p>
        </div>
        <div>
            <h3>Catalogue</h3>
            <a href="{{ route('home') }}#tapis">Tapis de course</a>
            <a href="{{ route('home') }}#rameurs">Rameurs</a>
            <a href="{{ route('home') }}#nutrition">Nutrition</a>
        </div>
        <div>
            <h3>Commande</h3>
            <a href="{{ route('cart.index') }}">Panier</a>
            <a href="{{ route('checkout.show') }}">Paiement</a>
            <a href="{{ route('home') }}#reservation">Demande de devis</a>
        </div>
        <div>
            <h3>Contact</h3>
            <p>fitness.fitwinnie@gmail.com</p>
            <p>+226 77 70 69 91</p>
        </div>
    </footer>
</body>
</html>

