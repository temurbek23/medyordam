<?php

namespace App\Http\Controllers;

use App\Models\FirstAid;
use Illuminate\Http\Request;

class FirstAidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = FirstAid::orderByDesc('id')->get();

        return view('first_aid.first_aid', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('first_aid.add-first_aid');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'case' => 'required|string|max:255',
			'photo' => 'required|mimes:jpg,png,webp',
			'treatment' => 'required|string|max:255'
        ]);

        $first_aid = new FirstAid();
        $first_aid->case = $request->case;
		if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($first_aid->photo) {
                $oldFilePath = 'uploads/photo/'.basename($first_aid->photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/photo", $filename);
            $first_aid->photo = asset("uploads/photo/$filename");
        }
		$first_aid->treatment = $request->treatment;
        $first_aid->save();

        return redirect()->route('first_aid.index')->with(['message' => "FirstAid create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $first_aid = FirstAid::find($id);
        return view('first_aid.delete-first_aid', ['id' => $id, 'model' => $first_aid]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $first_aid = FirstAid::find($id);
        if(!$first_aid){
            abort(404);
        }
        return view('first_aid.edit-first_aid', ['model' => $first_aid]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'case' => 'required|string|max:255',
			'photo' => 'required|mimes:jpg,png,webp',
			'treatment' => 'required|string|max:255'
        ]);

        $first_aid = FirstAid::find($id);
        if (!$first_aid) {
            abort(404);
        }
        $first_aid->case = $request->case;
		if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($first_aid->photo) {
                $oldFilePath = 'uploads/photo/'.basename($first_aid->photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/photo", $filename);
            $first_aid->photo = asset("uploads/photo/$filename");
        }
		$first_aid->treatment = $request->treatment;
        $first_aid->update();

        return redirect()->route('first_aid.index')->with(['message' => "FirstAid update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $first_aid = FirstAid::find($id);
        if(!$first_aid){
            abort(404);
        }
        if ($first_aid->photo) {
            $oldFilePath = 'uploads/photo/'.basename($first_aid->photo);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        $first_aid->delete();

        return redirect()->route('first_aid.index')->with(['message' => 'FirstAid delete successfully']);
    }
}
