<?php 
require "class/calendar.php";
require "functions.php";

$day_date = getdate();
session_start();

//initialise l'année en cours.......
$calendar = new Calendar($day_date);
$year = $calendar->year();
$get_weeks = $calendar->get_weeks($year);

$_SESSION["count"];
$focused_ = null;
$week__N = false;

if(empty($_POST)){

    $focused_ = $calendar->focused($get_weeks);
    $_SESSION["count"] = $focused_;

} else {
    $control = $_POST["control"];

    if($control === '→' ){
        $_SESSION["count"]++;
    } 
    if ($control === '←') {
        $_SESSION["count"]--;
    }
}

$week_num = (int) $calendar->week_num($day_date) + $_SESSION["count"];
$weeks = $calendar->make_weeks($get_weeks, $week_num);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="site-content">
        <form action="" method="POST">
            <div class="calendar-container">
                <div class="calendar">
                    <?php foreach($weeks as $key => $value) : ?>
                        
                        <?php $focuse = $calendar->focuse(null, $value, $week_num) ?>
                        <?= $calendar->calendar($value, $week_num, $focuse)  ?>

                        <?php $year = ($value[$week_num]["year"] ? $value[$week_num]["year"] : false); ?>
                        <?php $year_day = ($value[$week_num]["yday"] ? $value[$week_num]["yday"] : false); ?>
                        <?php $week__N = (isset($year_day)) ? (int) round($year_day / 7, 0, PHP_ROUND_HALF_DOWN) : false; ?>

                    <?php endforeach ?>
                    <span class="year"><?php if($year) {echo $year;} ?></span>
                    <span class="weeks">Semaine  <?php if($week__N) {echo $week__N;} else { echo "Vous ne pouvez pas accéder à ce semaine" ;} ?></span>
                    <div class="buttons">
                        <input name="control" type="submit" value="&larr;">
                        <input name="control" type="submit" value="&rarr;">
                    </div>
                </div>
            </div>
            <div class="submit">
                <input type="submit" value="Mettre à jour">
            </div>
        </form>
    </div>
</body>
</html>