<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the layout */
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            display: flex;
            justify-content: flex-start;
            align-items: stretch;
            height: 100vh;
            padding: 0;
        }

        .login-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            height: 100vh;
            overflow-y: auto;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #134802;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #2c6b3f;
            color: white;
        }

        .form-control:focus {
            border-color: #134802;
            box-shadow: 0 0 5px rgba(19, 72, 2, 0.5);
            outline: none;
        }

        .btn-login {
            background-color: #f0e68c;
            color: #134802;
            width: 100%;
            padding: 12px;
            border-radius: 30px;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #d1c94c;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #134802;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .left-side {
            background: url('/img/baground.jpeg') no-repeat center center;
            background-size: cover;
            width: 50%;
            height: 100vh;
            border-radius: 10px 0 0 10px;
        }

        @media (max-width: 768px) {
            .left-side {
                display: none;
            }

            .login-form {
                max-width: 100%;
                padding: 20px;
            }
        }

        .login-form img {
            display: block;
            margin: 20px auto;
            width: 200px;
            height: auto;
            margin-bottom: 20px;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="left-side"></div>

        <div class="login-form">
            <h2>Login</h2>

            <!-- Display success message if present -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <img src="/img/logo3.png" alt="Logo">

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <div class="register-link">
                <p>Belum Punya Akun? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
