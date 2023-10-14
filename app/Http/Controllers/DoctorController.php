<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Doctor::orderByDesc('id')->get();

        return view('doctor.doctor', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctor.add-doctor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'firstname' => 'required|string|max:255',
			'lastname' => 'required|string|max:255',
			'password' => 'required|string|max:255',
			'email' => 'required|string|max:255',
			'contact' => 'required|string|max:255',
			'photo' => 'required|',
			'about' => 'required|string|max:255',
			'education' => 'required|string|max:255',
			'practice' => 'required|string|max:255',
			'residency' => 'required|string|max:255'
        ]);

        $doctor = new Doctor();
        $doctor->firstname = $request->firstname;
		$doctor->lastname = $request->lastname;
		$doctor->password = $request->password;
		$doctor->email = $request->email;
		$doctor->contact = $request->contact;
		if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($doctor->photo) {
                $oldFilePath = 'uploads/photo/'.basename($doctor->photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/photo", $filename);
            $doctor->photo = asset("uploads/photo/$filename");
        }
		$doctor->about = $request->about;
		$doctor->education = $request->education;
		$doctor->practice = $request->practice;
		$doctor->residency = $request->residency;
        $doctor->save();

        return redirect()->route('doctor.index')->with(['message' => "Doctor create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = Doctor::find($id);
        return view('doctor.delete-doctor', ['id' => $id, 'model' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::find($id);
        if(!$doctor){
            abort(404);
        }
        return view('doctor.edit-doctor', ['model' => $doctor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
			'lastname' => 'required|string|max:255',
			'password' => 'required|string|max:255',
			'email' => 'required|string|max:255',
			'contact' => 'required|string|max:255',
			'photo' => 'required|',
			'about' => 'required|string|max:255',
			'education' => 'required|string|max:255',
			'practice' => 'required|string|max:255',
			'residency' => 'required|string|max:255'
        ]);

        $doctor = Doctor::find($id);
        if (!$doctor) {
            abort(404);
        }
        $doctor->firstname = $request->firstname;
		$doctor->lastname = $request->lastname;
		$doctor->password = $request->password;
		$doctor->email = $request->email;
		$doctor->contact = $request->contact;
		if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $filename = time(). "_" . $file->getClientOriginalName();
            if ($doctor->photo) {
                $oldFilePath = 'uploads/photo/'.basename($doctor->photo);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file->move("uploads/photo", $filename);
            $doctor->photo = asset("uploads/photo/$filename");
        }
		$doctor->about = $request->about;
		$doctor->education = $request->education;
		$doctor->practice = $request->practice;
		$doctor->residency = $request->residency;
        $doctor->update();

        return redirect()->route('doctor.index')->with(['message' => "Doctor update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::find($id);
        if(!$doctor){
            abort(404);
        }
        if ($doctor->photo) {
            $oldFilePath = 'uploads/photo/'.basename($doctor->photo);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        $doctor->delete();

        return redirect()->route('doctor.index')->with(['message' => 'Doctor delete successfully']);
    }
}
