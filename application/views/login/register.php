<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RecycleSmart</title>
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            /* Adjusted gradient to match the image */
            background: linear-gradient(to bottom, #28a745 0%, #46b1a1 100%); /* Keep a gradient, adjust start color */
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .register-container {
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

        .register-content {
             margin-top: 130px; /* Space for the top section */
             position: relative;
             z-index: 1; /* Ensure content is above the top section */
        }

        .register-header {
            margin-bottom: 30px;
             text-align: middle; /* Aligned header left as in image */
        }
        .register-header h1 {
            color: #333; /* Adjusted color */
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }
        .register-header p {
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
        .btn-register {
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
        .btn-register:hover {
            background: #218838; /* Darker shade on hover */
        }
        .login-link {
            text-align: center;
            margin-top: 25px; /* Adjusted margin */
            font-size: 14px;
        }
        .login-link a {
            color: #28a745; /* Adjusted link color */
            text-decoration: none;
            font-weight: 600; /* Bolder font */
        }
        .login-link a:hover {
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
    <div class="register-container">
         <!-- Top section content is illustrative, actual plant graphic requires image -->
        <div class="top-section">
            <h1>Hello!</h1>
            <p>Welcome to RecycleSmart</p>
             <!-- Placeholder for plant graphic -->
        </div>

        <div class="register-content">
            <div class="register-header" style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                <i class="fas fa-recycle" style="font-size:36px; color:#28a745;"></i>
                <h1 style="margin:0;">Sign Up</h1>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>

            <form action="<?= site_url('login/register_process'); ?>" method="POST">
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK (16 digits)" required>
                    <span class="form-control-icon"><i class="fas fa-id-card"></i></span>
                </div>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                    <span class="form-control-icon"><i class="fas fa-user"></i></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password (min. 6 characters)" required>
                     <span class="form-control-icon"><i class="fas fa-lock"></i></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                     <span class="form-control-icon"><i class="fas fa-lock"></i></span>
                </div>
                 <!-- Removed Phone number field as it's not in the original form -->
                <button type="submit" class="btn-register">Sign Up</button>
            </form>

             <!-- Removed social login section -->

            <div class="login-link">
                <a href="<?= site_url('login'); ?>">Already have an account? Login here</a>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
</body>

</html>
