<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use NunoMazer\Samehouse\Facades\Landlord;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IdentifyCustomer
{
    /**
     * @var TenantManager
     */
    protected $tenantManager;

    public function __construct(TenantManager $tenantManager)
    {
        $this->tenantManager = $tenantManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $tenant = $this->tenantManager->loadTenant(Route::input('customer_name'));
        if (!is_null($tenant)) {
            Landlord::addTenant('tenant_id', $tenant->id);
            session(["currentTenant" => $tenant]);
            return $next($request);
        }

        throw new NotFoundHttpException;
    }
}
