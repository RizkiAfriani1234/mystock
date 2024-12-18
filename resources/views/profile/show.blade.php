<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling tambahan */
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
        }

        .edit-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
        }

        .form-control {
            background-color: #f5f5f5;
            border: none;
            border-radius: 8px;
        }

        .form-control:focus {
            box-shadow: none;
            border: 1px solid #198754;
        }

        .btn-edit {
            background-color: #4caf50;
            color: white;
            font-weight: bold;
            border-radius: 8px;
        }

        .password-eye {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <!-- Card Edit Profil -->
        <div class="card">
            <div class="card-header bg-success text-white py-3 d-flex align-items-center">
                <!-- Tombol Kembali -->
                <button class="btn btn-light me-3" onclick="history.back()">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <h5 class="mb-0">Profil</h5>
            </div>
            <div class="card-body p-4">
                <!-- Foto Profil -->
                <div class="text-center position-relative mb-4">
                    <img src="{{ asset('storage/profile_photos/' . ($user->foto ?? 'default.png')) }}" 
                        alt="Foto Profil" class="profile-img">
                    <label class="edit-icon">
                        <input type="file" class="d-none" name="foto">
                        <i class="bi bi-camera"></i>
                    </label>
                </div>

                <!-- Form Edit Profil -->
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Pemilik</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <i class="bi bi-eye-slash password-eye" onclick="togglePassword('password')"></i>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <i class="bi bi-eye-slash password-eye" onclick="togglePassword('password_confirmation')"></i>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-edit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to toggle password visibility
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = event.target;

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("bi-eye-slash", "bi-eye");
            } else {
                input.type = "password";
                icon.classList.replace("bi-eye", "bi-eye-slash");
            }
        }
    </script>
</body>

</html>
