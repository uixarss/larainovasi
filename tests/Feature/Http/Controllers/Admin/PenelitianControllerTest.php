<?php

namespace tests\Feature\Http\Controllers\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PenelitianControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testStore(){
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])
        ->from(route('admin.create.penelitian'))
        ->post(route('admin.store.penelitian'), [
            'title' => $this->faker->words(3, true),
            'abstract' => $this->faker->words(5, true),
            'description' => $this->faker->words(7, true),
            'keyword' => $this->faker->words(9, true),
            'author' => $this->faker->words(3, true),
            'institution' => $this->faker->words(5, true),
            'status' => "draft",
            'file_name_full_article' => $this->faker->words(7, true),
            'loc_file_name_full_article' => $this->faker->words(9, true)
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.create.penelitian'));
    }
    
    public function testStore_with_invalid_title_key()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])
        ->from(route('admin.create.penelitian'))
        ->post(route('admin.store.penelitian'), [
            't' => $this->faker->words(3, true),
            'abstract' => $this->faker->words(5, true),
            'description' => $this->faker->words(7, true),
            'keyword' => $this->faker->words(9, true),
            'author' => $this->faker->words(3, true),
            'institution' => $this->faker->words(5, true),
            'status' => "draft",
            'file_name_full_article' => $this->faker->words(7, true),
            'loc_file_name_full_article' => $this->faker->words(9, true)
        ])->assertRedirect(route('admin.create.penelitian'));

        $response->assertStatus(302);
        $response->assertSessionHasErrors('title');
    }


}
