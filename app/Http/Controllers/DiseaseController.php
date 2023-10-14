<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Disease::orderByDesc('id')->get();

        return view('disease.disease', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('disease.add-disease');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
			'treatment' => 'required|string|max:255'
        ]);

        $disease = new Disease();
        $disease->name = $request->name;
		$disease->treatment = $request->treatment;
        $disease->save();

        return redirect()->route('disease.index')->with(['message' => "Disease create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $disease = Disease::find($id);
        return view('disease.delete-disease', ['id' => $id, 'model' => $disease]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $disease = Disease::find($id);
        if(!$disease){
            abort(404);
        }
        return view('disease.edit-disease', ['model' => $disease]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
			'treatment' => 'required|string|max:255'
        ]);

        $disease = Disease::find($id);
        if (!$disease) {
            abort(404);
        }
        $disease->name = $request->name;
		$disease->treatment = $request->treatment;
        $disease->update();

        return redirect()->route('disease.index')->with(['message' => "Disease update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $disease = Disease::find($id);
        if(!$disease){
            abort(404);
        }
        
        $disease->delete();

        return redirect()->route('disease.index')->with(['message' => 'Disease delete successfully']);
    }
}
