<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'type',
        'os',
        'cpu',
        'gpu',
        'ram',
        'storage',
    ];
}
