<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cozy Crafted - Register</title>
    <link href="<?= base_url('assets/'); ?>img/ikon/Coz.png" rel="icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            background-color: #5E7053;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        #container-register {
            display: flex;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 31, 63, 0.1);
            color: #5E7053;
            max-width: 800px;
            width: 100%;
        }

        #register-form {
            flex: 1;
            padding-right: 30px;
        }

        #title {
            color: #5E7053;
            font-size: 20px;
            margin-bottom: 18px;
        }

        .input,
        .input-addon,
        input[type="text"],
        input[type="email"],
        input[type="password"],
        button {
            width: 95%;
            box-sizing: border-box;
            margin-bottom: 18px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        button {
            width: 90%;
            box-sizing: border-box;
            margin-bottom: 18px;
            background-color: #5E7053;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5E7053;
        }

        .login {
            color: #5E7053;
            font-size: 14px;
        }

        .login a {
            color: #5E7053;
            text-decoration: none;
            font-weight: bold;
        }

        .login a:hover {
            text-decoration: underline;
        }

        #register-image {
            max-width: 150%;
            height: auto;
            border-radius: 10px;
            max-height: 450px;
        }

        @media only screen and (max-width: 768px) {
            #container-register {
                flex-direction: column;
                align-items: center;
        }

            #register-form {
                padding-right: 0;
                margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="container-register">
        <div id="register-form">
            <div id="title">
             Registrasi Admin
            </div>

            <?php echo validation_errors(); ?>
            <?php echo $this->session->flashdata('success'); ?>

            <?php echo form_open('login/process_register'); ?>
                <div class="input">
                    <div class="input-addon">
                    </div>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="clearfix"></div>

                <div class="input">
                    <div class="input-addon">
                    </div>
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="clearfix"></div>

                <div class="input">
                    <div class="input-addon">
                    </div>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="clearfix"></div>

                <div class="input">
                    <div class="input-addon">
                    </div>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>

                <button type="submit">Daftar</button>
            <?php echo form_close(); ?>

            <div class="login">
                Sudah punya akun? <br>
                <a href="<?php echo site_url('Login/index'); ?>" id="login-link">Login</a>
            </div>
        </div>
        <img class="card-img-top" src="http://localhost/WULAN.ujikom/Cozcraft/assets/img/ikon/CozyCrafted.png" alt="Register Image" id="register-image">
    </div>
</body>

</html>
