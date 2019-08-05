<?php

class my_dabatase extends PDO {

    private $db_user;
    private $db_pass;
    private $construct;

    private $pdo;

    public function __construct(){

        $this->db_user = "root";
        $this->db_pass = "root";
        $this->construct = "mysql:dbname=agenda;host=127.0.0.1;charset=UTF8";

        $this->pdo =  new PDO($this->construct, $this->db_user, $this->db_pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    }


    public function insert_day_description($post){

        $a = [];
        $year = "";
        foreach($post as $key => $value){

            if(!empty($value)){

                if($key !== "year"){

                    $description = $post[$key];
                    $a = explode("_", $key);
                    $a []= $description;

                } else {

                    if($key === "year"){
                        
                        $year = $post["year"];
                        $a []= $year;
                    }
                }
            }
        }

        if(count($a) > 1){

            $req = $this->pdo->prepare('SELECT * FROM base WHERE types= ? AND yday= ? AND years= ?');
            $b = [$a[0], $a[1], $a[3]];
            $req->execute($b);
            $result = $req->fetchAll();

   
            if(!empty($result)){

                $req_ = $this->pdo->prepare("UPDATE base SET types= ?, yday= ?, descriptions= ?, years= ?");
                $req_->execute($a);
            
            } else {
    
                $req__ = $this->pdo->prepare("INSERT INTO base SET types= ?, yday= ?, descriptions= ?, years= ?");
                $req__->execute($a);
            }
        }
    }
}