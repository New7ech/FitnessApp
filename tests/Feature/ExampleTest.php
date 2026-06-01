<?php

use App\Models\CustomerRequest;

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee('Fitwinnie Store')
        ->assertSeeText('Catégorie produits')
        ->assertSee('Tapis de course');
});

test('the contact form accepts a valid request', function () {
    $response = $this->post('/contact', [
        'name' => 'Client Test',
        'email' => 'client@example.com',
        'goal' => 'Remise en forme',
        'message' => 'Disponible le soir.',
    ]);

    $response->assertRedirect('/#reservation');
    $response->assertSessionHas('status');

    $this->assertDatabaseHas('customer_requests', [
        'name' => 'Client Test',
        'email' => 'client@example.com',
        'type' => 'question',
        'status' => 'new',
    ]);
});

test('the admin dashboard exposes contact actions for a request', function () {
    CustomerRequest::create([
        'type' => 'question',
        'status' => 'new',
        'name' => 'Client Admin',
        'email' => 'admin-client@example.com',
        'phone' => '0712345678',
        'message' => 'Je souhaite etre contacte.',
    ]);

    $response = $this
        ->withSession(['admin_authenticated' => true])
        ->get(route('admin.dashboard'));

    $response->assertStatus(200)
        ->assertSee('Client Admin')
        ->assertSee('Appeler')
        ->assertSee('WhatsApp')
        ->assertSee('Envoyer la notification');
});

test('an admin can notify a requester by email', function () {
    $customerRequest = CustomerRequest::create([
        'type' => 'quote',
        'status' => 'new',
        'name' => 'Client Notification',
        'email' => 'notification@example.com',
        'phone' => '0711111111',
        'message' => 'Je veux un devis.',
    ]);

    $response = $this
        ->withSession(['admin_authenticated' => true])
        ->post(route('admin.requests.notify', $customerRequest), [
            'subject' => 'Votre demande LifeFit Store',
            'message' => 'Nous revenons vers vous rapidement.',
        ]);

    $response->assertRedirect()
        ->assertSessionHas('admin_status');

    $customerRequest->refresh();

    expect($customerRequest->status)->toBe('contacted')
        ->and($customerRequest->admin_notes)->toContain('Notification envoyee');
});
