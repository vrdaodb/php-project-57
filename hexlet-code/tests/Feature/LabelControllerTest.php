<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('labels.index'));
        $response->assertStatus(200);
    }

    public function test_create_label()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('labels.store'), [
            'name' => 'Test Label'
        ]);
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => 'Test Label']);
    }

    public function test_update_label()
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();
        $response = $this->actingAs($user)->patch(route('labels.update', $label), [
            'name' => 'Updated Label'
        ]);
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => 'Updated Label']);
    }

    public function test_delete_label()
    {
        $user = User::factory()->create();
        $label = Label::factory()->create();
        $response = $this->actingAs($user)->delete(route('labels.destroy', $label));
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}
