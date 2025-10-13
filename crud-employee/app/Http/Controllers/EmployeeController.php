<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $employees = Employee::all();
        return view('indexEmployee', compact('employees'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addEmployee');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'age' => 'required',
        ]);

        Employee::create($validated);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee, $id)
    {
        $employee = Employee::find($id);
        return view('editEmployee', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'age' => 'required',
        ]);

        Employee::where('id', $id)->update($validated);
        return redirect('/employee');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Employee::where('id', $id)->delete();
        return redirect()->route('index');
    }
}

