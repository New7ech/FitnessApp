<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Connexion administrateur LifeFit Store.">

    <title>Administration | LifeFit Store</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <main class="admin-auth">
        <section class="admin-login-hero" aria-label="Presentation du back-office">
            <a class="brand admin-brand" href="{{ route('home') }}" aria-label="Accueil LifeFit Store">
                <span class="brand-box">LifeFit</span>
            </a>

            <div>
                <span class="admin-eyebrow">Back-office client</span>
                <h1>Suivi rapide des demandes</h1>
                <p>Centralisez les reservations, devis et questions clients. Contactez chaque demandeur par email, telephone, SMS ou WhatsApp depuis le tableau de bord.</p>
            </div>

            <div class="admin-login-benefits" aria-label="Fonctions administrateur">
                <span>Notifications email</span>
                <span>Actions de contact</span>
                <span>Notes internes</span>
            </div>

            <div class="admin-login-contact">
                <a href="tel:+2250719699070">Assistance</a>
                <a href="mailto:contact@lifefitstore.test">Nous contacter</a>
            </div>
        </section>

        <section class="admin-login-panel">
            <div>
                <span class="admin-eyebrow">Acces reserve</span>
                <h1>Administration</h1>
                <p>Connectez-vous pour traiter les questions, reservations et devis clients.</p>
            </div>

            @if (session('status'))
                <div class="status-banner" role="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="form-errors" role="alert">
                    <strong>Connexion impossible.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="admin-form" method="POST" action="{{ route('admin.login.store') }}">
                @csrf

                <label>
                    <span>Email administrateur</span>
                    <input type="email" name="email" value="{{ old('email') }}" autocomplete="username" autofocus required>
                </label>

                <label>
                    <span>Mot de passe</span>
                    <input type="password" name="password" autocomplete="current-password" required>
                </label>

                <button class="admin-primary" type="submit">Se connecter</button>
            </form>
        </section>
    </main>
</body>
</html>
