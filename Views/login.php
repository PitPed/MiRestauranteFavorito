<?php
if (!isset($fromController)) {
    header("Location: ../");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #login-form {
            border: 2px solid black;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            padding: 4%;
            gap: 8%;
            height: 25%;
            background-color: #03d3fc;
        }

        #login-form>input,
        #login-form>label {
            display: block;
            font-size: larger;
        }
    </style>
</head>

<body>
    <form id="login-form" method="post">
        <?php if (isset($incorrect) && $incorrect == true): ?>
            <span style='color: red'>Usuario o contraseña incorrectos</span>
        <?php endif; ?>
        <label>Usuario</label>
        <input type="text" name="user" id="">
        <label>Contraseña</label>
        <input type="password" name="password" id="">
        <input type="submit" value="Login" name="action">
    </form>
</body>

</html>