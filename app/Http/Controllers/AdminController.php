<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Admin::orderByDesc('id')->get();

        return view('admin.admin', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add-admin');
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
			'email' => 'required|string|max:255'
        ]);

        $admin = new Admin();
        $admin->firstname = $request->firstname;
		$admin->lastname = $request->lastname;
		$admin->password = $request->password;
		$admin->email = $request->email;
        $admin->save();

        return redirect()->route('admin.index')->with(['message' => "Admin create successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::find($id);
        return view('admin.delete-admin', ['id' => $id, 'model' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::find($id);
        if(!$admin){
            abort(404);
        }
        return view('admin.edit-admin', ['model' => $admin]);
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
			'email' => 'required|string|max:255'
        ]);

        $admin = Admin::find($id);
        if (!$admin) {
            abort(404);
        }
        $admin->firstname = $request->firstname;
		$admin->lastname = $request->lastname;
		$admin->password = $request->password;
		$admin->email = $request->email;
        $admin->update();

        return redirect()->route('admin.index')->with(['message' => "Admin update successfully"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::find($id);
        if(!$admin){
            abort(404);
        }
        
        $admin->delete();

        return redirect()->route('admin.index')->with(['message' => 'Admin delete successfully']);
    }
}
