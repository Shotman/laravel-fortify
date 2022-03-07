<?php

namespace Modules\TenantSite\Entities;

use Illuminate\Database\Eloquent\Model;
use NunoMazer\Samehouse\BelongsToTenants;

abstract class TenantModel extends Model
{
    use BelongsToTenants;

}
