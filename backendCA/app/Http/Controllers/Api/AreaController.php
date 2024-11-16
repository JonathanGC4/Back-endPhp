<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        return Area::all();
    }

    public function store(Request $request)
    {
        $request->validate(['nombre_area' => 'required|string|max:50']);
        return Area::create($request->all());
    }

    public function show($id)
    {
        return Area::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);
        $area->update($request->all());
        return $area;
    }

    public function destroy($id)
    {
        Area::destroy($id);
        return response()->noContent();
    }
}
