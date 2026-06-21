<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Violation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViolationTest extends TestCase
{
    use RefreshDatabase;

    public function test_violation_belongs_to_user(): void
    {
        $user      = User::factory()->create();
        $violation = Violation::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $violation->user);
        $this->assertEquals($user->id, $violation->user->id);
    }

    public function test_status_constants_are_defined(): void
    {
        $this->assertEquals('Новое', Violation::STATUS_NEW);
        $this->assertEquals('Подтверждено', Violation::STATUS_CONFIRMED);
        $this->assertEquals('Отклонено', Violation::STATUS_REJECTED);
    }

    public function test_statuses_array_contains_all_statuses(): void
    {
        $this->assertCount(3, Violation::STATUSES);
        $this->assertContains(Violation::STATUS_NEW, Violation::STATUSES);
        $this->assertContains(Violation::STATUS_CONFIRMED, Violation::STATUSES);
        $this->assertContains(Violation::STATUS_REJECTED, Violation::STATUSES);
    }

    public function test_factory_creates_violation_with_new_status(): void
    {
        $violation = Violation::factory()->create();

        $this->assertEquals(Violation::STATUS_NEW, $violation->status);
    }

    public function test_factory_confirmed_state(): void
    {
        $violation = Violation::factory()->confirmed()->create();

        $this->assertEquals(Violation::STATUS_CONFIRMED, $violation->status);
    }

    public function test_factory_rejected_state(): void
    {
        $violation = Violation::factory()->rejected()->create();

        $this->assertEquals(Violation::STATUS_REJECTED, $violation->status);
    }

    public function test_violation_is_deleted_when_user_is_deleted(): void
    {
        $user      = User::factory()->create();
        $violation = Violation::factory()->create(['user_id' => $user->id]);

        $user->delete();

        $this->assertNull(Violation::find($violation->id));
    }
}
