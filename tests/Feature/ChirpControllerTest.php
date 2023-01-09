<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ChirpControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->others = User::factory(2)->create();
        $this->chirp = $this->user->chirps()->create([
            'message' => 'setup chirp'
        ]);

        Notification::fake();
    }

    public function test_users_can_not_get_chirps_without_logged_in()
    {
        $response = $this->get('/chirps');

        $response->assertRedirect(route('login'));
    }

    public function test_logged_in_users_can_get_chirps()
    {
        $response = $this->actingAs($this->user)
            ->get('/chirps');

        $response->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Chirps/Index')
                ->has('chirps', 1)
            );
    }

    public function test_chirp_can_be_stored()
    {
        $message = 'chirp';

        $response = $this->actingAs($this->user)
            ->post('/chirps', [
                'message' => $message
            ]);

        $response->assertRedirect(route('chirps.index'));

        $this->assertDatabaseHas('chirps', [
            'user_id' => $this->user->id,
            'message' => $message
        ]);

        Notification::assertNotSentTo([$this->user], NewChirp::class);
        Notification::assertSentTo($this->others, NewChirp::class);
    }

    public function test_chirp_attachment_can_be_uploaded()
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->image('attachment.jpg');

        $this->actingAs($this->user)
            ->post('/chirps', [
                'message' => 'chirp',
                'file' => $file
            ]);

        $this->assertDatabaseHas('attachments', [
            'name' => $file->hashName()
        ]);

        Storage::disk('local')->assertExists("chirps/{$file->hashName()}");
    }

    public function test_chirp_can_be_updated()
    {
        $message = 'updated chirp';

        $response = $this->actingAs($this->user)
            ->put("/chirps/{$this->chirp->id}", [
                'message' => $message
            ]);

        $response->assertRedirect(route('chirps.index'));

        $this->assertDatabaseHas('chirps', [
            'user_id' => $this->user->id,
            'message' => $message
        ]);
        $this->assertDatabaseMissing('chirps', [
            'user_id' => $this->user->id,
            'message' => $this->chirp->message
        ]);

        Notification::assertNotSentTo([$this->user, ...$this->others], NewChirp::class);
    }

    public function test_chirp_can_be_deleted()
    {
        $response = $this->actingAs($this->user)
            ->delete("/chirps/{$this->chirp->id}");

        $response->assertRedirect(route('chirps.index'));

        $this->assertDatabaseMissing('chirps', [
            'user_id' => $this->user->id,
            'message' => $this->chirp->message
        ]);

        Notification::assertNotSentTo([$this->user, ...$this->others], NewChirp::class);
    }

    public function test_chirps_screen_can_be_rendered_after_verification()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get('/chirps');
        $response->assertRedirect(route('verification.notice'));

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
        $this->actingAs($user)->get($verificationUrl);

        $response = $this->actingAs($user)->get('/chirps');
        $response->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Chirps/Index')
            );
    }
}
