
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>One-to-Many Relationship | Laravel</title>

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
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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

        .department-box {
            background-color: #f8f9fa;
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
            border-left: 5px solid #007bff;
        }

        .department-box h4 {
            color: #007bff;
            margin-top: 0;
        }

        .department-box ul {
            padding-left: 25px;
        }

        .department-box li {
            padding: 5px 0;
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
    </style>
</head>

<body>

    <div class="container">

        
        <h2>One-to-Many Relationship</h2>
        <h3>Department and Student Management</h3>

        <!-- Navigation Bar -->
        <div class="navbar">
            <a href="{{ route('users.index') }}">One-to-One</a>
            <a href="{{ route('one-to-many.index') }}">One-to-Many</a>
            <a href="{{ route('many-to-many.index') }}">Many-to-Many</a>
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

        
        <h3>Add Student to Department</h3>

        <form action="{{ route('one-to-many.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="department">Department Name</label>
                <input type="text"
                       id="department"
                       name="department"
                       value="{{ old('department') }}"
                       placeholder="Enter Department Name"
                       required>
            </div>

            <div class="form-group">
                <label for="student">Student Name</label>
                <input type="text"
                       id="student"
                       name="student"
                       value="{{ old('student') }}"
                       placeholder="Enter Student Name"
                       required>
            </div>

            <button type="submit" class="btn btn-primary submit-btn">Add Student</button>
        </form>

        
        <h3>Departments and Students</h3>

        @forelse ($departments as $department)

            <div class="department-box">

                <h4>{{ $department->name }}</h4>

                <ul>
                    @forelse ($department->students as $student)
                        <li>{{ $student->name }}</li>
                    @empty
                        <li>No students in this department.</li>
                    @endforelse
                </ul>

            </div>

        @empty
            <p style="text-align: center;">
                No departments found.
            </p>
        @endforelse

        
        <h3>Department Student Records</h3>

        <table>
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Student Name</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($departments as $department)

                    @foreach ($department->students as $student)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>{{ $student->name }}</td>
                        </tr>
                    @endforeach

                @empty
                    <tr>
                        <td colspan="2">
                            No records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</body>
</html>
