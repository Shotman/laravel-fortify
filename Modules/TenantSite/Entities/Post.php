<?php

namespace Modules\TenantSite\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use NunoMazer\Samehouse\BelongsToTenants;

class Post extends TenantModel
{
    protected $fillable = [
        "title","content"
    ];
}
