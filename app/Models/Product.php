<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = [
        'name',
        'id_group'
    ];

    public $timestamps = false;

    public function price(): HasOne
    {
        return $this->hasOne(Price::class, 'id_product');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_group');
    }
}