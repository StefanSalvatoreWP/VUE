<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function committees() {
        return $this->belongsToMany(Committee::class);
    }
    protected $fillable = [
        'name',
        'description',
        'category',
        'type',
    ];
}
