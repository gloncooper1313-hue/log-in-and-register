
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-secondary">

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            Relationship System
        </a>

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit" class="btn btn-outline-light">
                Logout
            </button>

        </form>

    </div>

</nav>

<div class="container py-5">

    <div class="mb-4">

        <h2 class="fw-bold">
            Welcome, {{ Auth::user()->name }}!
        </h2>

        <p class="text-muted">
            Choose a relationship module below.
        </p>

    </div>

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card border-0 shadow h-100">

                <div class="card-body p-4">

                    <h4 class="text-primary">
                        One-to-One
                    </h4>

                    <p>
                        Manage users and their profiles.
                    </p>

                    <a href="{{ route('users.index') }}"
                       class="btn btn-primary">

                        Open Module

                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow h-100">

                <div class="card-body p-4">

                    <h4 class="text-success">
                        One-to-Many
                    </h4>

                    <p>
                        Manage departments and employees.
                    </p>

                    <a href="{{ route('one-to-many.index') }}"
                       class="btn btn-success">

                        Open Module

                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow h-100">

                <div class="card-body p-4">

                    <h4 class="text-info">
                        Many-to-Many
                    </h4>

                    <p>
                        Manage students and their courses.
                    </p>

                    <a href="{{ route('many-to-many.index') }}"
                       class="btn btn-info text-white">

                        Open Module

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>