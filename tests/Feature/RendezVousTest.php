<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\RendezVous;
use App\Models\Vetement;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RendezVousTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin for notifications to avoid failure in notifyAdminNewAppointment
        Admin::create([
            'nom' => 'Admin',
            'prenom' => 'SMC',
            'email' => 'admin@smc-couture.com',
            'password' => bcrypt('password'),
            'telephone' => '771234567',
        ]);
    }

    /** @test */
    public function a_guest_can_book_an_appointment_without_login_and_it_creates_a_client_profile()
    {
        $response = $this->postJson(route('rendezvous.store'), [
            'nom' => 'Dioum',
            'prenom' => 'Mouhamadou',
            'telephone' => '771234568',
            'email' => 'mouhamadou@example.com',
            'dateRendezVous' => now()->addDays(2)->format('Y-m-d'),
            'heure' => '10:00',
            'commentaire' => 'Prise de mesures pour un boubou',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'redirect' => route('home'),
        ]);

        // Check if the client was created
        $this->assertDatabaseHas('clients', [
            'telephone' => '771234568',
            'email' => 'mouhamadou@example.com',
            'nom' => 'Dioum',
            'prenom' => 'Mouhamadou',
        ]);

        $client = Client::where('telephone', '771234568')->first();

        // Check if the appointment was created for this client
        $this->assertDatabaseHas('rendez_vous', [
            'client_id' => $client->id,
            'heure' => '10:00',
            'statut' => RendezVous::STATUT_EN_ATTENTE,
        ]);
    }

    /** @test */
    public function a_guest_without_email_has_an_email_auto_generated()
    {
        $response = $this->postJson(route('rendezvous.store'), [
            'nom' => 'Sow',
            'prenom' => 'Amath',
            'telephone' => '779998877',
            'dateRendezVous' => now()->addDays(2)->format('Y-m-d'),
            'heure' => '14:00',
            'commentaire' => 'Prise de mesures',
        ]);

        $response->assertStatus(200);

        // Check if the client was created with a generated email
        $this->assertDatabaseHas('clients', [
            'telephone' => '779998877',
            'email' => '779998877@smc-couture.com',
        ]);
    }

    /** @test */
    public function a_client_cannot_have_multiple_active_appointments()
    {
        // 1. Create a client
        $client = Client::create([
            'nom' => 'Ndiaye',
            'prenom' => 'Fatou',
            'telephone' => '772223344',
            'email' => 'fatou@example.com',
            'motDePasse' => bcrypt('password'),
            'dateInscription' => now(),
        ]);

        // 2. Create an active appointment (EN_ATTENTE, not delivered)
        RendezVous::create([
            'dateRendezVous' => now()->addDays(2)->format('Y-m-d'),
            'heure' => '10:00',
            'statut' => RendezVous::STATUT_EN_ATTENTE,
            'statut_production' => RendezVous::PROD_EN_ATTENTE,
            'client_id' => $client->id,
        ]);

        // 3. Try to book another appointment with same phone (guest flow)
        $response = $this->postJson(route('rendezvous.store'), [
            'nom' => 'Ndiaye',
            'prenom' => 'Fatou',
            'telephone' => '772223344',
            'dateRendezVous' => now()->addDays(3)->format('Y-m-d'),
            'heure' => '15:00',
            'commentaire' => 'Another appointment',
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Vous avez déjà un rendez-vous en cours. Vous ne pourrez pas en planifier un autre tant qu\'il ne sera pas terminé.',
        ]);
    }

    /** @test */
    public function a_client_can_book_another_appointment_if_previous_is_delivered()
    {
        // 1. Create a client
        $client = Client::create([
            'nom' => 'Faye',
            'prenom' => 'Abdou',
            'telephone' => '771112233',
            'email' => 'abdou@example.com',
            'motDePasse' => bcrypt('password'),
            'dateInscription' => now(),
        ]);

        // 2. Create a delivered appointment (LIVRE)
        RendezVous::create([
            'dateRendezVous' => now()->subDays(5)->format('Y-m-d'),
            'heure' => '10:00',
            'statut' => RendezVous::STATUT_CONFIRME,
            'statut_production' => RendezVous::PROD_LIVRE,
            'client_id' => $client->id,
        ]);

        // 3. Try to book another appointment
        $response = $this->postJson(route('rendezvous.store'), [
            'nom' => 'Faye',
            'prenom' => 'Abdou',
            'telephone' => '771112233',
            'dateRendezVous' => now()->addDays(3)->format('Y-m-d'),
            'heure' => '15:00',
            'commentaire' => 'New appointment after delivery',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
    }

    /** @test */
    public function a_client_can_login_using_email_or_phone()
    {
        $client = Client::create([
            'nom' => 'Kamara',
            'prenom' => 'Lamine',
            'telephone' => '775556677',
            'email' => 'lamine@example.com',
            'motDePasse' => bcrypt('secret123'),
            'dateInscription' => now(),
        ]);

        // Login with email
        $response = $this->post(route('login'), [
            'login' => 'lamine@example.com',
            'motDePasse' => 'secret123',
        ]);
        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($client, 'client');

        // Logout
        $this->post(route('client.logout'));
        $this->assertGuest('client');

        // Login with phone
        $response = $this->post(route('login'), [
            'login' => '775556677',
            'motDePasse' => 'secret123',
        ]);
        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($client, 'client');
    }

    /** @test */
    public function a_visitor_is_redirected_when_trying_to_track_appointments_by_phone()
    {
        // Access suivi page should redirect to home
        $response = $this->get(route('rendezvous.suivi'));
        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }
}
