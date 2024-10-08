<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stripe()
    {
        return $this->hasMany(Stripe::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
