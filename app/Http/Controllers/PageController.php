<?php

namespace App\Http\Controllers;

use App\Models\Exhibit;
use App\Models\Hall;
use Illuminate\Support\Facades\Cache; 

class PageController extends Controller
{
    public function home()
    {
        $data = Cache::remember('home.museum.stats', now()->addMinutes(10), function () {
            return [
                'total' => Exhibit::count(),
                'halls' => Hall::withCount('exhibits')->get(),
                'latest' => Exhibit::with('hall')->latest()->take(6)->get(),
            ];
        });

        return view('home', $data);
    }

    public function about()
    {
        return view('about');
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function rules()
    {
        return view('rules');
    }
}