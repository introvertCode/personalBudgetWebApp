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
    <link rel="stylesheet" href="style.css" >
    <link rel="stylesheet" href="fontello-f4b2b225/css/fontello.css" type="text/css">
    <script src="jquery/jquery-3.5.1.min.js"></script>


</head>

<body class="background">


    <header class="bg-light d-flex justify-content-center ">

    <div class="container d-flex flex-row justify-content-center text-center py-2 mx-3 ">
           
           <div class="col-2">
               <a href="menu.php"><i class="shortcut icon-home"></i></a>
           </div>

           <div class=" col-2">
               <a href="showBalance.php"><i class="shortcut icon-chart-area"></i></a>
           </div>

           <div class=" col-2">
               <a class="active-shortcut" href="addIncome.php"><i class="active-shortcut shortcut icon-plus"></i></a>
           </div>

           <div class=" col-2">
               <a href="addExpense.php"><i class="shortcut icon-minus"></i></a>
           </div>

           <div class=" col-2">
               <a href="#" ><i class="shortcut icon-cog"></i></a>
           </div>
       </div>
    </header>

    <div class="container-fluid">
        <div class="container">
            <div class="  row text-center justify-content-center ">
                <div class="col-md p-3 my-5 " id="menu-left">

                    <h1>Dodaj przychód</h1>

                    <form method="post" id="addIncomeForm" class="mt-3" action="addingIncome.php">
                        <div><input class="add-Income-Form-Input" name="amount" type="number" placeholder="kwota"
                                step="0.01" required></div>
                                
                        
                                <?php
                                        if(isset($_SESSION['amountError'])) echo '<div class="container d-flex justify-content-center align-items-center "><div class="error">'. $_SESSION['amountError'].'</div></div>';
                                        
                                        unset($_SESSION['amountError']);
                                            
                                    ?>
                                    
                        <div><input class="add-Income-Form-Input" name="datePicker" id="datePicker" type="date" /></div>

                        <script>
                            document.getElementById('datePicker').valueAsDate = new Date();
                        </script>

                        <div class="container d-flex justify-content-center text-start" id="fieldset">
                            <fieldset class="mt-4" id="frame">
                                <!-- <legend> Rodzaj przychodu:</legend> -->
                                <div><label><input class="radio-input" type="radio" value="Wynagrodzenie" name="category"
                                            checked="checked"><span class="radio-span">Wynagrodzenie</span></label>
                                </div>
                                <div><label><input class="radio-input" type="radio" value="Odsetki Bankowe" name="category"><span
                                            class="radio-span">Odsetki bankowe</span></label></div>
                                <div><label><input class="radio-input" type="radio" value="Sprzedaż Allegro" name="category"><span
                                            class="radio-span">Sprzedaż na allegro</span></label></div>
                                <div><label><input class="radio-input" type="radio" value="Inne" name="category"><span
                                            class="radio-span">Inne</span></label></div>
                            </fieldset>
                        </div>

                        <div>
                            <div class="mt-4" id="comment_label"><label for="comment">Uwagi</label></div>
                            <div class="mt-2"><textarea name="moreInfo" id="comment" rows="4"></textarea></div>
                        </div>

                        <div><input class="submit-button" id="addIncome" type="submit" value="Dodaj"></div>


                        <div class="d-flex justify-content-center " id="cancel">
                            <a href="menu.php" class="exit-link">
                                <div class="cancel-button">Anuluj</div>
                            </a>
                        </div>

                        

                    </form>
                    <?php
                        
                       
                        if(isset($_SESSION['success'])) echo '<div class="container d-flex justify-content-center align-items-center succes-msg-animation"><div class="msg align-self-center"> Dodano pomyślnie! </div></div>';
                        
                        unset($_SESSION['success']);
                            
                    ?>
                    
                </div>
               
            </div>
        </div>
        

    </div>
    
</body>

</html>