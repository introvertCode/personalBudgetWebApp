<?php
	session_start();
	if(isset($_POST['email'])){
		$validationOk = true;
	
		$name = $_POST['name'];
		if ((strlen($name) < 2) || (strlen($name) > 49)) {
			$validationOk = false;
			$_SESSION['errorName'] = "Imię powinno mieć długość od 2 do 49 znaków";
		}
		
		
		$email = $_POST['email'];
		$emailFiltered = filter_var($email, FILTER_SANITIZE_EMAIL);
		if ((filter_var($emailFiltered, FILTER_VALIDATE_EMAIL) == false) || ($emailFiltered != $email)) {
			$validationOk = false;
			$_SESSION['errorEmail'] = "Podaj poprawny adres email";
		}
		
		$password = $_POST['password'];
		$repeatPassword = $_POST['repeatPassword'];
		if ((strlen($password) < 8) || (strlen($password) > 20)) {
			$validationOk = false;
			$_SESSION['errorPassword'] = "Hasło musi zawierać od 8 do 20 znaków!";
		}

		if ($password != $repeatPassword) {
			$validationOk = false;
			$_SESSION['errorPassword'] = "Hasła są różne";
		}

		$passwordHash = password_hash($password, PASSWORD_DEFAULT);
		
		if (!empty($_POST['g-recaptcha-response'])) {
			$secretCaptcha = "6Le38swaAAAAADdJTBY4oJWyn_124NXJxCsPsn8o";
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretCaptcha. '&response=' . $_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);
			if ($responseData->success == false) {
				$validationOk = false;
				$_SESSION['errorCaptcha'] = "Potwierdź, że nie jesteś botem!";
			}
		}else{
			$validationOk = false;
			$_SESSION['errorCaptcha'] = "Potwierdź, że nie jesteś botem!";
		}

		if(!isset($_POST['rules'])){
			$validationOk = false;
			$_SESSION['errorRules']="Zaakceptuj regulamin";
		}
		

		$_SESSION['rememberName']=$name;
		$_SESSION['rememberEmail']=$email;
		if(isset($_POST['rules'])) $_SESSION['rememberRules']=true;



		require_once "connectToDB.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
			}else{
				$isEmailInBase = $connection ->query("SELECT id FROM users WHERE email='$email'");
				if(!$isEmailInBase) throw new Exception( $connection->error);
				$howManyEmailsLikeThisInBase = $isEmailInBase -> num_rows;
				if($howManyEmailsLikeThisInBase>0){
					$validatoinOk=false;
					$_SESSION['errorEmail'] = "Istnieje już konto z takim adresem e-mail";

				}
				
				if($validationOk == true){
					if($connection->query("INSERT INTO users VALUES (NULL,'$name','$passwordHash','$email')")) {
						$_SESSION['registrationOK']= true;
						header('Location: welcome.php');
					} else{
					   throw new Exception($connection->error);
					}
				}
	
				
				$connection->close();
			}

		}
		catch(Exception $error){
			echo '<span>Błąd serwera!</span>';
			echo '<br/>Informacja developerska:'.$error;
		}
		 
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


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fontello-f4b2b225/css/fontello.css" type="text/css" />
	<script src="jquery/jquery-3.5.1.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>


</head>

<body class="background">

	<header class="container-fluid bg-light">
		<div class="d-flex py-2 justify-content-center">

			<div class=" "><a href="index.html" id="name-link" class="btn btn-link text-decoration-none me-3 reg-menu">Budżet osobisty</a></div>

		</div>
	</header>
	<div class="container-fluid">
		<div class="container d-md-flex mt-5" id="menu-left">
			<div class="col-md-6 py-5 px-3 text-center d-flex flex-column justify-content-center">
				<div class="h1 main-text">Budżet Osobisty</div>
				<div class="sub-text">Monitoruj swoje wydatki i oszczędzaj</div>
			</div>
			<div class="col-md-6 py-5 px-4">
				<form method="post">
					
				<label class="mx-3 mt-3" for="name-field">Imię</label><br>
						<input id="email-field" class="form-control w-100 p-2 rounded-pill border-2" type="text" placeholder="&#xf2bd;" name="name" required value="<?php 
						if(isset($_SESSION['rememberName'])){
							echo $_SESSION['rememberName'];
							unset($_SESSION['rememberName']);
						}
						?>">
							<?php
								if(isset($_SESSION['errorName'])){
									echo'<div class="error">'.$_SESSION['errorName'].'</div>';
									unset($_SESSION['errorName']);
								}
							?>	
			
					<label class="mx-3 mt-3" for="email-field">e-mail</label><br>
						<input id="email-field" class="form-control w-100 p-2 rounded-pill border-2" type="email" placeholder="&#xe80a;" name="email" required value="<?php 
						if(isset($_SESSION['rememberEmail'])){
							echo $_SESSION['rememberEmail'];
							unset($_SESSION['rememberEmail']);
						}
						?>">
							<?php
								if(isset($_SESSION['errorEmail'])){
									echo'<div class="error">'.$_SESSION['errorEmail'].'</div>';
									unset($_SESSION['errorEmail']);
								}
							?>

					
					<label class="mx-3 mt-3">Hasło</label><br>
					<input id="pass" class="form-control w-100 p-2 rounded-pill border border-2" type="password" placeholder="&#xe809;"  name="password" minlength="5" required>
					<?php
							if(isset($_SESSION['errorPassword'])){
								echo'<div class="error">'.$_SESSION['errorPassword'].'</div>';
								unset($_SESSION['errorPassword']);
							}
						?>
					<label class="mx-3 mt-3">Powtórz hasło</label><br>
					<input id="rep-pass" class="form-control w-100 p-2 rounded-pill border-2 " type="password" placeholder="&#xe809;" name="repeatPassword">
					
					<label>
						<input type="checkbox" name="rules" class="m-3" required <?php 
						if(isset($_SESSION['rememberRules'])){
							echo "checked";
							unset($_SESSION['rememberRules']);
						}
						?>>Akceptuję regulamin</label>
						<?php
							if(isset($_SESSION['errorRules'])){
								echo'<div class="error">'.$_SESSION['errorRules'].'</div>';
								unset($_SESSION['errorRules']);
							}
						?>

					<div class="g-recaptcha" data-sitekey="6Le38swaAAAAAHlRTPQDbk8ePqgUvH1mxjafXLK2"></div>
					<br />
					<?php
							if(isset($_SESSION['errorCaptcha'])){
								echo'<div class="error">'.$_SESSION['errorCaptcha'].'</div>';
								unset($_SESSION['errorCaptcha']);
							}
						?>



					<div class="d-flex justify-content-center"><button class=" px-4 btn btn-primary my-3" type="submit">
							Zarejestruj </button>
					</div>


				</form>
				<div>Jeśli masz już konto to <a href="login.php">Zaloguj się</a></div>

			</div>

		</div>
	</div>

	<script src="js/passwordValidation.js"></script>
</body>

</html>