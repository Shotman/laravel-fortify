<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class TwoFactorAuthController extends Controller
{
    public function confirm(Request $request)
    {
        $confirmed = $request->user()->confirmTwoFactorAuth($request->code);

        if (!$confirmed) {
            return back()->withErrors('Invalid Two Factor Authentication code');
        }

        return redirect('home');
    }

    /**
     * @param Request $request
     * @param DisableTwoFactorAuthentication $disable
     * @param EnableTwoFactorAuthentication $enable
     * @return View|Factory
     */
    public function toggle(Request $request, DisableTwoFactorAuthentication $disable,EnableTwoFactorAuthentication $enable): Factory|View
    {
        if(!auth()->user()->two_factor_confirmed){
            $disable($request->user());
            $enable($request->user());
        }
        return view('profile.toggle-two-factor-authentication');
    }

    /**
     * @param Request $request
     * @param DisableTwoFactorAuthentication $disable
     * @return Redirector|RedirectResponse
     */
    public function abort(Request $request, DisableTwoFactorAuthentication $disable): Redirector|RedirectResponse
    {
        $disable($request->user());
        return redirect('home');
    }
}
