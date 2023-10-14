<?php

namespace App\Http\Controllers;

use App\Models\CallHistory;
use Illuminate\Http\Request;

class CallHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = CallHistory::orderByDesc('id')->get();

        return view('call_history.call_history', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('call_history.add-call_history');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'doctor_id' => 'required|integer',
			'patient_id' => 'required|integer',
			'duration' => 'required|integer'
        ]);

        $call_history = new CallHistory();
        $call_history->doctor_id = $request->doctor_id;
		$call_history->patient_id = $request->patient_id;
		$call_history->duration = $request->duration;
        $call_history->save();

        return redirect()->route('call_history.index')->with(['message' => "CallHistory create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $call_history = CallHistory::find($id);
        return view('call_history.delete-call_history', ['id' => $id, 'model' => $call_history]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $call_history = CallHistory::find($id);
        if(!$call_history){
            abort(404);
        }
        return view('call_history.edit-call_history', ['model' => $call_history]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'doctor_id' => 'required|integer',
			'patient_id' => 'required|integer',
			'duration' => 'required|integer'
        ]);

        $call_history = CallHistory::find($id);
        if (!$call_history) {
            abort(404);
        }
        $call_history->doctor_id = $request->doctor_id;
		$call_history->patient_id = $request->patient_id;
		$call_history->duration = $request->duration;
        $call_history->update();

        return redirect()->route('call_history.index')->with(['message' => "CallHistory update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $call_history = CallHistory::find($id);
        if(!$call_history){
            abort(404);
        }
        
        $call_history->delete();

        return redirect()->route('call_history.index')->with(['message' => 'CallHistory delete successfully']);
    }
}
