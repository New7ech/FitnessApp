<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tableau administrateur LifeFit Store.">

    <title>Demandes clients | LifeFit Store</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <header class="admin-topbar">
        <a class="brand" href="{{ route('home') }}" aria-label="Accueil LifeFit Store">
            <span class="brand-box">LifeFit</span>
        </a>

        <nav aria-label="Navigation administration">
            <a href="{{ route('home') }}">Boutique</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit">Deconnexion</button>
            </form>
        </nav>
    </header>

    <main class="admin-shell">
        <section class="admin-heading">
            <div>
                <span class="admin-eyebrow">Administration</span>
                <h1>Demandes clients</h1>
            </div>
            <div class="admin-total">
                <span>Total</span>
                <strong>{{ $totalRequests }}</strong>
            </div>
        </section>

        @if (session('admin_status'))
            <div class="status-banner" role="status">{{ session('admin_status') }}</div>
        @endif

        <section class="admin-stats" aria-label="Statistiques des demandes">
            @foreach ($statuses as $status => $label)
                <article>
                    <span>{{ $label }}</span>
                    <strong>{{ $stats[$status] ?? 0 }}</strong>
                </article>
            @endforeach
        </section>

        <form class="admin-filters" method="GET" action="{{ route('admin.dashboard') }}">
            <label>
                <span>Type</span>
                <select name="type">
                    <option value="">Tous</option>
                    @foreach ($types as $type => $label)
                        <option value="{{ $type }}" @selected($selectedType === $type)>{{ $label }}</option>
                    @endforeach
                </select>
            </label>

            <label>
                <span>Statut</span>
                <select name="status">
                    <option value="">Tous</option>
                    @foreach ($statuses as $status => $label)
                        <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ $label }}</option>
                    @endforeach
                </select>
            </label>

            <button class="admin-primary" type="submit">Filtrer</button>
            <a class="admin-secondary" href="{{ route('admin.dashboard') }}">Reinitialiser</a>
        </form>

        <section class="admin-requests" aria-label="Liste des demandes clients">
            @forelse ($requests as $customerRequest)
                @php
                    $quickMessage = "Bonjour {$customerRequest->name}, nous vous contactons au sujet de votre demande LifeFit Store.";
                    $defaultSubject = 'Votre demande LifeFit Store';
                    $defaultNotification = "Bonjour {$customerRequest->name},\n\nNous avons bien pris connaissance de votre demande. Un conseiller LifeFit Store revient vers vous rapidement avec les informations utiles.\n\nL equipe LifeFit Store";
                    $mailtoUrl = 'mailto:'.$customerRequest->email.'?subject='.rawurlencode($defaultSubject).'&body='.rawurlencode($quickMessage);
                    $smsUrl = $customerRequest->dial_phone ? 'sms:'.$customerRequest->dial_phone.'?&body='.rawurlencode($quickMessage) : null;
                    $whatsappUrl = $customerRequest->phone_digits ? 'https://wa.me/'.$customerRequest->phone_digits.'?text='.rawurlencode($quickMessage) : null;
                    $confirmTemplate = "Bonjour {$customerRequest->name}, votre demande est bien en cours de traitement. Nous revenons vers vous pour confirmer les details.";
                    $missingTemplate = "Bonjour {$customerRequest->name}, merci pour votre demande. Pouvez-vous nous envoyer quelques precisions afin de finaliser votre dossier ?";
                    $doneTemplate = "Bonjour {$customerRequest->name}, votre demande LifeFit Store a ete traitee. Nous restons disponibles si besoin.";
                @endphp

                <article class="admin-request-card status-{{ $customerRequest->status }}">
                    <header>
                        <div>
                            <span>{{ $customerRequest->type_label }}</span>
                            <h2>{{ $customerRequest->name }}</h2>
                            <p>{{ $customerRequest->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <strong>{{ $customerRequest->status_label }}</strong>
                    </header>

                    <dl class="admin-request-details">
                        <div>
                            <dt>Email</dt>
                            <dd><a href="mailto:{{ $customerRequest->email }}">{{ $customerRequest->email }}</a></dd>
                        </div>
                        <div>
                            <dt>Telephone</dt>
                            <dd>{{ $customerRequest->phone ?: '-' }}</dd>
                        </div>
                        <div>
                            <dt>Objectif</dt>
                            <dd>{{ $customerRequest->goal ?: '-' }}</dd>
                        </div>
                        <div>
                            <dt>Service</dt>
                            <dd>{{ $customerRequest->service ?: '-' }}</dd>
                        </div>
                        <div>
                            <dt>Date</dt>
                            <dd>{{ $customerRequest->preferred_date?->format('d/m/Y') ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt>Disponibilite</dt>
                            <dd>{{ $customerRequest->preferred_time ?: '-' }}</dd>
                        </div>
                    </dl>

                    <div class="admin-contact-actions" aria-label="Actions de contact pour {{ $customerRequest->name }}">
                        @if ($customerRequest->dial_phone)
                            <a href="tel:{{ $customerRequest->dial_phone }}">Appeler</a>
                        @else
                            <span>Pas de telephone</span>
                        @endif

                        @if ($whatsappUrl)
                            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener">WhatsApp</a>
                        @else
                            <span>WhatsApp indisponible</span>
                        @endif

                        @if ($smsUrl)
                            <a href="{{ $smsUrl }}">SMS</a>
                        @else
                            <span>SMS indisponible</span>
                        @endif

                        <a href="{{ $mailtoUrl }}">Email</a>
                        <button type="button" data-copy-contact="{{ $customerRequest->contact_summary }}">Copier contact</button>
                    </div>

                    @if ($customerRequest->message)
                        <div class="admin-message">
                            <span>Message</span>
                            <p>{{ $customerRequest->message }}</p>
                        </div>
                    @endif

                    <form class="admin-update-form" method="POST" action="{{ route('admin.requests.update', $customerRequest) }}">
                        @csrf
                        @method('PATCH')

                        <label>
                            <span>Statut</span>
                            <select name="status">
                                @foreach ($statuses as $status => $label)
                                    <option value="{{ $status }}" @selected($customerRequest->status === $status)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label>
                            <span>Note interne</span>
                            <textarea name="admin_notes" rows="3">{{ old('admin_notes', $customerRequest->admin_notes) }}</textarea>
                        </label>

                        <button class="admin-primary" type="submit">Enregistrer</button>
                    </form>

                    <form class="admin-notify-form" method="POST" action="{{ route('admin.requests.notify', $customerRequest) }}">
                        @csrf

                        <div class="admin-notify-heading">
                            <span>Notifier le demandeur</span>
                            <p>Envoie un email au demandeur et ajoute une trace dans les notes internes.</p>
                        </div>

                        <label>
                            <span>Sujet</span>
                            <input type="text" name="subject" value="{{ old('subject', $defaultSubject) }}" maxlength="160" required>
                        </label>

                        <label>
                            <span>Message</span>
                            <textarea name="message" rows="4" required>{{ old('message', $defaultNotification) }}</textarea>
                        </label>

                        <div class="admin-template-actions" aria-label="Modeles de notification">
                            <button type="button" data-notify-template data-template-subject="Votre demande est en cours" data-template-message="{{ $confirmTemplate }}">Suivi</button>
                            <button type="button" data-notify-template data-template-subject="Precision necessaire" data-template-message="{{ $missingTemplate }}">Precision</button>
                            <button type="button" data-notify-template data-template-subject="Demande traitee" data-template-message="{{ $doneTemplate }}">Cloture</button>
                        </div>

                        <button class="admin-primary" type="submit">Envoyer la notification</button>
                    </form>

                    <form class="admin-delete-form" method="POST" action="{{ route('admin.requests.destroy', $customerRequest) }}" onsubmit="return confirm('Supprimer cette demande ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </article>
            @empty
                <div class="admin-empty">
                    <h2>Aucune demande</h2>
                    <p>Les nouvelles questions, reservations et devis apparaitront ici.</p>
                </div>
            @endforelse
        </section>

        @if ($requests->hasPages())
            <div class="admin-pagination">
                {{ $requests->links() }}
            </div>
        @endif
    </main>
</body>
</html>
