<?php

namespace App\Policies;

use App\Models\User;

use App\Models\Violation;

class ViolationPolicy
{
    /**
     * Create a new policy instance.
     */
	public function update(User $user, Violation $violation) {
		return $user->IsAdmin();
	}
	public function destroy(User $user, Violation $violation) {
		return $this->update($user, $violation);
	}
}