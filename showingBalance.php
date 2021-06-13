<?php
	session_start();
	if (!isset($_SESSION['loggedIn']))
    {
        header('Location: index.html');
        exit();
    }
?>


<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"pl-PL\">
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
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"> 
    <title>Rezultat zapytania</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    
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

        <form method="post" id="show_balance_form" >
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

    <div class="p-4 mx-3" id="menu-balance">
        <header class="h1">BILANS</header>
        <?php
            echo $startDate."<br>";
            echo $endDate, PHP_EOL;
        ?>
    </div>
</div>
</div>

<script src="js/animation.js"></script>


    

    <?php
        // session_start();
        if (!isset($_SESSION['loggedIn']))
        {
            header('Location: showBalance.php');
            exit();
        }

        date_default_timezone_set ( 'Europe/Warsaw');
        // echo date("Y m d");
        $month = date("m");
        $day = date("d");
        $year = date("Y");
        // echo $month - 1;
        $startDate = date_create();
        $endDate = date_create();
        $firstDay = 1;
        $lastDay = $day;
        $startMonth = $month;
        $endMonth = $month;
        // $dtobj = date_format($rawDate,"Y-m-d");
        // echo $dtobj;

        require_once "connectToDB.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        
        $period = $_POST['period'];
        // echo $period;


        try{
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
            
            if($connection->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }else{
                $loggedUserId = $_SESSION['id'];
                $connection -> query("SELECT ");

                if($period != 4){
                    
                    if($period == 2){
                        $startMonth = $month-1;
                        $endMonth = $startMonth;
                        if($startMonth == 1||$startMonth == 3||$startMonth == 5||$startMonth == 7||$startMonth == 8||$startMonth == 10||$startMonth == 12){
                            $lastDay = 31;
                        }elseif($startMonth == 2){
                            $isLeap = date('L');
                            if($isLeap) $lastDay = 29;
                            else $lastDay = 28;
                        
                        }else{
                            $lastDay = 30;
                        }
                        
                    }elseif($period == 3){
                            $startMonth = 1;
                    }
                    
                    date_date_set($startDate, $year, $startMonth, $firstDay);
                    date_date_set($endDate, $year, $endMonth, $lastDay);
                    $startDate = date_format($startDate,"Y-m-d");
                    $endDate = date_format($endDate,"Y-m-d");

                }else{
                    $startDate = $_POST['startDate'];
                    $endDate = $_POST['endDate'];

                    }

                
                // echo $startDate."<br>";
                // echo $endDate, PHP_EOL;

                    $loggedUserId = $_SESSION['id'];
                //$query = "SELECT expenses.id, expenses.expense_category_assigned_to_user_id, expenses.amount, expenses.date_of_expense FROM expenses WHERE expenses.user_id = '$loggedUserId' ";

                $incomeQuery = "SELECT incomes.id, incomes.income_category_assigned_to_user_id, incomes.amount, incomes.date_of_income, incomes.income_comment, incomes_category_default.name FROM incomes INNER JOIN incomes_category_default ON incomes_category_default.id = incomes.income_category_assigned_to_user_id  WHERE incomes.user_id = '$loggedUserId' AND incomes.date_of_income >= '$startDate'AND incomes.date_of_income <= '$endDate'; " ;

                $incomeCategoryQuery = "SELECT incomes.id, incomes.income_category_assigned_to_user_id, sum(incomes.amount), incomes.date_of_income, incomes_category_default.name FROM incomes INNER JOIN incomes_category_default ON incomes_category_default.id = incomes.income_category_assigned_to_user_id  WHERE incomes.user_id = '$loggedUserId' AND incomes.date_of_income >= '$startDate'AND incomes.date_of_income <= '$endDate' GROUP BY incomes.income_category_assigned_to_user_id ;" ;

                //    $query = "SELECT incomes.id, incomes.income_category_assigned_to_user_id, incomes.amount, incomes.date_of_income FROM incomes WHERE user_id = '$loggedUserId' GROUP BY incomes.income_category_assigned_to_user_id;" ;


                $expenseQuery = "SELECT expenses.id, expenses.expense_category_assigned_to_user_id, expenses.amount, expenses.date_of_expense, expenses_category_default.name FROM expenses INNER JOIN expenses_category_default ON expenses_category_default.id = expenses.expense_category_assigned_to_user_id  WHERE user_id = '$loggedUserId' AND expenses.date_of_expense >= '$startDate' AND expenses.date_of_expense <= '$endDate'; " ;

                $expenseCategoryQuery = "SELECT expenses.id, expenses.expense_category_assigned_to_user_id, sum(expenses.amount), expenses.date_of_expense, expenses_category_default.name FROM expenses INNER JOIN expenses_category_default ON expenses_category_default.id = expenses.expense_category_assigned_to_user_id  WHERE user_id = '$loggedUserId' AND expenses.date_of_expense >= '$startDate' AND expenses.date_of_expense <= '$endDate' GROUP BY expenses.expense_category_assigned_to_user_id ; " ;

                

                $incomeQueryResult = mysqli_query($connection, $incomeQuery);
                $incomeRecords = mysqli_num_rows($incomeQueryResult);

                $incomeCategoryQueryResult = mysqli_query($connection, $incomeCategoryQuery);
                $incomeCategoryRecords = mysqli_num_rows($incomeCategoryQueryResult);

                // echo "<p>iCR".$incomeCategoryRecords."</p>";
 
                $expenseQueryResult = mysqli_query($connection, $expenseQuery);
                $expenseRecords = mysqli_num_rows($expenseQueryResult);

                $expenseCategoryQueryResult = mysqli_query($connection, $expenseCategoryQuery);
                $expenseCategoryRecords = mysqli_num_rows($expenseCategoryQueryResult);

                // echo "<p>iCR".$expenseCategoryRecords."</p>";

                $sumOfIncomes = 0;

                if ($incomeRecords>=1) {
                    
                    echo<<<END
                    <p>Przychody</p>
                    
                    <table class="table table-striped table-bordered table-hover table-sm table-responsive-sm">
                   
                    <tr>
                        <th scope="col">l.p.</th>
                        <th scope="col">kategoria</th>
                        <th scope="col">komentarz</th>
                        <th scope="col">ilość</th>
                        <th scope="col">data</th>
                    </tr><tr>
                    END;

                    for ($i = 1; $i <= $incomeRecords; $i++) {
                
                        $row = mysqli_fetch_assoc($incomeQueryResult);
                        $a2 = $row['name'];
                        $a3 = $row['amount'];
                        $a4 = $row['date_of_income'];
                        $a5 = $row['income_comment'];
                            
                        
                        echo<<<END
                        <td >$i</td>
                        <td >$a2</td>
                        <td >$a5</td>
                        <td >$a3</td>
                        <td >$a4</td>
                        
                        </tr><tr>
                        END;
                        
                        $sumOfIncomes += $a3;
                        // $incomesArray[$a2]= $a3;              
                    }
                    
                        for ($i = 1; $i <= $incomeCategoryRecords; $i++) 
                    {
                        
                        $row = mysqli_fetch_assoc($incomeCategoryQueryResult);
                        
                        $a2 = $row['name'];
                        
                        $a3 = $row['sum(incomes.amount)'];
                        
                            
                        $incomesAmountArray[]= $a3;
                        $incomesCategoryArray[]= $a2;
                        $incomesArray [$a2] = $a3;

                    }


                }

                $sumOfExpenses = 0;

                if ($expenseRecords>=1) {
                  
                    echo<<<END
                    
                    <table width="1000" align="center" border="1" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="20" align="center" bgcolor="e5e5e5">l.p.</td>
                        <td width="100" align="center" bgcolor="e5e5e5">kategoria</td>
                        <td width="30" align="center" bgcolor="e5e5e5">ilość</td>
                        <td width="30" align="center" bgcolor="e5e5e5">data</td>
                    </tr><tr>
                    END;

                    echo "<p>Wydatki</p>";

                    for ($i = 1; $i <= $expenseRecords; $i++) 
                    {
                        
                        $row = mysqli_fetch_assoc($expenseQueryResult);
                        // $a1 = $row['id'];
                        $a2 = $row['name'];
                        $a3 = $row['amount'];
                        // $a3 = $row['sum(incomes.amount)'];
                        $a4 = $row['date_of_expense'];
                            
                        
                        echo<<<END
                        <td width="20" align="center">$i</td>
                        <td width="100" align="center">$a2</td>
                        <td width="30" align="center">$a3</td>
                        <td width="30" align="center">$a4</td>
                        </tr><tr>
                        END;
    
                        $sumOfExpenses += $a3;
                        // $expensesArray[$a2]= $a3;
    
                    }
                    
                    echo "</tr></table>";

                    for ($i = 1; $i <= $expenseCategoryRecords; $i++) 
                    {
                        
                        $row = mysqli_fetch_assoc($expenseCategoryQueryResult);
                        
                        $a2 = $row['name'];
                        
                        $a3 = $row['sum(expenses.amount)'];
                        
                            
                        $expensesAmountArray[]= $a3;
                        $expensesCategoryArray[]= $a2;
                        $expensesArray [$a2] = $a3;
                    }
                }
                
               
                
               
                
                // var_dump($array);
                
                if ($expenseCategoryRecords == 0){
                    $expensesAmountArray[] = NULL;
                    $expensesCategoryArray[] = NULL;
                 }

                if ($incomeCategoryRecords == 0){
                    $incomesAmountArray[] = NULL;
                    $incomesCategoryArray[] = NULL;
                }

                
               

                // var_dump($incomesAmountArray);

                // var_dump($expensesCategoryArray);
                
                


                //header('Location: addIncome.php');
                //$_SESSION['success'] ='<div class="popupMsg"> Dodano pomyślnie! </div>';
            }

        }catch(Exception $error){
            echo '<span>Błąd serwera!</span>';
            echo '<br/>Informacja developerska:'.$error;
        }

        echo "<p>Suma przychodów: ".$sumOfIncomes."</p>";
        echo "<p>Suma wydatków: ".$sumOfExpenses."</p>";

    ?>

    <script type="text/javascript">
        var incomesAmountArray = <?php echo json_encode($incomesAmountArray); ?>;
        var incomesCategoryArray = <?php echo json_encode($incomesCategoryArray); ?>;
        var incomeCategoryRecords = <?php echo json_encode($incomeCategoryRecords); ?>;

        var expensesAmountArray = <?php echo json_encode($expensesAmountArray); ?>;
        var expensesCategoryArray = <?php echo json_encode($expensesCategoryArray); ?>;
        var expenseCategoryRecords = <?php echo json_encode($expenseCategoryRecords); ?>;

        var sumOfIncomes = <?php echo json_encode($sumOfIncomes); ?>;
        var sumOfExpenses = <?php echo json_encode($sumOfExpenses); ?>;

    </script>
    
    
    <script src="js/showGraphs.js"></script>

    <?php
        if ($incomeRecords>=1){ 
            echo '<div id="piechart-incomes"></div>';
        }
        if ($incomeRecords>=1 || $expenseRecords>=1){ 
            echo '<div id="piechart-incomes-and-expenses"></div>';
        }
        if ($expenseRecords>=1){ 
            echo '<div id="piechart-expenses"></div>';
        }
    ?>

</body>
</html>