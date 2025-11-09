<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'avatar',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) =>  Storage::url('avatars/' . $value),
        );
    }
}
