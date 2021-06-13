<?php
	session_start();
	
	if(!isset($_POST['loginEmail'])||(!isset($_POST['loginPassword']))){
        header('Location:login.php');
        exit();
    }
		
		require_once "connectToDB.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
        try{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			
            if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
			}else{
				$email = $_POST['loginEmail'];
				//$email = htmlentities($email, ENT_QUOTES, "UTF-8");
				
				$password = $_POST['loginPassword'];
				

				if($loginResult = @$connection->query(sprintf("SELECT * FROM users WHERE email ='%s'",mysqli_real_escape_string($connection,$email))))
				{
					
                    $howManyMatches = $loginResult -> num_rows;

					if($howManyMatches > 0){
                        $loggedUserData = $loginResult -> fetch_assoc();
                        
                        if(password_verify($password, $loggedUserData['password'])){                                           
                            $_SESSION['loggedIn'] = true;
                            $_SESSION['id'] = $loggedUserData['id'];
                            $_SESSION['email'] = $loggedUserData['email'];
                            $_SESSION['name'] = $loggedUserData['name'];
                            
                            unset($_SESSION['loginError']);
                            $loginResult->free_result();
                            header('Location: menu.php');
                        }else{
                            $_SESSION['loginError'] ='<span>Nieprawidłowe haslo </span>';
                                header('Location: login.php');
                        }
				}else{
                    $_SESSION['loginError'] ='<span>Nieprawidłowy login</span>';
                        header('Location: login.php');
                }
			}
            
            $connection->close(); 
		}
    }catch(Exception $error){
        echo '<span>Błąd serwera!</span>';
        echo '<br/>Informacja developerska:'.$error;
    }


?>