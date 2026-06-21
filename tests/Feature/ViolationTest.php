<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Violation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViolationTest extends TestCase
{
    use RefreshDatabase;

    // --- Create ---

    public function test_guest_cannot_access_create_form(): void
    {
        $this->get(route('violation.create'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_create_form(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('violation.create'))
            ->assertOk();
    }

    public function test_user_can_create_violation(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('violation.store'), [
            'description' => 'Автомобиль припаркован на газоне.',
            'number'      => 'А123БВ77',
        ])->assertRedirect(route('home'));

        $this->assertDatabaseHas('violations', [
            'user_id'     => $user->id,
            'number'      => 'А123БВ77',
            'status'      => Violation::STATUS_NEW,
        ]);
    }

    public function test_create_violation_requires_description(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('violation.store'), [
            'number' => 'А123БВ77',
        ])->assertSessionHasErrors('description');
    }

    public function test_create_violation_requires_number(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('violation.store'), [
            'description' => 'Описание нарушения.',
        ])->assertSessionHasErrors('number');
    }

    public function test_create_violation_number_min_length(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('violation.store'), [
            'description' => 'Описание.',
            'number'      => 'А12',
        ])->assertSessionHasErrors('number');
    }

    public function test_create_violation_number_max_length(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('violation.store'), [
            'description' => 'Описание.',
            'number'      => 'А123456789012',
        ])->assertSessionHasErrors('number');
    }

    public function test_guest_cannot_create_violation(): void
    {
        $this->post(route('violation.store'), [
            'description' => 'Описание.',
            'number'      => 'А123БВ77',
        ])->assertRedirect(route('login'));
    }

    // --- Detail ---

    public function test_authenticated_user_can_view_own_violation(): void
    {
        $user      = User::factory()->create();
        $violation = Violation::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('violation.detail', $violation))
            ->assertOk()
            ->assertSee($violation->number);
    }

    public function test_guest_cannot_view_violation_detail(): void
    {
        $violation = Violation::factory()->create();

        $this->get(route('violation.detail', $violation))
            ->assertRedirect(route('login'));
    }

    // --- Edit / Update (admin only) ---

    public function test_non_admin_cannot_access_edit_form(): void
    {
        $user      = User::factory()->create();
        $violation = Violation::factory()->create();

        $this->actingAs($user)
            ->get(route('violation.edit', $violation))
            ->assertForbidden();
    }

    public function test_admin_can_access_edit_form(): void
    {
        $admin     = User::factory()->admin()->create();
        $violation = Violation::factory()->create();

        $this->actingAs($admin)
            ->get(route('violation.edit', $violation))
            ->assertOk();
    }

    public function test_admin_can_update_violation_status(): void
    {
        $admin     = User::factory()->admin()->create();
        $violation = Violation::factory()->create(['status' => Violation::STATUS_NEW]);

        $this->actingAs($admin)->patch(route('violation.update', $violation), [
            'description' => $violation->description,
            'number'      => $violation->number,
            'status'      => Violation::STATUS_CONFIRMED,
        ])->assertRedirect(route('home'));

        $this->assertEquals(Violation::STATUS_CONFIRMED, $violation->fresh()->status);
    }

    public function test_update_rejects_invalid_status(): void
    {
        $admin     = User::factory()->admin()->create();
        $violation = Violation::factory()->create();

        $this->actingAs($admin)->patch(route('violation.update', $violation), [
            'description' => $violation->description,
            'number'      => $violation->number,
            'status'      => 'НесуществующийСтатус',
        ])->assertSessionHasErrors('status');
    }

    public function test_non_admin_cannot_update_violation(): void
    {
        $user      = User::factory()->create();
        $violation = Violation::factory()->create();

        $this->actingAs($user)->patch(route('violation.update', $violation), [
            'description' => 'Другое описание',
            'number'      => $violation->number,
            'status'      => Violation::STATUS_CONFIRMED,
        ])->assertForbidden();
    }

    // --- Destroy (admin only) ---

    public function test_admin_can_delete_violation(): void
    {
        $admin     = User::factory()->admin()->create();
        $violation = Violation::factory()->create();

        $this->actingAs($admin)
            ->delete(route('violation.destroy', $violation))
            ->assertRedirect(route('home'));

        $this->assertNull(Violation::find($violation->id));
    }

    public function test_non_admin_cannot_delete_violation(): void
    {
        $user      = User::factory()->create();
        $violation = Violation::factory()->create();

        $this->actingAs($user)
            ->delete(route('violation.destroy', $violation))
            ->assertForbidden();

        $this->assertNotNull(Violation::find($violation->id));
    }

    public function test_guest_cannot_delete_violation(): void
    {
        $violation = Violation::factory()->create();

        $this->delete(route('violation.destroy', $violation))
            ->assertRedirect(route('login'));
    }
}
