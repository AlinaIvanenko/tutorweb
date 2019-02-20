<?php
include('classes/DB.php');
include('classes/Mail.php');

if (isset($_POST['createaccount'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if (!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

                if (strlen($username) >= 3 && strlen($username) <= 32) {

                        if (preg_match('/[a-zA-Z0-9_]+/', $username)) {

                                if (strlen($password) >= 6 && strlen($password) <= 60) {

                                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                                if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {

                                        DB::query('INSERT INTO users VALUES (\'\', :username, :password, :email, \'0\', \'\')', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email));
                                        Mail::sendMail('Welcome to our Social Network!', 'Your account has been created!', $email);
                                        echo "Success!";
                                } else {
                                        echo 'Email in use!';
                                }
                        } else {
                                        echo 'Invalid email!';
                                }
                        } else {
                                echo 'Invalid password!';
                        }
                        } else {
                                echo 'Invalid username';
                        }
                } else {
                        echo 'Invalid username';
                }

        } else {
                echo 'User already exists!';
        }
}
?>

<!--<h1>Register</h1>
<form action="create-account.php" method="post">
<input type="text" name="username" value="" placeholder="Username ..."><p />
<input type="password" name="password" value="" placeholder="Password ..."><p />
<input type="email" name="email" value="" placeholder="someone@somesite.com"><p />
<input type="submit" name="createaccount" value="Create Account">
</form>-->

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNetwork</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">



   <!--  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css"> -->
</head>


<style type="text/css">
    
    .login-clean {
  background:white/*#f1f7fc*/;
  padding:80px 0;
}

.login-clean form {
  max-width:400px;
  width:50%;
  margin:0 auto;
  background-color:white/*#ffffff*/;
  padding:40px;
  border-radius:4px;
  color:#505e6c;
  box-shadow:none/*1px 1px 5px rgba(0,0,0,0.1)*/;

  }

 
}


.btn btn-primary btn-block{
    max-width:100px;
  width:50%;
}
</style>

    
    
<body id="page-top">

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav"  style="background-color: white" >
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.html" style="color: black">CANYDO</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about" style="color: black">ПРО ПЛАТФОРМУ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services" style="color: black">МОЖЛИВОСТІ</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact" style="color: black">КОНТАКТИ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login.php" style="color: black">ВВІЙТИ</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>




    <div class="login-clean"  style="background-color: #f1f7fc" >
        <form method="post" action="create-account.php" >
            <h2 class="sr-only">Create Account</h2>
            <div class="illustration"><img src="img/logo.jpg" width="25%"  height="10%"> <!-- <i class="icon ion-ios-navigate"></i>--></div>
            <div class="form-group">
                <input class="form-control" id="username" type="text" name="username" placeholder="Ім'я користувача">
            </div>
            <div class="form-group">
                <input class="form-control" id="surname" type="text" name="surname" placeholder="Прізвище користувача">
            </div>

            <div class="form-group">
                <input class="form-control" id="nik" type="text" name="nik" placeholder="Унікальне ім'я користувача">
            </div>

            <div class="form-group">
                <input class="form-control" id="email" type="email" name="email" placeholder="Електронна адреса">
            </div>
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Пароль">
            </div>



            <div class="form-group">
                <button style="width: 155px; display: inline-block;" class="btn btn-primary btn-block" id="ca" type="button" data-bs-hover-animate="shake" href="#" >Студент</button>
                <button style="width: 155px; display: inline-block;" class="btn btn-primary btn-block" id="ca" type="button" data-bs-hover-animate="shake" href="#">Тьютор</button>
            </div>



            <div class="form-group">
                
                <input class="btn btn-primary btn-block" id="ca" type="submit" name="createaccount" value="Створити аккаунт" data-bs-hover-animate="shake"  style=" background-color: rgb(240,95,64)">
                
                <!--<button class="btn btn-primary btn-block" id="ca" type="button" data-bs-hover-animate="shake">Create Account</button>-->
            </div>
            <a href="login.php" class="forgot">Вже є аккаунт? Натисніть сюди!</a></form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#ca').click(function() {

                $.ajax({

                        type: "POST",
                        url: "api/users",
                        processData: false,
                        contentType: "application/json",
                        data: '{ "username": "'+ $("#username").val() +'","surname": "'+ $("#surname").val() +'","nik": "'+ $("#nik").val() +'", "email": "'+ $("#email").val() +'", "password": "'+ $("#password").val() +'" }',
                        success: function(r) {
                                console.log(r)
                        },
                        error: function(r) {
                                setTimeout(function() {
                                $('[data-bs-hover-animate]').removeClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'));
                                }, 2000)
                                $('[data-bs-hover-animate]').addClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'))
                                console.log(r)
                        }

                });

        });
    </script>
</body>

</html>

