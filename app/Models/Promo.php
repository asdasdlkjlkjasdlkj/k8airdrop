<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function platforms() {
        return $this->belongsToMany(Platform::class, 'platform_promo');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'promo_user');
    }

    public function codes() {
        return $this->belongsToMany(Code::class, 'code_promo');
    }

    public function participants() {
        return $this->belongsToMany(Participant::class, 'participant_promo');
    }
}
