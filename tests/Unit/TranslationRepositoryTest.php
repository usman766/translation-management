<?php

namespace Tests\Unit;

use App\Models\Translation;
use App\Repositories\TranslationRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TranslationRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private TranslationRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new TranslationRepository();
    }

    /** @test */
    public function it_can_create_a_translation()
    {
        $data = ['key' => 'welcome', 'locale' => 'en', 'content' => 'Welcome', 'tags' => 'web'];
        $translation = $this->repository->create($data);

        $this->assertInstanceOf(Translation::class, $translation);
        $this->assertEquals('welcome', $translation->key);
    }

    /** @test */
    public function it_can_update_a_translation()
    {
        $translation = Translation::factory()->create();
        $updatedData = ['content' => 'Updated Content'];

        $this->repository->update($translation, $updatedData);
        $this->assertEquals('Updated Content', $translation->fresh()->content);
    }

    /** @test */
    public function it_can_delete_a_translation()
    {
        $translation = Translation::factory()->create();
        $this->repository->delete($translation);

        $this->assertNull(Translation::find($translation->id));
    }

    /** @test */
    public function it_can_filter_translations_by_key()
    {
        Translation::factory()->create(['key' => 'home']);
        Translation::factory()->create(['key' => 'about']);

        $filtered = $this->repository->index(['key' => 'home'])->items();

        $this->assertCount(1, $filtered);
        $this->assertEquals('home', $filtered[0]->key);
    }
}
