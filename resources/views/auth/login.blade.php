<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Platform Monitoring Risiko Supply Chain</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>

        body{

            background:linear-gradient(rgba(13,110,253,.85),rgba(13,110,253,.85)),
            url('https://images.unsplash.com/photo-1519003722824-194d4455a60c?auto=format&fit=crop&w=1600&q=80');

            background-size:cover;
            background-position:center;

            height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

        }

        .login-card{

            width:420px;

            border:none;

            border-radius:18px;

            overflow:hidden;

            box-shadow:0 15px 40px rgba(0,0,0,.25);

        }

        .logo{

            font-size:55px;

            color:#0d6efd;

        }

        .form-control{

            height:48px;

            border-radius:10px;

        }

        .btn-login{

            height:48px;

            border-radius:10px;

            font-size:17px;

            font-weight:600;

        }

        .title{

            font-weight:bold;

            color:#0d6efd;

        }

    </style>

</head>

<body>

<div class="card login-card">

    <div class="card-body p-5">

        <div class="text-center mb-4">

            <i class="fas fa-globe-americas logo"></i>

            <h3 class="title mt-3">

                Supply Chain Risk

            </h3>

            <p class="text-muted">

                Platform Monitoring Risiko Supply Chain

            </p>

        </div>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        <form action="/login" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Email

                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan Email"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Password

                </label>

                <div class="input-group">

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Masukkan Password"
                        required>

                    <button
                        class="btn btn-outline-secondary"
                        type="button"
                        onclick="togglePassword()">

                        <i class="fas fa-eye" id="eyeIcon"></i>

                    </button>

                </div>

            </div>

            <button
                type="submit"
                class="btn btn-primary w-100 btn-login">

                <i class="fas fa-right-to-bracket"></i>

                Login

            </button>

        </form>

        <hr>

        <div class="text-center">

            Belum punya akun?

            <a href="/register" class="text-decoration-none">

                Register

            </a>

        </div>

    </div>

</div>

<script>

function togglePassword(){

    let password=document.getElementById('password');

    let icon=document.getElementById('eyeIcon');

    if(password.type==="password"){

        password.type="text";

        icon.classList.remove('fa-eye');

        icon.classList.add('fa-eye-slash');

    }else{

        password.type="password";

        icon.classList.remove('fa-eye-slash');

        icon.classList.add('fa-eye');

    }

}

</script>

</body>

</html>