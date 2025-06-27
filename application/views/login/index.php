<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RecycleSmart</title>
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            /* Adjusted gradient to match the image */
            background: linear-gradient(to bottom, #28a745 0%, #46b1a1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .login-container {
            background: white;
            border-radius: 20px;
            /* Adjusted box-shadow for a softer look */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 380px; /* Adjusted max-width */
            text-align: center;
            position: relative; /* Needed for absolute positioning of elements if any */
        }
        /* Added top section styling */
        .top-section {
            background-color: #28a745; /* Match the top background color */
            height: 150px; /* Example height */
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            overflow: hidden; /* Hide overflowing plant */
        }
        .top-section h1 {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin-top: 30px; /* Adjust as needed */
        }
        .top-section p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            margin-top: 5px;
        }

        .login-content {
             margin-top: 130px; /* Space for the top section */
             position: relative;
             z-index: 1; /* Ensure content is above the top section */
        }

        .login-header {
            margin-bottom: 30px;
            text-align: middle; /* Aligned header left as in image */
        }
        .login-header h1 {
            color: #333; /* Adjusted color */
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }
        .login-header p {
            color: #666;
            margin: 5px 0 0;
            font-size: 15px;
        }
        .form-group {
            margin-bottom: 15px; /* Adjusted margin */
            text-align: left;
            position: relative; /* For icon positioning */
        }
        .form-group label {
            display: none; /* Hide labels as per image */
            color: #333;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 12px 40px 12px 15px; /* Added padding for icon */
            border: 1px solid #e0e0e0; /* Adjusted border */
            border-radius: 25px; /* More rounded corners */
            font-size: 15px;
            transition: border-color 0.3s;
            box-sizing: border-box;
            background-color: #f9f9f9; /* Light background for input */
        }
        .form-control:focus {
            border-color: #28a745; /* Adjusted focus color */
            outline: none;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.2); /* Added subtle focus shadow */
        }
        .form-group .form-control-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa; /* Icon color */
        }
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
            font-size: 13px;
        }
        .forgot-password a {
            color: #666; /* Adjusted link color */
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .btn-login {
            width: 100%;
            padding: 14px;
            background: #28a745; /* Adjusted button color */
            color: white;
            border: none;
            border-radius: 25px; /* More rounded button */
            font-size: 16px;
            font-weight: 600; /* Bolder font */
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        .btn-login:hover {
            background: #218838; /* Darker shade on hover */
        }
        .register-link {
            text-align: center;
            margin-top: 25px; /* Adjusted margin */
            font-size: 14px;
        }
        .register-link a {
            color: #28a745; /* Adjusted link color */
            text-decoration: none;
            font-weight: 600; /* Bolder font */
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 12px 15px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="login-container">
         <!-- Top section content is illustrative, actual plant graphic requires image -->
        <div class="top-section">
            <h1>Hello!</h1>
            <p>Welcome to RecycleSmart</p>
             <!-- Placeholder for plant graphic -->
        </div>

        <div class="login-content">
            <div class="login-header" style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                <i class="fas fa-recycle" style="font-size:36px; color:#28a745;"></i>
                <h1 style="margin:0;">Login</h1>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>

            <form action="<?= site_url('login/process'); ?>" method="POST">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Email" required>
                    <span class="form-control-icon"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <span class="form-control-icon"><i class="fas fa-lock"></i></span>
                </div>
                 <div class="forgot-password">
                     <a href="<?= site_url('login/forgot_password') ?>">Forgot Password?</a>
                 </div>
                <button type="submit" class="btn-login">Login</button>
            </form>

             <!-- Removed social login section -->

            <div class="register-link">
                <a href="<?= site_url('login/register'); ?>">Don't have an account? Sign Up</a>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
</body>

</html>
