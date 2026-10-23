<?php

namespace App\Http\Controllers;

use App\Models\Exhibit;
use App\Models\Hall;

class CatalogController extends Controller
{
    public function index()
    {
        $exhibits = Exhibit::with('hall')->latest()->paginate(15);
        return view('catalog.index', compact('exhibits'));
    }

    public function show(Exhibit $exhibit)
    {
        return view('catalog.show', compact('exhibit'));
    }
}