<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('tasks.index'));
        $response->assertStatus(200);
    }

    public function test_create_task()
    {
        $user = User::factory()->create();
        $status = TaskStatus::factory()->create();
        $response = $this->actingAs($user)->post(route('tasks.store'), [
            'name' => 'Test Task',
            'status_id' => $status->id,
        ]);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['name' => 'Test Task']);
    }

    public function test_update_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $user->id]);
        $response = $this->actingAs($user)->patch(route('tasks.update', $task), [
            'name' => 'Updated Task',
            'status_id' => $task->status_id,
        ]);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['name' => 'Updated Task']);
    }

    public function test_delete_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $user->id]);
        $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_only_creator_can_delete()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $otherUser->id]);
        $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    }
}
