<?php 
require "class/calendar.php";
require "functions.php";

//initialise l'année en cours.......
$calendar = new Calendar(getdate());
$year = $calendar->year();

$count = 0;
$weeks = 1;
?> 


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Calendrier</title>
</head>
<body>

    <div class="calendar">
        <?php foreach($year as $key) : ?>
            <?php $date = getdate($key)?>

            <?php if ($count % 7 === 0) :?>
            <div class="week <?= $weeks++ ?>">
            <?php endif ?>

                <div id="<?= $date["weekday"] ?>">
                    <p><?= $date["weekday"] ?>, <?= $date["yday"] ?>, <?= $date["month"] ?></p>
                </div>
                <?php $count++ ?>

            <?php if ($count % 7 === 0) :?>
            </div>
            <?php endif ?>

        <?php endforeach ?>
        <button class ="previous">-</button>
        <button class="next">+</button>
    </div>

<script type="text/javascript">
    let week_num = '<?= $calendar->week_num(getdate()) ?>';
    let next = document.querySelector('.next');
    let previous = document.querySelector('.previous');
    console.log(next);
    let weeks = document.querySelectorAll(".week");
    next.addEventListener('click', function(){
        week_num++;
    })
    previous.addEventListener('click', function(){
        week_num--;
    })
    setInterval(function(){
        for (let i = 0; i < weeks.length; i++) {
            if(weeks[i].classList.contains(week_num.toString())){
                weeks[i].classList.add('transition');
            } else {
                weeks[i].classList.remove('transition');
            }
        }
    }, 500)
</script>
</body>
</html>






