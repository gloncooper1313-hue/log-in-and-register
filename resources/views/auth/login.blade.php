
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Relationship System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-dark">

<div class="container min-vh-100 d-flex align-items-center justify-content-center">

    <div class="card shadow border-0 rounded-4" style="max-width: 450px; width: 100%;">

        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">

                <h2 class="fw-bold text-primary">Welcome Back!</h2>

                <p class="text-muted">
                    Login to access your Relationship Management System
                </p>

            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST"
                  onsubmit="disableSubmit(this)">

                @csrf

                <div class="mb-3">

                    <label class="form-label">Email Address</label>

                    <input type="email"
                           name="email"
                           class="form-control form-control-lg"
                           value="{{ old('email') }}"
                           placeholder="Enter your email"
                           required>

                </div>

                <div class="mb-4">

                    <label class="form-label">Password</label>

                    <input type="password"
                           name="password"
                           class="form-control form-control-lg"
                           placeholder="Enter your password"
                           required>

                </div>

                <button type="submit"
                        class="btn btn-primary btn-lg w-100 submit-btn">

                    Login

                </button>

            </form>

            <div class="text-center mt-4">

                <p class="text-muted mb-0">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                       class="text-decoration-none fw-semibold">
                        Register
                    </a>
                </p>

            </div>

        </div>

    </div>

</div>

<script>
function disableSubmit(form) {
    const button = form.querySelector('.submit-btn');

    if (button) {
        button.disabled = true;
        button.innerText = 'Please wait...';
    }
}
</script>

</body>
</html>
