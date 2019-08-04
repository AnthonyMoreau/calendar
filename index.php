<?php 
require "pdo/pdo.php";
require "calendar.php";
require "functions.php";

session_start();
$day_date = getdate();
$_SESSION["count"];

if(empty($_POST)){
    
    $_SESSION["count"] = 0;

}else {

    if(empty($_POST["date"])){

        $control = $_POST["control"];
    
        if($control === '→' ){
            $_SESSION["count"]++;
            
        } 
        if ($control === '←') {
            $_SESSION["count"]--;
        }
    }
}

$date = new Calendar($day_date);
$week = $date->calendar($_SESSION["count"]);
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
                    <?php if(empty($_POST["date"])) : ?>
                        <?php foreach($week as $key => $value) : ?>
                            <div id="day" class="<?= $value["weekday"] ?>">

                                <?= $date->translate($date::DAY, $value["weekday"]) ?>
                                <?= $value["mday"] ?>
                                <?= $date->translate($date::MONTH, $value["month"]) ?>

                                <div id="sections" class="morning">
                                    <textarea name="morning_<?= $value["yday"] ?>" id="morning" cols="10" rows="10" <?php if(getdate()["hours"] < 12) {echo $date->focuse($value);} ?>></textarea>
                                </div>
                                <div id="sections" class="afternoon">
                                    <textarea name="afternoon_<?= $value["yday"] ?>" id="afternoon" cols="10" rows="10" <?php if(getdate()["hours"] >= 12) {echo $date->focuse($value);} ?>></textarea>
                                </div>
                                    <input type="hidden" name="year" value="<?= $value["year"] ?>">
                            </div>
                        <?php $year = $value["year"];?>
                        <?php $week__N = $date->week_num($value["yday"]);?>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="day">
                            <div class="day-container">
                                <?= $date->translate($date::DAY, $week["weekday"]) ?>
                                <?= $week["mday"] ?>
                                <?= $date->translate($date::MONTH, $week["month"]) ?>

                                <div id="sections" class="morning">
                                    <textarea name="morning_<?= $week["yday"] ?>" id="morning" cols="10" rows="10" <?php if(getdate()["hours"] < 12) {echo $date->focuse($value);} ?>></textarea>
                                </div>
                                <div id="sections" class="afternoon">
                                    <textarea name="afternoon_<?= $week["yday"] ?>" id="afternoon" cols="10" rows="10" <?php if(getdate()["hours"] >= 12) {echo $date->focuse($value);} ?>></textarea>
                                </div>
                                <input type="hidden" name="year" value="<?= $week["year"] ?>">
                            </div>
                        </div>
                        <?php $year = $week["year"];?>
                        <?php $week__N = ($date->week_num($week["yday"])) ? $date->week_num($week["yday"]) : 53 ?>
                    <?php endif ?>
                        <span class="year"><?php if($year) {echo $year;} ?></span>
                        <span class="weeks">Semaine  <?= $week__N ?></span>
                        <div class="buttons">
                            <input type="datetime" name="date" id="date" value="<?php if($_POST["date"]){echo $_POST["date"];} ?>">
                            <input name="control" type="submit" value="&larr;">
                            <input name="control" type="submit" value="&rarr;">
                        </div>
                    </div>
                </div>
                <div class="submit">
                    <input type="submit" value="Chercher un jour">
                    <input type="submit" value="Mettre à jour">
                </div>
            </form>
        </div>
    </body>
</html>