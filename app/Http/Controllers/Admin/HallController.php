<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Http\Requests\StoreHallRequest;
use App\Http\Requests\UpdateHallRequest;

class HallController extends Controller
{
    public function index()
    {
        $halls = Hall::withCount('exhibits')->latest()->paginate(15);
        return view('admin.halls.index', compact('halls'));
    }

    public function create()
    {
        return view('admin.halls.create');
    }

    public function store(StoreHallRequest $request)
    {
        Hall::create($request->validated());

        return redirect()->route('admin.halls.index')
            ->with('success', 'Зал успешно добавлен');
    }

    public function edit(Hall $hall)
    {
        return view('admin.halls.edit', compact('hall'));
    }

    public function update(UpdateHallRequest $request, Hall $hall)
    {
        $hall->update($request->validated());

        return redirect()->route('admin.halls.index')
            ->with('success', 'Изменения зала сохранены');
    }

    public function destroy(Hall $hall)
    {
        if ($hall->exhibits()->exists()) {
            return back()->with('error', 'Нельзя удалить зал: в нем еще есть экспонаты!');
        }

        $hall->delete();

        return back()->with('success', 'Зал удален');
    }
}