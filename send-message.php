<?php
session_start();
$cstrong = True;
$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
if (!isset($_SESSION['token'])) {

        $_SESSION['token'] = $token;

}
include('./classes/DB.php');
include('./classes/Login.php');
// if (Login::isLoggedIn()) {
//         $userid = Login::isLoggedIn();
// } else {
//         die('Not logged in');
// }

if (isset($_POST['send'])) {

        if (!isset($_POST['nocsrf'])) {
                die("INVALID TOKEN");
        }

        if ($_POST['nocsrf'] != $_SESSION['token']) {
                die("INVALID TOKEN");
        }

        if (DB::query('SELECT id FROM users WHERE id=:receiver', array(':receiver'=>$_GET['receiver']))) {

                DB::query("INSERT INTO messages VALUES ('', :body, :sender, :receiver, 0)", array(':body'=>$_POST['body'], ':sender'=>$userid, ':receiver'=>htmlspecialchars($_GET['receiver'])));
                echo "Message Sent!";
        } else {
                die('Invalid ID!');
        }
        session_destroy();
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


<div class="login-clean " style="background: 70% 70% url(img/fon8.jpg) no-repeat; "  >


<h1 style="text-align: center; color: white">Надіслати повідомлення</h1>

<form action="send-message.php?receiver=<?php echo htmlspecialchars($_GET['receiver']); ?>" id="f1" method="post" >
        <textarea name="body" rows="8" cols="32" class="modal-content"></textarea>
        <input type="hidden" name="nocsrf" value="<?php echo $_SESSION['token']; ?>">
        <input type="submit" name="send" value="Надіслати повідомлення" class="btn btn-primary btn-block"
style=" background-color: rgb(240,95,64)">
</form>


</div>