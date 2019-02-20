<?php
include('./classes/DB.php');
include('./classes/Mail.php');

if (isset($_POST['resetpassword'])) {

        $cstrong = True;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
        $email = $_POST['email'];
        $user_id = DB::query('SELECT id FROM users WHERE email=:email', array(':email'=>$email))[0]['id'];
        DB::query('INSERT INTO password_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
        Mail::sendMail('Forgot Password!', "<a href='http://localhost/tutorials/sn/change-password.php?token=$token'>http://localhost/tutorials/sn/change-password.php?token=$token</a>", $email);
        echo 'Email sent!';
}

?>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNetwork</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>


<div class="login-clean" style="background: 50% 50% url(img/fon2.jpg) no-repeat; " >

<form action="forgot-password.php" method="post">
	<h1 >Забули пароль?</h1>
       <div class="form-group">
        <input class="form-control" type="text" name="email" value="" placeholder="Електронна адреса">
    </div>

    <div class="form-group">
        <input class="btn btn-primary btn-block" type="submit" name="resetpassword" value="Відправити пароль" style=" background-color: rgb(240,95,64)">
    </div>

</form>
</div>