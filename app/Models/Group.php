<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model
{
    protected $fillable = [
        'name',
        'id_parent'
    ];

    public $timestamps = false;

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_parent');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Group::class, 'id_parent');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id_group');
    }

    public function getAllChildrenIds(): array
    {
        $ids = [];

        foreach ($this->children as $child) {

            $ids[] = $child->id;

            $ids = array_merge(
                $ids,
                $child->getAllChildrenIds()
            );
        }

        return $ids;
    }
}