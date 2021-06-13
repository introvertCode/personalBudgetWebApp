<?php
	session_start();
	if (!isset($_SESSION['loggedIn']))
    {
        header('Location: index.html');
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
    <link rel="stylesheet" href="fontello-f4b2b225/css/fontello.css" type="text/css" />
    <script src="jquery/jquery-3.5.1.min.js"></script>


</head>

<body class="background">


    <header class="bg-light d-flex flex-row-reverse justify-content-center">
    <div class="container d-flex flex-row justify-content-center text-center py-2 mx-3 ">
           
           <div class="col-2">
               <a href="menu.php" class="active-shortcut" ><i class=" active-shortcut  icon-home"></i></a>
           </div>

           <div class=" col-2">
               <a  href="showBalance.php"><i class= "shortcut icon-chart-area"></i></a>
           </div>

           <div class=" col-2">
               <a href="addIncome.php"><i class="shortcut icon-plus"></i></a>
           </div>

           <div class=" col-2">
               <a href="addExpense.php"><i class="shortcut icon-minus"></i></a>
           </div>

           <div class=" col-2">
               <a href="#" ><i class="shortcut icon-cog"></i></a>
           </div>
           <!-- <div class=" container py-1 mx-3 text-end">
            <div class="icon">&#xf2c0; </div>
        </div> -->
       </div>
        

    </header>

    <div class="container-fluid">

        <div class="container my-5" id="menu-left">

            <div class="row">
                <div class="text-center h2 mt-3"> MENU</div>
            </div>


            <div class="row gx-3 mt-2 mx-5">


                <div class="col-md-6 mt-3 text-center">

                    <a href="showBalance.php" class="menu-ic">
                        <div class="menu-ic p-4 rounded">
                            <i class="icon-chart-area"></i>
                            <div>Przeglądaj bilans</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 mt-3 text-center ">

                    <a href="addExpense.php" class="menu-ic">
                        <div class="menu-ic  p-4 rounded">
                            <i class="icon-minus"></i>
                            <div>Dodaj wydatek</div>
                        </div>
                    </a>
                </div>



            </div>

            <div class="row  mx-5 gx-3">


                <div class="col-md-6 mt-3 text-center">
                    <a href="addIncome.php" class="menu-ic">
                        <div class="menu-ic p-4 rounded">
                            <i class="icon-plus"></i>
                            <div> Dodaj przychód</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 mt-3 text-center">

                    <a href=# class="menu-ic">
                        <div class="menu-ic p-4 rounded">
                            <i class="icon-cog"></i>
                            <div>Ustawienia</div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row pb-5 mx-5 mt-3 gx-3">
                <a href="logOut.php" class="log-out">
                    <div class=" col-md text-center">
                        <div class="log-out-btn  border p-2 rounded">Wyloguj</div>
                    </div>

                </a>

            </div>

        </div>


    </div>
    <script src="js/passwordValidation.js"></script>
</body>

</html>