@php
    $categories = [
        ['code' => 'FIT', 'label' => 'Fitness'],
        ['code' => 'TAP', 'label' => 'Tapis de course'],
        ['code' => 'MUS', 'label' => 'Musculation'],
        ['code' => 'VEL', 'label' => 'Vélos'],
        ['code' => 'RAM', 'label' => 'Rameurs'],
        ['code' => 'ACC', 'label' => 'Accessoires'],
        ['code' => 'NUT', 'label' => 'Nutrition'],
    ];

    $products = [
        ['name' => 'Tapis de course X-Run 560', 'price' => '799,00 €', 'old' => '999,00 €', 'badge' => '-20%', 'image' => 'https://images.unsplash.com/photo-1576678927484-cc907957088c?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Rameur magnétique Pro Row', 'price' => '449,00 €', 'old' => '599,00 €', 'badge' => 'Promo', 'image' => 'https://images.unsplash.com/photo-1599058917212-d750089bc07e?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Banc réglable multi-position', 'price' => '199,00 €', 'old' => '249,00 €', 'badge' => '-15%', 'image' => 'https://images.unsplash.com/photo-1534368959876-26bf04f2c947?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Station guidée compacte', 'price' => '1 249,00 €', 'old' => '1 499,00 €', 'badge' => 'Top', 'image' => 'https://images.unsplash.com/photo-1638536532686-d610adfc8e5c?auto=format&fit=crop&w=700&q=80'],
    ];

    $newProducts = [
        ['name' => 'Pack haltères réglables', 'price' => '289,00 €', 'old' => null, 'badge' => 'Nouveau', 'image' => 'https://images.unsplash.com/photo-1517963879433-6ad2b056d712?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Tapis training antidérapant', 'price' => '34,90 €', 'old' => '49,90 €', 'badge' => '-30%', 'image' => 'https://images.unsplash.com/photo-1599901860904-17e6ed7083a0?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Vélo indoor Sprint Bike', 'price' => '549,00 €', 'old' => null, 'badge' => 'Nouveau', 'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Kettlebell compétition 16 kg', 'price' => '69,00 €', 'old' => '89,00 €', 'badge' => '-22%', 'image' => 'https://images.unsplash.com/photo-1605296867304-46d5465a13f1?auto=format&fit=crop&w=700&q=80'],
    ];

    $rowers = [
        ['name' => 'Rameur pliable Flow R2', 'price' => '389,00 €', 'old' => '499,00 €', 'badge' => '-22%', 'image' => 'https://images.unsplash.com/photo-1517130038641-a774d04afb3c?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Rameur air résistance', 'price' => '699,00 €', 'old' => null, 'badge' => 'Pro', 'image' => 'https://images.unsplash.com/photo-1599058918144-1ffabb6ab9a0?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Rameur studio noir', 'price' => '529,00 €', 'old' => '649,00 €', 'badge' => 'Stock', 'image' => 'https://images.unsplash.com/photo-1518310383802-640c2de311b2?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Rameur compact RX', 'price' => '299,00 €', 'old' => '379,00 €', 'badge' => '-21%', 'image' => 'https://images.unsplash.com/photo-1574680096145-d05b474e2155?auto=format&fit=crop&w=700&q=80'],
    ];

    $supplements = [
        ['name' => 'Whey isolate chocolat', 'price' => '39,90 €', 'old' => '49,90 €', 'badge' => '-20%', 'image' => 'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Créatine monohydrate', 'price' => '24,90 €', 'old' => null, 'badge' => 'Best', 'image' => 'https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Pré-workout énergie', 'price' => '29,90 €', 'old' => '36,90 €', 'badge' => 'Promo', 'image' => 'https://images.unsplash.com/photo-1611078489935-0cb964de46d6?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Shaker sport 700 ml', 'price' => '9,90 €', 'old' => null, 'badge' => 'Plus', 'image' => 'https://images.unsplash.com/photo-1605296867424-35fc25c9212a?auto=format&fit=crop&w=700&q=80'],
    ];

    $objectives = [
        ['title' => 'Perte de poids', 'image' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?auto=format&fit=crop&w=900&q=80'],
        ['title' => 'Prise de muscle', 'image' => 'https://images.unsplash.com/photo-1534368959876-26bf04f2c947?auto=format&fit=crop&w=900&q=80'],
        ['title' => 'Performance', 'image' => 'https://images.unsplash.com/photo-1517963879433-6ad2b056d712?auto=format&fit=crop&w=900&q=80'],
        ['title' => 'Récupération', 'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=900&q=80'],
    ];

    $slides = [
        ['kicker' => 'Entraînement cardio complet', 'title' => 'Améliorez votre endurance', 'image' => 'https://images.unsplash.com/photo-1675026482188-8102367ecc16?auto=format&fit=crop&w=1800&q=85'],
        ['kicker' => 'Machines professionnelles', 'title' => 'Créez votre salle de gym', 'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=1800&q=85'],
        ['kicker' => 'Force et préparation', 'title' => 'Équipez votre espace training', 'image' => 'https://images.unsplash.com/photo-1517963879433-6ad2b056d712?auto=format&fit=crop&w=1800&q=85'],
    ];
    $storeCategoryCards = collect($storeCategoryCards ?? []);
    $storeProducts = collect($storeProducts ?? []);
    $storeNewProducts = collect($storeNewProducts ?? []);
    $storeRowers = collect($storeRowers ?? []);
    $storeSupplements = collect($storeSupplements ?? []);

    if ($storeCategoryCards->isNotEmpty()) {
        $categories = $storeCategoryCards->all();
    }

    if ($storeProducts->isNotEmpty()) {
        $products = $storeProducts;
    }

    if ($storeNewProducts->isNotEmpty()) {
        $newProducts = $storeNewProducts;
    }

    if ($storeRowers->isNotEmpty()) {
        $rowers = $storeRowers;
    }

    if ($storeSupplements->isNotEmpty()) {
        $supplements = $storeSupplements;
    }

    $cartCount = $cartCount ?? 0;
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fitwinnie Store, boutique fitness pour tapis de course, rameurs, musculation, nutrition sportive et accessoires.">

    <title>Fitwinnie Store | Matériel fitness et nutrition</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="top-announcement">
        <p class="contact-line">Contact +226 77706991</p>
        <div class="marquee" aria-label="Informations boutique">
            <div class="marquee-track">
                <span>Livraison partout à Ouagadougou</span>
                <span>Équipez votre salle avec les meilleures machines de musculation</span>
                <span>Investissez dans la puissance - Votre salle, notre expertise</span>
                <span>Livraison partout à Ouagadougou</span>
                <span>Équipez votre salle avec les meilleures machines de musculation</span>
                <span>Investissez dans la puissance - Votre salle, notre expertise</span>
            </div>
        </div>
        <p class="currency-line">FCFA XOF</p>
    </div>

    <header class="shop-header" data-site-header>
        <button class="icon-button menu-button" type="button" aria-label="Ouvrir le menu" aria-controls="mobile-menu" aria-expanded="false" data-menu-toggle>
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>

        <a class="brand" href="{{ route('home') }}" aria-label="Accueil Fitwinnie Store">
            <span class="brand-box">Fitwinnie</span>
        </a>

        <form class="search-form" action="#" role="search">
            <input type="search" name="q" placeholder="Que recherchez-vous ?" aria-label="Rechercher un produit">
            <button type="submit" aria-label="Lancer la recherche">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m21 21-4.3-4.3m1.8-5.2a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
            </button>
        </form>

        <div class="header-actions" aria-label="Actions boutique">
            <a href="{{ route('admin.dashboard') }}" aria-label="Administration"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 21a8 8 0 0 0-16 0m8-9a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/></svg></a>
            <a href="#" aria-label="Favoris"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg></a>
            <a class="cart-link" href="{{ route('cart.index') }}" aria-label="Panier"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6h15l-2 8H8L6 3H3m6 18a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm9 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"/></svg><span>{{ $cartCount }}</span></a>
        </div>
    </header>

    <nav class="category-nav" aria-label="Navigation catalogue">
        <a class="active" href="#categories">Equipements <span>☰</span></a>
        <a href="#categories">Fitness</a>
        <a href="#nutrition">Nutrition</a>
        <a href="#musculation">Crossfit</a>
        <a href="#categories">Pilates</a>
        <a href="#objectifs">Padel</a>
        <a href="#reservation">Reservation</a>
        <a href="#articles">Conseils</a>
    </nav>

    <nav class="mobile-nav" id="mobile-menu" aria-label="Menu mobile" hidden data-mobile-menu>
        <a href="#categories">Catégories</a>
        <a href="#tapis">Tapis de course</a>
        <a href="#rameurs">Rameurs</a>
        <a href="#objectifs">Objectifs</a>
        <a href="#reservation">Reservation</a>
        <a href="#articles">Articles</a>
    </nav>

    <main>
        @if (session('success') || $errors->any())
            <div class="shop-alerts">
                @if (session('success'))
                    <div class="status-banner" role="status">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="form-errors" role="alert">
                        <strong>Merci de verifier l'action.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif
        <section class="hero-shop" aria-label="Sélection en avant">
            <div class="hero-slider" data-hero-slider>
                @foreach ($slides as $index => $slide)
                    <article class="hero-slide{{ $index === 0 ? ' active' : '' }}" data-hero-slide>
                        <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}">
                        <div class="slide-copy">
                            <h1>{{ $slide['title'] }}</h1>
                            <p>{{ $slide['kicker'] }}</p>
                        </div>
                        <a class="slider-cta" href="#categories">Découvrir</a>
                    </article>
                @endforeach

                <button class="slider-arrow prev" type="button" aria-label="Slide précédente" data-slide-prev>‹</button>
                <button class="slider-arrow next" type="button" aria-label="Slide suivante" data-slide-next>›</button>

                <div class="slider-dots" aria-label="Changer de slide">
                    @foreach ($slides as $index => $slide)
                        <button class="{{ $index === 0 ? 'active' : '' }}" type="button" aria-label="Afficher le slide {{ $index + 1 }}" data-slide-dot></button>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="catalog-section compact-section" id="categories">
            <div class="section-title">
                <h2><span>Catégorie</span> produits</h2>
                <a href="#">Voir tout</a>
            </div>

            <div class="category-grid">
                @foreach ($categories as $category)
                    <a class="category-card" href="#">
                        <span>{{ $category['code'] }}</span>
                        <strong>{{ $category['label'] }}</strong>
                    </a>
                @endforeach
            </div>

            <div class="promo-grid">
                <a class="promo-tile" href="#">
                    <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80" alt="Entraînement pilates">
                    <span>Pilates</span>
                </a>
                <a class="promo-tile" href="#">
                    <img src="https://images.unsplash.com/photo-1534258936925-c58bed479fcb?auto=format&fit=crop&w=800&q=80" alt="Entraînement vidéo">
                    <span>Vidéo training</span>
                </a>
                <a class="promo-tile" href="#">
                    <img src="https://images.unsplash.com/photo-1593095948071-474c5cc2989d?auto=format&fit=crop&w=800&q=80" alt="Nutrition sportive">
                    <span>Protéines</span>
                </a>
            </div>
        </section>

        <section class="catalog-section" id="tapis">
            <div class="section-title">
                <h2><span>Tapis</span> de course</h2>
                <a href="#">Voir tout</a>
            </div>
            <div class="product-grid">
                @foreach ($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </section>

        <section class="catalog-section" id="musculation">
            <div class="section-title">
                <h2><span>Nouveauté</span> fitness</h2>
                <a href="#">Voir tout</a>
            </div>
            <div class="product-grid">
                @foreach ($newProducts as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </section>

        <section class="catalog-section" id="rameurs">
            <div class="section-title">
                <h2><span>Découvrez</span> nos rameurs</h2>
                <a href="#">Voir tout</a>
            </div>
            <div class="product-grid">
                @foreach ($rowers as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </section>

        <section class="featured-strip">
            <div>
                <span>Vous ouvrez une salle ?</span>
                <h2>Un espace complet pour vos adhérents</h2>
                <p>Recevez une sélection adaptée à votre surface, votre budget et vos objectifs commerciaux.</p>
                <a class="button button-red" href="#reservation">Demander un devis</a>
            </div>
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=1000&q=85" alt="Salle de sport équipée">
        </section>

        <section class="request-section" id="reservation">
            <div class="request-copy">
                <span>Service client</span>
                <h2>Questions, reservations et devis</h2>
                <p>Envoyez votre besoin, choisissez un service ou proposez un creneau. L equipe traite chaque demande depuis l espace administrateur.</p>
                <div class="request-steps" aria-label="Etapes de traitement">
                    <span>1. Demande recue</span>
                    <span>2. Verification</span>
                    <span>3. Confirmation</span>
                </div>
            </div>

            <div class="request-panel">
                @if (session('status'))
                    <div class="status-banner" role="status">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="form-errors" role="alert">
                        <strong>Merci de verifier le formulaire.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="request-form" method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <label>
                        <span>Type de demande</span>
                        <select name="type">
                            <option value="question" @selected(old('type', 'question') === 'question')>Question</option>
                            <option value="reservation" @selected(old('type') === 'reservation')>Reservation</option>
                            <option value="quote" @selected(old('type') === 'quote')>Devis equipement</option>
                        </select>
                    </label>

                    <div class="form-grid">
                        <label>
                            <span>Nom complet</span>
                            <input type="text" name="name" value="{{ old('name') }}" autocomplete="name" required>
                            @error('name') <small>{{ $message }}</small> @enderror
                        </label>

                        <label>
                            <span>Email</span>
                            <input type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                            @error('email') <small>{{ $message }}</small> @enderror
                        </label>

                        <label>
                            <span>Telephone</span>
                            <input type="tel" name="phone" value="{{ old('phone') }}" autocomplete="tel">
                            @error('phone') <small>{{ $message }}</small> @enderror
                        </label>

                        <label>
                            <span>Objectif</span>
                            <input type="text" name="goal" value="{{ old('goal') }}" placeholder="Perte de poids, salle pro, cardio...">
                            @error('goal') <small>{{ $message }}</small> @enderror
                        </label>

                        <label>
                            <span>Service souhaite</span>
                            <select name="service">
                                <option value="">Choisir</option>
                                <option value="Conseil produit" @selected(old('service') === 'Conseil produit')>Conseil produit</option>
                                <option value="Reservation coach" @selected(old('service') === 'Reservation coach')>Reservation coach</option>
                                <option value="Installation salle" @selected(old('service') === 'Installation salle')>Installation salle</option>
                                <option value="Nutrition sportive" @selected(old('service') === 'Nutrition sportive')>Nutrition sportive</option>
                            </select>
                            @error('service') <small>{{ $message }}</small> @enderror
                        </label>

                        <label>
                            <span>Date souhaitee</span>
                            <input type="date" name="preferred_date" value="{{ old('preferred_date') }}" min="{{ now()->toDateString() }}">
                            @error('preferred_date') <small>{{ $message }}</small> @enderror
                        </label>
                    </div>

                    <label>
                        <span>Heure ou disponibilite</span>
                        <input type="text" name="preferred_time" value="{{ old('preferred_time') }}" placeholder="Matin, apres-midi, 17h30...">
                        @error('preferred_time') <small>{{ $message }}</small> @enderror
                    </label>

                    <label>
                        <span>Message</span>
                        <textarea name="message" rows="5" placeholder="Precisez votre question, les produits concernes ou votre besoin.">{{ old('message') }}</textarea>
                        @error('message') <small>{{ $message }}</small> @enderror
                    </label>

                    <button class="button button-red" type="submit">Envoyer la demande</button>
                </form>
            </div>
        </section>

        <section class="catalog-section" id="nutrition">
            <div class="section-title">
                <h2><span>En</span> vedette</h2>
                <a href="#">Voir tout</a>
            </div>
            <div class="product-grid product-grid-wide">
                @foreach ($supplements as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </section>

        <section class="catalog-section" id="objectifs">
            <div class="section-title centered">
                <h2><span>Achat selon</span> objectifs</h2>
            </div>
            <div class="objective-grid">
                @foreach ($objectives as $objective)
                    <a class="objective-card" href="#">
                        <img src="{{ $objective['image'] }}" alt="{{ $objective['title'] }}">
                        <span>{{ $objective['title'] }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="split-section">
            <div class="best-list">
                <div class="section-title small-title">
                    <h2><span>Meilleures</span> ventes</h2>
                </div>
                @foreach (collect($products)->take(3) as $product)
                    @php
                        $isArticle = $product instanceof \App\Models\Article;
                        $miniName = $isArticle ? $product->name : $product['name'];
                        $miniImage = $isArticle ? ($product->image_url ?? 'https://images.unsplash.com/photo-1517963879433-6ad2b056d712?auto=format&fit=crop&w=700&q=80') : $product['image'];
                        $miniPrice = $isArticle ? number_format((float) $product->prix_vente, 0, ',', ' ') . ' FCFA' : $product['price'];
                    @endphp
                    <a class="mini-product" href="#">
                        <img src="{{ $miniImage }}" alt="{{ $miniName }}">
                        <span>{{ $miniName }}</span>
                        <strong>{{ $miniPrice }}</strong>
                    </a>
                @endforeach
            </div>

            <a class="center-ad" href="#">
                <img src="https://images.unsplash.com/photo-1599901860904-17e6ed7083a0?auto=format&fit=crop&w=900&q=80" alt="Accessoires récupération">
                <span>Recovery fast</span>
            </a>

            <div class="best-list">
                <div class="section-title small-title">
                    <h2>En <span>vedette</span></h2>
                </div>
                @foreach (collect($supplements)->take(3) as $product)
                    @php
                        $isArticle = $product instanceof \App\Models\Article;
                        $miniName = $isArticle ? $product->name : $product['name'];
                        $miniImage = $isArticle ? ($product->image_url ?? 'https://images.unsplash.com/photo-1517963879433-6ad2b056d712?auto=format&fit=crop&w=700&q=80') : $product['image'];
                        $miniPrice = $isArticle ? number_format((float) $product->prix_vente, 0, ',', ' ') . ' FCFA' : $product['price'];
                    @endphp
                    <a class="mini-product" href="#">
                        <img src="{{ $miniImage }}" alt="{{ $miniName }}">
                        <span>{{ $miniName }}</span>
                        <strong>{{ $miniPrice }}</strong>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="catalog-section article-section" id="articles">
            <div class="section-title">
                <h2><span>Articles</span> de la semaine</h2>
                <a href="#">Tous les articles</a>
            </div>
            <div class="article-grid">
                <article>
                    <img src="https://images.unsplash.com/photo-1576678927484-cc907957088c?auto=format&fit=crop&w=700&q=80" alt="Choisir un tapis de course">
                    <span>Guide</span>
                    <h3>Comment choisir son tapis de course ?</h3>
                    <p>Surface, moteur, amorti et fréquence d'utilisation: les critères à vérifier avant achat.</p>
                </article>
                <article>
                    <img src="https://images.unsplash.com/photo-1518310383802-640c2de311b2?auto=format&fit=crop&w=700&q=80" alt="Rameur compact">
                    <span>Conseil</span>
                    <h3>Quel rameur pour s'entraîner à la maison ?</h3>
                    <p>Magnétique, air ou eau: chaque résistance répond à un usage différent.</p>
                </article>
                <article>
                    <img src="https://images.unsplash.com/photo-1593095948071-474c5cc2989d?auto=format&fit=crop&w=700&q=80" alt="Nutrition sportive">
                    <span>Nutrition</span>
                    <h3>Les bases d'un shaker efficace.</h3>
                    <p>Protéines, hydratation et timing pour accompagner l'entraînement sans complexité.</p>
                </article>
            </div>
        </section>

        <section class="movement-section">
            <div class="logo-cloud" aria-label="Marques partenaires">
                <span>fitpro</span>
                <span>force</span>
                <span>runlab</span>
                <span>power</span>
                <span>gym</span>
            </div>
            <div class="section-title centered">
                <h2>Join the <span>movement</span></h2>
            </div>
            <div class="movement-grid">
                @foreach ($objectives as $objective)
                    <img src="{{ $objective['image'] }}" alt="{{ $objective['title'] }}">
                @endforeach
            </div>
        </section>
    </main>

    <footer class="shop-footer">
        <div>
            <span class="footer-logo">Fitwinnie</span>
            <p>Matériel fitness, musculation, cardio et nutrition sportive pour équiper votre entraînement.</p>
        </div>
        <div>
            <h3>Catalogue</h3>
            <a href="#tapis">Tapis de course</a>
            <a href="#rameurs">Rameurs</a>
            <a href="#nutrition">Nutrition</a>
        </div>
        <div>
            <h3>Service client</h3>
            <a href="#">Livraison</a>
            <a href="#">Paiement</a>
            <a href="#">Retours</a>
            <a href="#reservation">Questions et reservations</a>
        </div>
        <div>
            <h3>Contact</h3>
            <p>fitness.fitwinnie@gmail.com</p>
            <p>+226 77 70 69 91</p>
            <a href="{{ route('admin.dashboard') }}">Administration</a>
        </div>
    </footer>

    <div class="floating-contact" aria-label="Contact rapide Fitwinnie Store">
        <a href="tel:+22677706991">Appeler</a>
        <a href="https://wa.me/22677706991?text=Bonjour%20Fitwinnie%20Store%2C%20je%20souhaite%20avoir%20des%20informations." target="_blank" rel="noopener">WhatsApp</a>
        <a href="#reservation">Demande</a>
    </div>
</body>
</html>
