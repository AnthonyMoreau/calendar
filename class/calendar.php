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
    const SECONDES_PERS_DAY = 86400;
    
    private $remote = 2;
    private $next = 2;

    private $year__last__contruct = [];
    private $year__next__contruct = [];
    private $day;
    private $week = [];

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

            } elseif($id === "now") {

               $x = $this->week_num($this->get_date_now());
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

                if($count_week === $id){

                    while($min < $max){
    
                        $week = getdate($key__);
                        $week__ []= [
                            $count_week => $week
                        ];
                        $key__ += self::SECONDES_PERS_DAY;
                        $min++;
                    }
                }
            }
        }
        return $week__;
    }

    public function week_num($date = false, $key = null){
        if($key !== null AND $date === false ){
            
            $x = round($key / 7, 0, PHP_ROUND_HALF_DOWN);

        } else {
            $x = round($date["yday"] / 7, 0, PHP_ROUND_HALF_DOWN);
        }
        return $x;
    }

    public function focused($weeks, $year = null){
        $a = 0;

        if($year === null){
            $a = -1;
            foreach($weeks as $key){
                $x = getdate($key);   
                if($x["year"] !== $this->get_date_now()["year"]){
                    $a++;
                } else {
                    break;
                }
            }
        } else{
            foreach($weeks as $key){
                $x = getdate($key);   
                if($x["year"] !== $year){
                    $a++;
                } else {
                    break;
                }
            }
        }
        return $a;
    }

    public function focuse($date = null, $value, $focused, $day = null){
        $focuse = false;

        if($date === null){

            $date_ = getdate();

            $day = $date_["mday"];
            $month = $date_["mon"];
            $year = $date_["year"];

            if($day === $value[$focused]["mday"] AND $month === $value[$focused]["mon"] AND $year === $value[$focused]["year"]){

                $focuse = true;
            }

        } else {
            
            $x = explode("/", $date);
            if($x[0] === $value["mday"] AND $x[1] === $value["mon"] AND $sx[2] === $value["year"]){
                dd($value["mday"]);
                $focuse = true;
            }
        }
        return $focuse;
    }

    public function calendar($value, $week_num, $focuse){

            $week_day = ($value[$week_num]["weekday"] ? $value[$week_num]["weekday"] : false);
            $month_day = ($value[$week_num]["mday"] ? $value[$week_num]["mday"] : false);
            $month = ($value[$week_num]["month"] ? $value[$week_num]["month"] : false);
            $hours = $value[$week_num]["hours"]
            
        ?>

        <?php $limite = ($week_day) ? true : false; ?>
            <?php if($limite) : ?>
                <div id="day" class="<?= $week_day ?>">  
                    <?= $this->translate(self::DAY, $week_day) ?> 
                    <?= $month_day ?> 
                    <?= $this->translate(self::MONTH, $month) ?>                         
                    
                    <div id="sections" class="morning">
                        <textarea name="morning" id="morning" cols="10" rows="10" <?php  if($focuse AND $hours  < 12){echo "autofocus='focused'";} ?>></textarea>
                    </div>
                    <div id="sections" class="afternoon">
                        <textarea name="afternoon" id="afternoon" cols="10" rows="10" <?php if($focuse AND $hours >= 12){echo "autofocus='focused'";} ?>></textarea>
                    </div>
                </div>
            <?php endif ?>
            <?php

    }


//--------------------------------------------------------------------
    private function next(){
        return $this->next;
    }

    private function remote(){
        return $this->remote;
    }

    private function get_number_years(){
        return $this->remote() + $this->next();
    }

    private function year_now(){
        return $this->remote + 1;
    }

    private function decale_day(){
        return $this->get_date_now()[0] - self::SECONDES_PERS_DAY;
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
        return getdate(mktime(0, 0, 0, 1, 1, ($this->get_date_now()["year"]) - $this->remote()));
    }

    private function get_next_year(){
        return getdate(mktime(0, 0, 0, 1, 1, ($this->get_date_now()["year"] + $this->next())));
    }

    private function remote_year(){

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

    private function translate($tab, $element){

        foreach($tab as $key => $value){
            if($element === $key){
                $element = $value;
            }
        }
        return $element;
    }
}