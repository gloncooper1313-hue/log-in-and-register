<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class ManyToManyController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')
            ->whereHas('courses')
            ->get();

        return view('many-to-many', compact('students'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student' => 'required|string|max:255',
            'courses' => 'required|array|min:1',
            'courses.*' => 'required|string|max:255',
        ]);

        $student = Student::create([
            'name' => $data['student']
        ]);

        foreach ($data['courses'] as $courseName) {
            $course = Course::firstOrCreate([
                'course_name' => $courseName
            ]);

            $student->courses()->attach($course->id);
        }

        return redirect()
    ->route('many-to-many.index')
    ->with('success', 'Student and courses added successfully!');
    }
}