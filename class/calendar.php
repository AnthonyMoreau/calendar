<?php

class Calendar {

    const DAY = [
        "Monday" => "Lundi",
        "Tuesday" => "Mardi",
        "Wednesday" => "Mercredi",
        "Thursday" => "Jeudi",
        "Friday" => "Vendredi",
        "Saturday" => "Samedi", 
        "Sunday" => "Dimanche"
    ];
    const MONTH = [
        "January" => "Janvier",
        "February" => "février",
        "March" => "Mars",
        "April" => "Avril",
        "May" => "Mai",
        "June" => "Juin",
        "July" => "Juillet",
        "August" => "Août",
        "September" => "Septembre",
        "October" => "Octobre",
        "November" => "Novembre",
        "December" => "Décembre"
    ];
    const SECONDES_PERS_DAY= 86400;


    private $year__last__contruct = [];
    private $year__next__contruct = [];
    private $day;
    private $week = [] ;

    public function __construct($date__now){
        $this->date__now = $date__now;
    }

    public function get_date_now(){
        return $this->date__now;
    }

    public function year(){
        return array_merge(array_reverse($this->remote_year()) , $this->termine_year());
    }

    public function get_weeks($year){
        $monday_ = [];
        foreach($year as $key){
            $monday = getdate($key);

            if($monday["weekday"] === "Monday"){
                $monday_ []= $monday[0];
            }
        }
        return $monday_;
    }

    public function make_weeks($weeks, $id = null){

        $week__ = [];
        $count_week = 0;
        foreach($weeks as $key){

            if($id === null){

                $min = 0;
                $max = 7;
                $key__ = $key;
                $count_week++;
                while($min < $max){
                    $week = getdate($key__);
                    $week__ []= [
                        $count_week => $week
                    ];
                    $key__ += self::SECONDES_PERS_DAY;
                    $min++;
                }
            }

            if($id === "now"){

               $x = round($this->get_date_now()["yday"] / 7, 0, PHP_ROUND_HALF_DOWN);
               $min = 0;
               $max = 7;
               $key__ = $key;
               $count_week++;

               if($x == $count_week){

                   while($min < $max){
   
                       $week = getdate($key__);
                       $week__ []= [
                           $count_week => $week
                       ];
                       $key__ += self::SECONDES_PERS_DAY;
                       $min++;
                   }
               }
               

            } else {

                $min = 0;
                $max = 7;
                $key__ = $key;
                $count_week++;

                if($id === $count_week AND $id <= 52){

                    while($min < $max){
    
                        $week = getdate($key__);
                        $week__ []= [
                            $count_week => $week
                        ];
                        $key__ += self::SECONDES_PERS_DAY;
                        $min++;
                    }
                } else {

                    return;

                }
            }
        }
        return $week__;
    }

    public function remote_year(){

        $decal__day = $this->decale_day();

        while(true){

            $date = getdate($decal__day);
            $this->year__last__contruct []= $date[0];
            $decal__day -= self::SECONDES_PERS_DAY;  
            if($decal__day < $this->get_reset_year()[0] AND getdate($decal__day)["weekday"] === "Sunday"){
                break;
            }  
        }
        return $this->year__last__contruct;
    }

    private function termine_year(){

        $decal__day = $this->get_date_now()[0];

        while(true){

            $date = getdate($decal__day);
            $this->year__next__contruct []= $date[0];
            $decal__day += self::SECONDES_PERS_DAY; 

            if($decal__day > $this->get_next_year()[0] AND getdate($decal__day)["weekday"] === "Monday"){
                break;
            }
        }
        return $this->year__next__contruct;
    }

    private function get_reset_year(){
        return getdate(mktime(0, 0, 0, 1, 1, ($this->get_date_now()["year"])));
    }

    private function get_next_year(){
        return getdate(mktime(0, 0, 0, 1, 1, ($this->get_date_now()["year"] + 1)));
    }

    private function decale_day(){
        return $this->get_date_now()[0] - self::SECONDES_PERS_DAY;
    }

    private function translate($tab, $element){

        foreach($tab as $key => $value){
            if($element === $key){
                $element = $value;
            }
        }
        return $element;
    }

}