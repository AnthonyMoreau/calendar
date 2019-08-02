<?php 
require "class/calendar.php";
require "functions.php";

session_start();


//initialise l'année en cours.......
$calendar = new Calendar(getdate());
$year = $calendar->year();
$get_weeks = $calendar->get_weeks($year);

$_SESSION["count"];

if(empty($_POST)){
    $_SESSION["count"] = 0;
}

if(!empty($_POST)){
    $control = $_POST["control"];
    if($control === "next"){
        $_SESSION["count"]++;
    } 
    if ($control === "previous") {
        $_SESSION["count"]--;
    }
}

$week_num = (int) $calendar->week_num(getdate()) + $_SESSION["count"];
$weeks = $calendar->make_weeks($get_weeks, $week_num);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">

        <div class="calendar">
            <?php foreach($weeks as $key => $value) : ?>
            <p>     
                <?= $calendar->translate($calendar::DAY, $value[$week_num]["weekday"]) ?>, 
                <?= $value[$week_num]["mday"] ?>, 
                <?= $calendar->translate($calendar::MONTH, $value[$week_num]["month"]) ?>, 
                <?= $value[$week_num]["year"] ?>
            </p>
            <?php endforeach ?>
        </div>

        <input name="control" type="submit" value="previous">
        <input name="control" type="submit" value="next">
    </form>
</body>
</html>