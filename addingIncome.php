<?php
session_start();

if(isset($_POST['datePicker'])){
    $validationOk = true;  
    
    $amount = $_POST['amount'];
    
    if((is_numeric ($amount)) && ($amount < 0 || $amount > 99999999999)){
        $_SESSION['amountError'] = "Zła ilość";
        $validationOk = false;
        header('Location: addIncome.php');
    }

    $category = $_POST['category'];
  
    $date = $_POST['datePicker'];

    $comment = $_POST['moreInfo'];

    
    

    if($validationOk){

            
        require_once "connectToDB.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        
        try{
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
            
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }else{
                $loggedUserId = $_SESSION['id'];

                $incomeCategoryQuery = "SELECT id FROM incomes_category_assigned_to_users WHERE user_id = '$loggedUserId' AND name = '$category' ;" ;
                $incomeCategoryResult = mysqli_query($connection, $incomeCategoryQuery);
                $rowIncomeCategory = mysqli_fetch_assoc($incomeCategoryResult);
				$incomeCategoryId = $rowIncomeCategory['id'];

                $connection -> query("INSERT INTO incomes VALUES (NULL,'$loggedUserId', '$incomeCategoryId','$amount','$date','$comment')");
                
                $_SESSION['success'] ='<div class="popupMsg"> Dodano pomyślnie! </div>';
                header('Location: addIncome.php');
            }
            
            $connection->close();
        }catch(Exception $error){
            echo '<span>Błąd serwera!</span>';
        echo '<br/>Informacja developerska:'.$error;


        }
    }
}
?>