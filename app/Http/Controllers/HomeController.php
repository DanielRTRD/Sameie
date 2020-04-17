<?php

namespace Sameie\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subscriptions = auth()->user()->subscriptions;
        return view('dashboard', compact('subscriptions'));
    }

    public function locale($locale)
    {
        if (in_array($locale, array_keys(config('app.locales')))) {
            App::setLocale($locale);
            Carbon::setLocale($locale);
        }
        return redirect()->back();
    }
}
