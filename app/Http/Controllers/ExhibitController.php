<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExhibitController extends Controller
{
    public function index()
    {
        $items = config('catalog.items', config('catalog', []));

        return view('museum.index', ['items' => $items]);
    }

    public function show(int $id)
    {
        $items = config('catalog.items', config('catalog', []));

        if (!isset($items[$id])) {
            abort(404);
        }

        $item = $items[$id];

        return view('museum.show', ['id' => $id, 'item' => $item]);
    }
}