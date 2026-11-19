
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Many-to-Many Relationship | Laravel</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2, h3 {
            text-align: center;
            color: #333;
        }

        .navbar {
            text-align: center;
            margin-bottom: 30px;
        }

        .navbar a {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .navbar a:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .course-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        .course-box h4 {
            margin-top: 0;
            color: #333;
        }

        .checkbox-group {
            margin-bottom: 12px;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: normal;
            cursor: pointer;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .course-tag {
            display: inline-block;
            background-color: #e3f2fd;
            color: #0056b3;
            padding: 5px 10px;
            margin: 3px;
            border-radius: 5px;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .container {
                width: auto;
                margin: 15px;
                padding: 15px;
            }

            .navbar a {
                padding: 8px 10px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        
        <h2>Many-to-Many Relationship</h2>
        <h3>Student Course Enrollment Management</h3>

        
        <div class="navbar">
            <a href="{{ route('users.index') }}">
                One-to-One
            </a>

            <a href="{{ route('one-to-many.index') }}">
                One-to-Many
            </a>

            <a href="{{ route('many-to-many.index') }}">
                Many-to-Many
            </a>
        </div>

        
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @endif

        
        <h3>Add Student Enrollment</h3>

        <form action="{{ route('many-to-many.store') }}" method="POST">
            @csrf

            <!-- Student Name -->
            <div class="form-group">
                <label for="student">Student Name</label>

                <input type="text"
                       id="student"
                       name="student"
                       value="{{ old('student') }}"
                       placeholder="Enter Student Name"
                       required>
            </div>

            
            <div class="course-box">

                <h4>Select Courses</h4>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox"
                               name="courses[]"
                               value="Programming"
                               {{ in_array('Programming', old('courses', [])) ? 'checked' : '' }}>
                        Programming
                    </label>
                </div>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox"
                               name="courses[]"
                               value="Database"
                               {{ in_array('Database', old('courses', [])) ? 'checked' : '' }}>
                        Database
                    </label>
                </div>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox"
                               name="courses[]"
                               value="Networking"
                               {{ in_array('Networking', old('courses', [])) ? 'checked' : '' }}>
                        Networking
                    </label>
                </div>

            </div>

        
            <button type="submit" class="btn btn-primary submit-btn">
                Add Enrollment
            </button>

        </form>

        
        <h3>Student Enrollments</h3>

        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Enrolled Courses</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>

                        <td>
                            @foreach ($student->courses as $course)
                                <span class="course-tag">
                                    {{ $course->course_name }}
                                </span>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            No student enrollments found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</body>
</html>
