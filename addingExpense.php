<?php
session_start();

if(isset($_POST['expenseDatePicker'])){
    $validationOk = true;  
    
    $amount = $_POST['expenseAmount'];
    
    if((is_numeric ($amount)) && ($amount < 0 || $amount > 99999999999)){
        $_SESSION['expenseAmount'] = "Zła ilość";
        $validationOk = false;
        header('Location: addExpense.php');
    }

    $category = $_POST['expenseCategory'];
  
    $date = $_POST['expenseDatePicker'];

    $comment = $_POST['expenseMoreInfo'];
    
    echo "ok";

    if($validationOk){

            
        require_once "connectToDB.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        
        try{
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
            
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }else{
                $loggedUserId = $_SESSION['id'];
                $connection -> query("INSERT INTO expenses VALUES (NULL,'$loggedUserId', '$category', NULL, '$amount','$date','$comment')");
                header('Location: addExpense.php');
                $_SESSION['success'] ='<div class="popupMsg"> Dodano pomyślnie! </div>';
                
            }

        }catch(Exception $error){
            echo '<span>Błąd serwera!</span>';
        echo '<br/>Informacja developerska:'.$error;


        }
    }
}
?>