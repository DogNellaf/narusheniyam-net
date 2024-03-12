<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Violation extends Model
{
	public function user() {
		return $this->belongsTo(User::class);
	}
    protected $fillable = ['description', 'number', 'status'];
}
