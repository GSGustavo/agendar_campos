<?php

namespace App\Http\Middleware;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use IntlDateFormatter;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request)
    {
        $date = new DateTime();
        $formatter = new IntlDateFormatter('pt_BR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
        $today = $formatter->format($date);

        $user = null;

        if (Auth::user()) {
            $user = [];
            $user['name'] = Auth::user()->name;
        }

        return array_merge(parent::share($request), [
        
            'appName' => config('app.name'),
            'appVersion' => config('app.version'),
            'today' => $today,
            'user' => $user,
            'lastUpdate' => config("app.lastupdate"),
            'sociallinktree' => config("app.sociallinktree"),
            'routedashboard' => route("dashboard.index"),
            'routecampos' => route("campos.index"),
            'routeusers' => route('users.index'),
        ]);
    }
}
