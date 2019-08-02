<?php 
require "class/calendar.php";
require "functions.php";

$day_date = getdate();

session_start();

//initialise l'année en cours.......

$calendar = new Calendar($day_date, 2);
$year = $calendar->year();
$get_weeks = $calendar->get_weeks($year);
$week__N = false;

$_SESSION["count"];

if(empty($_POST)){
    $_SESSION["count"] = 0;
}

if(!empty($_POST)){
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
                    <?php 
                        $week_day = ($value[$week_num]["weekday"] ? $value[$week_num]["weekday"] : "Jour Non identifié");
                        $month_day = ($value[$week_num]["mday"] ? $value[$week_num]["mday"] : 0);
                        $month = ($value[$week_num]["month"] ? $value[$week_num]["month"] : "Mois Non identifié");
                        $year = ($value[$week_num]["year"] ? $value[$week_num]["year"] : 0);
                        $year_day = ($value[$week_num]["yday"] ? $value[$week_num]["yday"] : 0);
                    ?>

                    <?php $limite = ($week_day) ? true : false; ?>
                        <?php if($limite) : ?>
                            <p id="day" class="<?= $week_day ?>">  
                                <?= $calendar->translate($calendar::DAY, $week_day) ?> 
                                <?= $month_day ?> 
                                <?= $calendar->translate($calendar::MONTH, $month) ?>                         
                                <?php $week__N = (int) round($year_day / 7, 0, PHP_ROUND_HALF_DOWN);
                                ?>
                            </p>
                        <?php endif ?>
                    <?php endforeach ?>
                    
                    <span class="year"><?php if($year) {echo $year;} ?></span>
                    <span class="weeks">Semaine  <?php if($week__N) {echo $week__N;} else { echo "Vous ne pouvez pas accéder à ce semaine" ;} ?></span>
                    <div class="buttons">
                        <input name="control" type="submit" value="&larr;">
                        <input name="control" type="submit" value="&rarr;">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>