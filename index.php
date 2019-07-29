<?php 

CONST second__day = 86400;

date_default_timezone_set('UTC');
// echo date('l jS \of F Y h:i:s A');

$__H = date("G");
$__m = date("i");
$__s = date("s");

$__now = getdate();

$now = $__now[0];


$last_year = getdate(mktime(0, 0, 0, 1, 1, ($__now["year"] - 1)));
$next_year = getdate(mktime(0, 0, 0, 1, 1, ($__now["year"] + 1)));
$tomorrow  = getdate(mktime($__H, $__m, $__s, date("m")  , date("d")+1, date("Y")));
$lastmonth = getdate(mktime($__H, $__m, $__s, date("m")-1, date("d"),   date("Y")));

$year__last__contruct = [];
$year__next__contruct = [];

while($now > $last_year[0]){
    $date = getdate($now);
        ?>
            <p><?= $date["weekday"] ?>, <?= $date["mday"] ?>, <?= $date["month"] ?></p>
        <?php
    $now -= second__day;    
}





