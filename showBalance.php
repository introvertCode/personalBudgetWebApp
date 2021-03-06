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

    <script src="jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
                <a class="active-shortcut" href="showBalance.php"><i class="active-shortcut icon-chart-area"></i></a>
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
        </div>
    </header>

    <div class="container-fluid mt-5">
        <div class="d-flex">
            <div class="p-4" id="menu-balance">

                <form method="post" id="show_balance_form" action="showingBalance.php">
                    <div>
                        <header class="h1">Przeglądaj bilans</header>
                    </div>
                    
                    <div class="input-group my-3 ">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="period">Okres</label>
                        </div>
                        <select class="custom-select" id="period" name="period">
                            <option selected value=1 class="standard">Bieżący miesiąc</option>
                            <option value=2 class="standard">Poprzedni miesiąc</option>
                            <option value=3 class="standard">Bieżący rok</option>
                            <option value=4 id="not-standard">niestandardowy</option>
                        </select>
                      </div>

                    <div id="select-date">
                        <div><span class="bal-pick-date">Wybierz początkową datę</span></div>
                        <div><input id="start-date" class="showBalance" type="date" name="startDate"/></div>
                        <div><span class="bal-pick-date">Wybierz końcową datę</span></div>
                        <script>
                            document.getElementById('start-date').valueAsDate = new Date();
                        </script>
                        <div><input id="end-date" class="showBalance" type="date" name="endDate"/></div>
                        <script>
                            document.getElementById('end-date').valueAsDate = new Date();
                        </script>
                    </div>
                    <div class="d-flex justify-content-center"><input class="mb-3" id="show-bal"
                            type="submit" value="Pokaż"></div>
                </form>
               
            </div>
        </div>
    </div>
 

    <script src="js/animation.js"></script>
</body>

</html>