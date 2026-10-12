
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExhibitController extends Controller
{
    public function show($id)
    {
        return view('exhibits.show', [
            'id' => $id
        ]);
    }
}
