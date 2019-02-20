<?php
include('./classes/DB.php');
include('./classes/Login.php');

// if (!Login::isLoggedIn()) {
//         die("Not logged in.");
// }

if (isset($_POST['confirm'])) {

        if (isset($_POST['alldevices'])) {

                DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>Login::isLoggedIn()));

        } else {
                if (isset($_COOKIE['SNID'])) {
                        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
                }
                setcookie('SNID', '1', time()-3600);
                setcookie('SNID_', '1', time()-3600);
        }

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


<div class="login-clean" style="background: 50% 50% url(img/fon6.jpg) no-repeat; " >


<h1 style="text-align: center; color: white">Вийти з Аккаунта?</h1>
<p style="text-align: center; color: white">Ви впенені що хочете вийти?</p>
<form action="logout.php" method="post">
        <input class="form-control"  type="checkbox" name="alldevices" value="alldevices" > Вийти?<br />
        <input class="btn btn-primary btn-block" type="submit" name="confirm" value="Підтвердити"  style=" background-color: rgb(240,95,64)">
</form>

</div>