<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Profession::orderByDesc('id')->get();

        return view('profession.profession', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profession.add-profession');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255'
        ]);

        $profession = new Profession();
        $profession->name = $request->name;
        $profession->save();

        return redirect()->route('profession.index')->with(['message' => "Profession create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profession = Profession::find($id);
        return view('profession.delete-profession', ['id' => $id, 'model' => $profession]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profession = Profession::find($id);
        if(!$profession){
            abort(404);
        }
        return view('profession.edit-profession', ['model' => $profession]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $profession = Profession::find($id);
        if (!$profession) {
            abort(404);
        }
        $profession->name = $request->name;
        $profession->update();

        return redirect()->route('profession.index')->with(['message' => "Profession update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profession = Profession::find($id);
        if(!$profession){
            abort(404);
        }
        
        $profession->delete();

        return redirect()->route('profession.index')->with(['message' => 'Profession delete successfully']);
    }
}
