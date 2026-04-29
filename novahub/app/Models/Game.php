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
        'is_recommended',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'release_date' => 'date',
    ];

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function owners()
    {
        return $this->belongsToMany(User::class, 'libraries', 'game_id', 'user_id')->withPivot('purchased_at')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function views()
    {
        return $this->hasMany(GameView::class);
    }

    public function averageRating()
    {
        return round($this->reviews()->avg('rating'), 1) ?: 0;
    }

    public function requirements()
    {
        return $this->hasMany(GameRequirement::class);
    }

    public function minSpecs()
    {
        return $this->requirements()->where('type', 'minimum')->first();
    }

    public function recSpecs()
    {
        return $this->requirements()->where('type', 'recommended')->first();
    }
}
