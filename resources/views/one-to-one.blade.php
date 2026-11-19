
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One-to-One Relationship | Laravel</title>

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

        <h2>One-to-One Relationship</h2>
        <h3>Student Profile Management</h3>

        
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

        
        <h3>Add Student Profile</h3>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Enter Student Name"
                       required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text"
                       id="address"
                       name="address"
                       value="{{ old('address') }}"
                       placeholder="Enter Address"
                       required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text"
                       id="phone"
                       name="phone"
                       value="{{ old('phone') }}"
                       placeholder="Enter Phone Number"
                       required>
            </div>

            <button type="submit" class="btn btn-primary submit-btn">Add Student Profile</button>
        </form>

        
        <h3>Student Profiles</h3>

        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->profile->address }}</td>
                        <td>{{ $student->profile->phone }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            No student profiles found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</body>
</html>
