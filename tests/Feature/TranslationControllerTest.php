<?php

namespace Tests\Feature;

use App\Models\Translation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TranslationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('email','user@user.com')->first();
        dd($this->user);    
        $this->token = $this->user->createToken('TestToken')->accessToken;
    }

    /** @test */
    public function it_can_fetch_all_translations()
    {
        Translation::factory(10)->create();

        $response = $this->getJson('/api/translations', [
            'Authorization' => "Bearer $this->token",
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    /** @test */
    public function it_can_create_a_translation()
    {
        $data = [
            'key' => 'welcome',
            'locale' => 'en',
            'content' => 'Welcome',
            'tags' => 'web',
        ];

        $response = $this->postJson('/api/translations', $data, [
            'Authorization' => "Bearer $this->token",
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['key' => 'welcome']);
    }

    /** @test */
    public function it_can_update_a_translation()
    {
        $translation = Translation::factory()->create();
        $data = ['content' => 'Updated Content'];

        $response = $this->putJson("/api/translations/{$translation->id}", $data, [
            'Authorization' => "Bearer $this->token",
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['content' => 'Updated Content']);
    }

    /** @test */
    public function it_can_delete_a_translation()
    {
        $translation = Translation::factory()->create();

        $response = $this->deleteJson("/api/translations/{$translation->id}", [], [
            'Authorization' => "Bearer $this->token",
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('translations', ['id' => $translation->id]);
    }

    /** @test */
    public function it_can_export_translations_as_json()
    {
        Translation::factory(10)->create();

        $response = $this->getJson('/api/translations/export', [
            'Authorization' => "Bearer $this->token",
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    /** @test */
    public function it_requires_authentication_for_protected_routes()
    {
        $response = $this->getJson('/api/translations');
        $response->assertStatus(401);
    }

    /** @test */
    public function it_validates_translation_creation()
    {
        $response = $this->postJson('/api/translations', [], [
            'Authorization' => "Bearer $this->token",
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['key', 'locale', 'content']);
    }
}
