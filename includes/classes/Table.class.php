<?php
class Table{
    protected $data = array();
    function __construct($data){
        foreach ($data as $key =>$value){
            if (array_key_exists($key , $this->data )){
                if (is_numeric($value)){
                    $this->data[$key] = (int)$value;;
                }
                else
                    $this->data[$key] = $value;
            }
        }

    }
    function __get($property){
        if (array_key_exists($property , $this->data)) return $this->data[$property];
        else
            die("invalid property");
    }

    public static function connection (){
        $conn = new mysqli(HOST , USERNAME , PASS, DBNAME );
        $conn->set_charset("utf8");
        if ($conn->connect_error){
            echo "error".$conn->connect_error;
        }

        return $conn;

    }
    public static function disconnect($conn){
        unset($conn);
    }
}