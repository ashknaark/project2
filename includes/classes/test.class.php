<?php
class Test extends Table{
    protected $data = array(
        "firstName" => " ",
        "lastName"=>" ",
        "userName"=>" ",
        "password"=>" ",
        "email"=>" ",
        "role"=>0
    );

    public static function selectUser($userName){
       $conn = self::connection();
       $userName = trim($userName);
       $sql=( "SELECT *FROM `users` WHERE `password` = $userName");
       var_dump($sql);
       $result = $conn->query($sql);
       if ($result->num_rows){
           $user  = [];
           $rows = $result->fetch_all(MYSQLI_ASSOC);
           foreach ($rows as $row) {
               array_push($user , $row);
           }
           $ret = $user;
       }
       else
           $ret = false;
       self::disconnect($conn);
       return $ret;
    }

}