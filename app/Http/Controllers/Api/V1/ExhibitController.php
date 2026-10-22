<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExhibitResource;
use App\Models\Exhibit;
use Illuminate\Http\Request;

class ExhibitController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'q'        => ['nullable', 'string', 'max:100'],
            'hall'     => ['nullable', 'integer', 'exists:halls,id'],
            'sort'     => ['nullable', 'in:title,year,-year'],
            'per_page' => ['nullable', 'integer', 'between:1,50'],
        ]);

        $sort = $data['sort'] ?? 'title';

        $exhibits = Exhibit::with('hall')
            ->when($data['q'] ?? null, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->when($data['hall'] ?? null, function ($query, $hallId) {
                return $query->where('hall_id', $hallId);
            })
            ->orderBy(ltrim($sort, '-'), str_starts_with($sort, '-') ? 'desc' : 'asc')
            ->paginate($data['per_page'] ?? 10)
            ->withQueryString();

        return ExhibitResource::collection($exhibits);
    }

    public function show(Exhibit $exhibit)
    {
        return new ExhibitResource($exhibit->load('hall'));
    }
}