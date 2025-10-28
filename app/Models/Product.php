<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{

    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'title',
        'code',
        'description',
        'price',
        'category_id',
        'author_id',
        'series_id',
        'image',
    ];

    protected $guarded = ['id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

}
