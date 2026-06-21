<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;

    public const STATUS_NEW       = 'Новое';
    public const STATUS_CONFIRMED = 'Подтверждено';
    public const STATUS_REJECTED  = 'Отклонено';

    public const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_CONFIRMED,
        self::STATUS_REJECTED,
    ];

    protected $fillable = ['description', 'number', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
