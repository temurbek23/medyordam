<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Patient::orderByDesc('id')->get();

        return view('patient.patient', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patient.add-patient');
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
			'contact' => 'required|string|max:255'
        ]);

        $patient = new Patient();
        $patient->firstname = $request->firstname;
		$patient->lastname = $request->lastname;
		$patient->password = $request->password;
		$patient->email = $request->email;
		$patient->contact = $request->contact;
        $patient->save();

        return redirect()->route('patient.index')->with(['message' => "Patient create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::find($id);
        return view('patient.delete-patient', ['id' => $id, 'model' => $patient]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::find($id);
        if(!$patient){
            abort(404);
        }
        return view('patient.edit-patient', ['model' => $patient]);
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
			'contact' => 'required|string|max:255'
        ]);

        $patient = Patient::find($id);
        if (!$patient) {
            abort(404);
        }
        $patient->firstname = $request->firstname;
		$patient->lastname = $request->lastname;
		$patient->password = $request->password;
		$patient->email = $request->email;
		$patient->contact = $request->contact;
        $patient->update();

        return redirect()->route('patient.index')->with(['message' => "Patient update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::find($id);
        if(!$patient){
            abort(404);
        }
        
        $patient->delete();

        return redirect()->route('patient.index')->with(['message' => 'Patient delete successfully']);
    }
}
