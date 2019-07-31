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
    private $decal__day;
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

    public function get_week($id = null){
        $count = 0;
        if($id === null){

            $now = getdate(time());
            $x = round((($now["yday"] + 1) / 7), 0, PHP_ROUND_HALF_DOWN );

            foreach($this->year() as $key){
                
                $date = getdate($key);
                $z = round((($date["yday"]) / 7), 0, PHP_ROUND_HALF_DOWN );

                if($x === $z){
                    $count++;
                    if($count > 7){
                        break;
                    }
                    $this->week []=  $date[0];
                }
            }

        } else {
            foreach($this->year() as $key){

                $date = getdate($key);

                $x = round((($date["yday"] + 1 ) / 7), 0, PHP_ROUND_HALF_DOWN );
                
                if($x == $id){
                    $count++;
                    if($count > 7){
                        break;
                    }
                    $this->week []=  $date[0];
                }
            }
        }

        return $this->week;
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
                var_dump($decal__day);
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