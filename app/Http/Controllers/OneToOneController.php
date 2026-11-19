<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Profile;
use Illuminate\Http\Request;

class OneToOneController extends Controller
{
    public function index()
    {
        $students = Student::with('profile')
            ->whereHas('profile')
            ->get();

        return view('one-to-one', compact('students'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
        ]);

        $student = Student::create([
            'name' => $data['name']
        ]);

        $student->profile()->create([
            'address' => $data['address'],
            'phone' => $data['phone'],
        ]);

         return redirect()
        ->route('users.index')
        ->with('success', 'User and profile added successfully!');
    }
}