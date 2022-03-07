<?php

namespace App\Http\Middleware;

use App\Models\Tenant;

class TenantManager
{

    public function loadTenant(string $tenantSlug)
    {
        return Tenant::whereSlug(($tenantSlug))->first();
    }
}
