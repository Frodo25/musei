<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function store(StoreExhibitRequest $request)
    {
    Exhibit::create($request->validated() + ['user_id' => $request->user()->id]);

    return redirect()->route('admin.exhibits.index')
        ->with('success', 'Экспонат успешно добавлен');
    $data = $request->validated();

    if ($request->hasFile('cover')) {
        $data['cover'] = $request->file('cover')->store('covers', 'public');
    }

    Exhibit::create($data + ['user_id' => $request->user()->id]);

    return redirect()->route('admin.exhibits.index')->with('success', 'Экспонат успешно добавлен');
}

public function update(UpdateExhibitRequest $request, Exhibit $exhibit)
{
    Gate::authorize('update', $exhibit);
    $data = $request->validated();

    if ($request->hasFile('cover')) {
        Storage::disk('public')->delete($exhibit->cover ?? '');
        $data['cover'] = $request->file('cover')->store('covers', 'public');
    }

    $exhibit->update($data);

    return redirect()->route('admin.exhibits.index')->with('success', 'Изменения сохранены');
    }
    public function destroy(Exhibit $exhibit){
    Gate::authorize('delete', $exhibit);
    Storage::disk('public')->delete($exhibit->cover ?? '');
    $exhibit->delete();

    return back()->with('success', 'Экспонат удален');
    }
}