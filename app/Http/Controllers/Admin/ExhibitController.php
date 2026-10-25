<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exhibit;
use App\Models\Hall;
use App\Http\Requests\StoreExhibitRequest;
use App\Http\Requests\UpdateExhibitRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Notifications\NewExhibitNotification;
use Illuminate\Support\Facades\Auth;
class ExhibitController extends Controller
{
    public function downloadCatalog()
    {
        $exhibits = Exhibit::all();
        $pdf = Pdf::loadView('pdf.catalog', compact('exhibits'));
        return $pdf->download('museum-catalog.pdf');
    }

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'hall_id' => 'required|exists:halls,id',
            'year' => 'nullable|integer',
            'description' => 'nullable|string',
            'is_published' => 'nullable|boolean',
            'cover' => 'nullable|image|max:2048',
            'attachment' => 'nullable|file|max:5120',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        Exhibit::create($validated);
        Auth::user()->notify(new NewExhibitNotification($exhibit));
        return redirect()->route('admin.exhibits.index')->with('success', 'Экспонат успешно создан!');
    }

    public function edit(Exhibit $exhibit)
    {
        $halls = Hall::orderBy('name')->get();
        return view('admin.exhibits.edit', compact('exhibit', 'halls'));
    }

    public function update(UpdateExhibitRequest $request, Exhibit $exhibit)
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $exhibit->update($validated);

        return redirect()->route('admin.exhibits.index')
            ->with('success', 'Изменения сохранены');
    }

    public function destroy(Exhibit $exhibit)
    {
        $exhibit->delete();

        return back()->with('success', 'Экспонат удален');
    }
}
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Museum API Documentation",
 *      description="Документация REST API для музейного проекта (ЛР №16)"
 * )
 * @OA\Server(
 *      url="http://127.0.0.1:8000",
 *      description="Локальный сервер"
 * )
 */
class ExhibitApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/exhibits",
     *      operationId="getExhibitsList",
     *      tags={"Exhibits"},
     *      summary="Получить список всех экспонатов",
     *      @OA\Response(response=200, description="Успешный ответ")
     * )
     */
    public function index()
    {
        return response()->json(Exhibit::all());
    }
}