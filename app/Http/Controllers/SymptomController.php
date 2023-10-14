<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Symptom::orderByDesc('id')->get();

        return view('symptom.symptom', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('symptom.add-symptom');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255'
        ]);

        $symptom = new Symptom();
        $symptom->name = $request->name;
        $symptom->save();

        return redirect()->route('symptom.index')->with(['message' => "Symptom create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $symptom = Symptom::find($id);
        return view('symptom.delete-symptom', ['id' => $id, 'model' => $symptom]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $symptom = Symptom::find($id);
        if(!$symptom){
            abort(404);
        }
        return view('symptom.edit-symptom', ['model' => $symptom]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $symptom = Symptom::find($id);
        if (!$symptom) {
            abort(404);
        }
        $symptom->name = $request->name;
        $symptom->update();

        return redirect()->route('symptom.index')->with(['message' => "Symptom update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $symptom = Symptom::find($id);
        if(!$symptom){
            abort(404);
        }
        
        $symptom->delete();

        return redirect()->route('symptom.index')->with(['message' => 'Symptom delete successfully']);
    }
}
