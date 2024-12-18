<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Stock - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <style>
        /* Apply Poppins font to the entire body and all elements */
        body {
            position: relative;
            background: url('{{ asset('img/baground.jpeg') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            color: white;
            font-family: 'Poppins', sans-serif;
            /* Ensuring all text uses Poppins */
        }

        /* Adding blur and softer green gradient */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                    rgba(88, 138, 70, 0.3) 20%,
                    /* Softer green with lower opacity */
                    rgba(48, 88, 34, 0.6) 100%
                    /* Darker green but with reduced opacity */
                );
            backdrop-filter: blur(5px);
            /* Blur effect */
            z-index: 1;
        }

        /* Content styles */
        .content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 20px;
            color: #f1f1f1;
        }

        /* Logo styling */
        .logo img {
            width: 200px;
            margin-bottom: 20px;
            border-radius: 50%;
            /* Make the logo circular */
        }

        /* Header text styling */
        h2 {
            font-size: 36px;
            font-weight: 600;
            /* Bold font */
            color: #ffffff;
            /* White for the main heading */
            margin-bottom: 15px;
            border-bottom: 1px solid #f0e68c;
            /* Yellow line below 'Sign Up' */
            display: inline-block;
            text-align: center;
            /* Center the text */
            width: 150%;
            /* Remove 150% width */
            max-width: 100%;
            /* Ensure it doesn't overflow */
            padding-bottom: 10px;
            margin-left: auto;
            /* Center the element */
            margin-right: auto;
            /* Center the element */
        }

        h6 {
            font-size: 20px;
            font-weight: 300;
            color: #dddddd;
            /* Lighter gray for secondary text */
            margin-bottom: 10px;
        }

        h4 {
            font-size: 26px;
            font-weight: 500;
            color: #f0e68c;
            /* A soft yellow that blends nicely with the green background */
            margin-bottom: 8px;
        }

        h6.slogan {
            font-size: 18px;
            font-weight: 400;
            color: #f0e68c;
            /* Slightly lighter gray for hashtag text */
            margin-bottom: 30px;
            /* Menambahkan jarak lebih banyak antara slogan dan tombol */
        }

        /* Button styles */
        .btn-register {
            background-color: #f0e68c;
            /* Soft yellow */
            color: #134802;
            /* Dark green text */
            font-size: 15px;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: #d1c94c;
            /* Slightly darker yellow for hover effect */
        }
    </style>
</head>

<body>

    <!-- Content directly in body -->
    <div class="content">
        <div class="logo mb-4">
            <img src="{{ asset('/img/logo3.png') }}" alt="My Stock Logo">
        </div>

        <h2 class="mb-3">Sign Up</h2>

        <h6> Ingin Stock barang Anda terkendali dan pengelolaan lebih effisien?</h6>
        <h4> My Stock solusinya ! </h4>
        <h6> Aplikasi yang memudahkan Anda dalam mengelola bisnis Anda </h6>
        <h6 class="slogan"> #MyStokMySollutions </h6>

        <!-- Register Button -->
        <a href="{{ action([App\Http\Controllers\LoginRegisterController::class, 'showRegisterForm']) }}"
            class=btn-register>AYO DAFTAR SEKARANG!!</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
