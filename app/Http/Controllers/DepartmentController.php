<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departments = Department::orderBy('id', 'desc')->paginate(8); // Paginate with 15 items per page

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $departments = Department::all();
        return view('departments.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255', // Ensure name is a string
            'address' => 'required|string|max:255', // Address is also a string
            'email' => 'required|email|unique:departments,email', // Validate email format and uniqueness
            'phone' => [
                'required',
                'string',
                'max:255',
                // Regex to validate Vietnamese phone number format
                'regex:/^(0|\+84)(\d{1})(\d{8,9})$/',
            ],
            'logo' => 'required|string|max:255',
            'website' => 'required|string', // 
            'parent_id' => 'nullable|exists:departments,id', // Ensure parent_id exists in departments table

        ]);
        
        Department::create($validateData);
        
        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
