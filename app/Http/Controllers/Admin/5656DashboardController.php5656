<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exhibit;
use App\Models\Hall;
use App\Http\Requests\StoreExhibitRequest;
use App\Http\Requests\UpdateExhibitRequest;

class ExhibitController extends Controller
{
    public function index()
    {
        $exhibits = Exhibit::with('hall')->latest()->paginate(15);
        return view('admin.exhibits.index', compact('exhibits'));
    }

    public function create()
    {
        $halls = Hall::orderBy('name')->get();
        return view('admin.exhibits.create', compact('halls'));
    }

    public function store(StoreExhibitRequest $request)
    {
        Exhibit::create($request->validated());

        return redirect()->route('admin.exhibits.index')
            ->with('success', 'Экспонат успешно добавлен');
    }

    public function edit(Exhibit $exhibit)
    {
        $halls = Hall::orderBy('name')->get();
        return view('admin.exhibits.edit', compact('exhibit', 'halls'));
    }

    public function update(UpdateExhibitRequest $request, Exhibit $exhibit)
    {
        $exhibit->update($request->validated());

        return redirect()->route('admin.exhibits.index')
            ->with('success', 'Изменения сохранены');
    }

    public function destroy(Exhibit $exhibit)
    {
        $exhibit->delete();

        return back()->with('success', 'Экспонат удален');
    }
}