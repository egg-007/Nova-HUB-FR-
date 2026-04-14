<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'developer_id',
        'title',
        'description',
        'price',
        'status',
        'image',
        'release_date',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'release_date' => 'date',
    ];

    public function developer(){
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function owners(){
        return $this->belongsToMany(User::class, 'libraries','game_id','user_id')->withPivot('purchased_at')->withTimestamps();
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function views(){
        return $this->hasMany(GameView::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
