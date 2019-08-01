<?php 
require "class/calendar.php";

//initialise l'année en cours.......
$calendar = new Calendar(getdate());


//retourne l'année en cours
$year = $calendar->year();



//recuperation semaines
$get_weeks = $calendar->get_weeks($year);


//make semaines......
$weeks = $calendar->make_weeks($get_weeks, 32);


var_dump($weeks);
die();








