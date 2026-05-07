<?php

namespace App\Http\Controllers;

use App\Models\CustomerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerRequestController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $type = $request->input('type', 'question');

        $validator = Validator::make($request->all(), [
            'type' => ['nullable', 'string', Rule::in(array_keys(CustomerRequest::TYPES))],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'goal' => ['nullable', 'string', 'max:120'],
            'service' => [Rule::requiredIf($type === 'reservation'), 'nullable', 'string', 'max:120'],
            'preferred_date' => [Rule::requiredIf($type === 'reservation'), 'nullable', 'date', 'after_or_equal:today'],
            'preferred_time' => ['nullable', 'string', 'max:40'],
            'message' => [Rule::requiredIf($type !== 'reservation'), 'nullable', 'string', 'max:1500'],
        ], [
            'name.required' => 'Votre nom est obligatoire.',
            'email.required' => 'Votre email est obligatoire.',
            'email.email' => 'Votre email doit etre valide.',
            'service.required' => 'Choisissez le service souhaite pour la reservation.',
            'preferred_date.required' => 'Choisissez une date pour la reservation.',
            'preferred_date.after_or_equal' => 'La date doit etre aujourd hui ou plus tard.',
            'message.required' => 'Ajoutez votre question ou votre besoin.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->to(route('home', [], false).'#reservation')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $data['type'] = ($data['type'] ?? null) ?: 'question';
        $data['status'] = 'new';

        CustomerRequest::create($data);

        return redirect()
            ->to(route('home', [], false).'#reservation')
            ->with('status', $this->confirmationMessage($data['type']));
    }

    private function confirmationMessage(string $type): string
    {
        return match ($type) {
            'reservation' => 'Votre reservation a bien ete enregistree. Un coach vous confirme le creneau rapidement.',
            'quote' => 'Votre demande de devis a bien ete envoyee. Nous revenons vers vous avec une proposition.',
            default => 'Votre question a bien ete envoyee. Un conseiller vous recontacte rapidement.',
        };
    }
}
