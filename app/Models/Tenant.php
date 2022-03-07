<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Tenant
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tenant query()
 * @mixin \Eloquent
 */
class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    protected static function booted()
    {
        static::saving(function ($tenant) {
            $tenant->slug = Str::slug($tenant->name);
        });
    }

}
