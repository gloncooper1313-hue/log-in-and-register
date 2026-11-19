
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register - Relationship System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container min-vh-100 d-flex align-items-center justify-content-center">

    <div class="card shadow border-0 rounded-4"
         style="max-width: 500px; width: 100%;">

        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">

                <h2 class="fw-bold text-success">Create Account</h2>

                <p class="text-muted">
                    Register to access the system
                </p>

            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST"
                  onsubmit="disableSubmit(this)">

                @csrf

                <div class="mb-3">

                    <label class="form-label">Full Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           placeholder="Enter your name"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Email Address</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           placeholder="Enter your email"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Password</label>

                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Minimum 8 characters"
                           required>

                </div>

                <div class="mb-4">

                    <label class="form-label">Confirm Password</label>

                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Confirm your password"
                           required>

                </div>

                <button type="submit"
                        class="btn btn-success btn-lg w-100 submit-btn">

                    Create Account

                </button>

            </form>

            <div class="text-center mt-4">

                <p class="mb-0 text-muted">

                    Already have an account?

                    <a href="{{ route('login') }}"
                       class="text-decoration-none fw-semibold">

                        Login

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
        button.innerText = 'Creating account...';
    }
}
</script>

</body>
</html>
