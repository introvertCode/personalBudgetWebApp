<?php
    session_start();
    if(!isset($_SESSION['registrationOK'])){
        header('Location:index.html');
        exit();
    }
    else{
        unset($_SESSION['registrationOK']);
    }

    if(isset($_SESSION['rememberName'])) unset($_SESSION['rememberName']);
    if(isset($_SESSION['rememberEmail'])) unset($_SESSION['rememberEmail']);
    if(isset($_SESSION['rememberRules'])) unset($_SESSION['rememberRules']);

    if(isset($_SESSION['errorEmail'])) unset($_SESSION['errorEmail']);
    if(isset($_SESSION['errorName'])) unset($_SESSION['errorName']);
    if(isset($_SESSION['errorPassword'])) unset($_SESSION['errorPassword']);
    if(isset($_SESSION['errorRules'])) unset($_SESSION['errorRules']);
    if(isset($_SESSION['errorCaptcha'])) unset($_SESSION['errorCaptcha']);

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
    <link rel="stylesheet" href="fontello-f4b2b225/css/fontello.css" type="text/css" />
    <script src="jquery/jquery-3.5.1.min.js"></script>


</head>

<body class="background">


    <header class="bg-light d-flex flex-row-reverse justify-content-center">

        <div class=" container py-2 mx-3 text-end">
            
        </div>

    </header>

    

        <div class="container my-5" id="menu-left">

            


            <div class="row gx-3 mt-2 mx-5">
                Witamy, możesz się zalogować!
            </div>


               
        </div>


    </div>
    
</body>

</html>