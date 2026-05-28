<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('task_statuses.index'));
        $response->assertStatus(200);
    }

    public function test_create_status()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('task_statuses.store'), [
            'name' => 'Test Status'
        ]);
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'Test Status']);
    }

    public function test_update_status()
    {
        $user = User::factory()->create();
        $status = TaskStatus::factory()->create();
        $response = $this->actingAs($user)->patch(route('task_statuses.update', $status), [
            'name' => 'Updated Status'
        ]);
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'Updated Status']);
    }

    public function test_delete_status()
    {
        $user = User::factory()->create();
        $status = TaskStatus::factory()->create();
        $response = $this->actingAs($user)->delete(route('task_statuses.destroy', $status));
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['id' => $status->id]);
    }
}
