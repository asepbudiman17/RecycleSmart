<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - RecycleSmart</title>
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(to bottom, #28a745 0%, #46b1a1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px 30px 20px 30px;
            width: 100%;
            max-width: 380px;
            text-align: center;
        }
        .login-header h1 {
            color: #28a745;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #666;
            font-size: 15px;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 18px;
            position: relative;
        }
        .form-control {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 25px;
            font-size: 15px;
            background-color: #f9f9f9;
        }
        .form-group .form-control-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background: #218838;
        }
        .register-link {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }
        .register-link a {
            color: #28a745;
            text-decoration: none;
            font-weight: 600;
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
        .reset-code {
            font-size: 16px;
            color: #155724;
            background: #d4edda;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h1><i class="fas fa-unlock-alt"></i> Lupa Password</h1>
        <p>Masukkan nomor HP Anda untuk reset password.</p>
    </div>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="reset-code"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <form action="<?= site_url('login/forgot_password_process'); ?>" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="telepon" placeholder="Nomor HP" required>
            <span class="form-control-icon"><i class="fas fa-phone"></i></span>
        </div>
        <button type="submit" class="btn-login">Kirim Kode Reset</button>
        <div class="register-link">
            <a href="<?= site_url('login') ?>">Kembali ke Login</a>
        </div>
    </form>
    <div class="register-link mt-2">
        <a href="<?= site_url('login/reset_password') ?>">Sudah dapat kode? Reset Password</a>
    </div>
</div>
</body>
</html> 