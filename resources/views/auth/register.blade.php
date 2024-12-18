<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
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
            /* Make sure the form and image are next to each other */
            align-items: stretch;
            /* This will stretch the form and image to the full height */
            height: 100vh;
            /* Full viewport height */
            padding: 0;
        }

        .register-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            /* Adjusting the width of the registration box */
            height: 100vh;
            /* Set height to 100% of the viewport height */
            overflow-y: auto;
            /* Allow scrolling if content exceeds height */
        }

        .register-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #134802;
            /* Dark green */
        }

        .form-group input {
            margin-bottom: 15px;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .btn-register {
            background-color: #f0e68c;
            color: #134802;
            width: 100%;
            padding: 10px;
            border-radius: 30px;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: #d1c94c;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #134802;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Fullscreen image side */
        .left-side {
            background: url('/img/baground.jpeg') no-repeat center center;
            background-size: cover;
            /* Ensure the background image covers the entire screen */
            width: 50%;
            /* Set width to 50% */
            height: 100vh;
            /* Full viewport height */
            border-radius: 10px 0 0 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .left-side {
                display: none;
                /* Hide image on smaller screens */
            }

            .register-form {
                max-width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Left side with image (background) -->
        <div class="left-side"></div>

        <!-- Right side with form -->
        <div class="register-form">
            <h2>Registrasi</h2>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="text" name="name" placeholder="Nama Usaha" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="nama_pemilik" placeholder="Nama Pemilik" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                        class="form-control">
                </div>

                <button type="submit" class="btn-register">Register</button>
            </form>

            <div class="login-link">
                <p>Sudah Punya Akun? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
