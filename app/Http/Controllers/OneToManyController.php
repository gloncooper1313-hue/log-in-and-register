<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class OneToManyController extends Controller
{
    public function index()
    {
        $departments = Department::with('students')->get();

        return view('one-to-many', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'department' => 'required|string|max:255',
            'student' => 'required|string|max:255',
        ]);

        $department = Department::firstOrCreate([
            'name' => $data['department']
        ]);

        $department->students()->create([
            'name' => $data['student']
        ]);

       return redirect()
    ->route('one-to-many.index')
    ->with('success', 'Department and employees added successfully!');;
    }
}