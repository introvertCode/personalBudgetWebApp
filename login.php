<?php
	session_start();
	if ((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn']==true))
    {
        header('Location: menu.html');
        exit();
    }
	

?>


<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="utf-8">
	<title>Budżet osobisty</title>

	<meta name="description" content="budżet domowy">
	<meta name="keywords" content="budżet domowy, budget, budżet, pieniądze, planowanie wydatków">
	<meta name="author" content="Stanisław Bielski">
	<meta http-equiv="X-Ua-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fontello-f4b2b225/css/fontello.css" type="text/css">
	<script src="jquery/jquery-3.5.1.min.js"></script>


</head>

<body class="background">


	<header class="container-fluid bg-light">
		<div class="d-flex py-2 justify-content-center">

			<div class=" "><a href="index.html" id="name-link"
					class="btn btn-link text-decoration-none me-3 reg-menu">Budżet osobisty</a></div>

		</div>
	</header>

	<div class="container-fluid">
		<div class="container d-md-flex mt-5" id="menu-left">
			<div class="col-md-6 px-3 text-center d-flex flex-column justify-content-center">
				<!-- <div class="h1 main-text">Budżet Osobisty</div>
				<div class="sub-text">Monitoruj swoje wydatki i oszczędzaj</div> -->
				<img id="login-img" src="img/Finance-professional.png" alt="budżet osobisty">
			</div>
			<div class="col-md-6 py-5 px-4">
				<form action="loggingIn.php" method = "POST">
					<label class="mx-3" for="email-field">Login (e-mail)</label><br>
					<input id="email-field" class="form-control w-100 p-2 rounded-pill border-2" type="email"
						placeholder='&#xe80a;' name="loginEmail" required><br>
						<?php
								if(isset($_SESSION['loginError'])){
									echo'<div class="error">'.$_SESSION['loginError'].'</div>';
									unset($_SESSION['loginError']);
								}
							?>

					<label class="mx-3">Hasło</label><br>
					<input id="pass" class="form-control w-100 p-2 rounded-pill border border-2" type="password"
						placeholder='&#xe809;' name="loginPassword" required><br>
						<?php
								if(isset($_SESSION['loginError'])){
									echo'<div class="error">'.$_SESSION['loginError'].'</div>';
									unset($_SESSION['loginError']);
								}
							?>

					<div class="d-flex justify-content-center"><button class=" px-4 btn btn-primary my-3" type="submit">
							Zaloguj </button>
					</div>
				</form>
				<div>Jeśli nie masz konta to <a href="register.php">Zarejestruj się</a></div>

			</div>

		</div>
	</div>

</body>

</html>