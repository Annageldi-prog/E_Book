<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable =['name'];

    public $timestamps = false;

    protected $guarded = ['id'];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
