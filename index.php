<?php 

CONST seconds_per_day = 86400;

date_default_timezone_set('Europe/Paris');
// echo date('l jS \of F Y h:i:s A');

$__H = date("G");
$__m = date("i");
$__s = date("s");

$__now = getdate();

$now = $__now[0];

$last_year = getdate(mktime(0, 0, 0, 1, 1, ($__now["year"])));
$next_year = getdate(mktime(0, 0, 0, 1, 1, ($__now["year"] + 1)));
$tomorrow  = getdate(mktime($__H, $__m, $__s, date("m")  , date("d")+1, date("Y")));
$lastmonth = getdate(mktime($__H, $__m, $__s, date("m")-1, date("d"),   date("Y")));

$year__last__contruct = [];
$year__next__contruct = [];

$decal__day = $now - seconds_per_day;

while($decal__day > $last_year[0]){
    $date = getdate($decal__day);
        $year__last__contruct []= $date[0];
    $decal__day -= seconds_per_day;    
}

while($now < $next_year[0]){
    $date = getdate($now);
        $year__next__contruct []= $date[0];
    $now += seconds_per_day;    
}

$year = array_merge(array_reverse($year__last__contruct) , $year__next__contruct);

foreach($year as $key){
    $date = getdate($key);
    $week_end = ($date["weekday"] === "Saturday" || $date["weekday"] === "Sunday") ? "color: red" : null;
    $today = $__now;
    $today__n = ($today["weekday"] === $date["weekday"] AND $today["mday"] === $date["mday"] AND $today["month"] === $date["month"]) ? "Aujourd'hui" : null;
    ?>
        <p style="<?= $week_end ?>"><?= $date["weekday"] ?>, <?= $date["mday"] ?>, <?= $date["month"] ?>, <?= $date["year"] ?>, <span style="font-size: 2em; color:green"><?= $today__n ?></span></p>

    <?php
}




