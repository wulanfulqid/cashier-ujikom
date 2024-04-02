<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cozy Crafted</title>
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

        #container-login {
            display: flex;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 31, 63, 0.1);
            color: #5E7053;
            max-width: 800px; /* Adjust the max-width as needed */
            width: 100%;
        }

        #login-form {
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
        input[type="password"],
        button {
            width: 95%;
            box-sizing: border-box;
            margin-bottom: 18px;
        }

        input[type="text"],
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

        .register {
            color: #5E7053;
            font-size: 14px;
        }

        .register a {
            color: #5E7053;
            text-decoration: none;
            font-weight: bold;
        }

        .register a:hover {
            text-decoration: underline;
        }

        #login-image {
            max-width: 150%;
            height: auto;
            border-radius: 10px;
            max-height: 450px; /* Adjust the max-height as needed */
        }

        @media only screen and (max-width: 768px) {
            #container-login {
                flex-direction: column;
                align-items: center;
        }

        #login-form {
            padding-right: 0;
            margin-top: 20px; /* Jarak antara formulir dan gambar pada layar kecil */
        }
    </style>
</head>

<body>
    <div id="container-login">
        <div id="login-form">
            <div id="title">
                Silahkan Login
            </div>

            <?php echo validation_errors(); ?>
            <?php echo $this->session->flashdata('error'); ?>

            <?php echo form_open('login/process_login'); ?>
                <div class="input">
                    <div class="input-addon">
                    </div>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="clearfix"></div>

                <div class="input">
                    <div class="input-addon">

                    </div>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit">Login</button>
            <?php echo form_close(); ?>

            <div class="register">
                Belum punya akun? <br>
                <a href="<?php echo site_url('Login/register'); ?>" id="register-2">Daftar</a>
            </div>
        </div>
        <img class="card-img-top" src="http://localhost/pro.12rpl1/Cozcraft/assets/img/ikon/CozyCrafted.png" alt="Login Image" id="login-image">
    </div>
    
</body>

</html>
