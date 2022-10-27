<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Platform extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [];

    public $sortable = ['title', 'created_at'];

    public function users() {
        return $this->belongsToMany(User::class, 'platform_user');
    }

    public function promos() {
        return $this->hasMany(Promo::class);
    }
}
