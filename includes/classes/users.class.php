<?php
class Users extends Table{
    protected $data = array(
        "firstName" => "",
        "lastname"=>"",
        "userName"=>"",
        "password"=>"",
        "email"=>"",
        "role"=>0,
        "mobile"=>0
    );


    public static function selectUser($mobile , $password){
        $conn = self::connection();
        $sql = "SELECT * FROM `users` WHERE `mobile` = $mobile AND `password` = $password";
        $result = $conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $userId = $row["id"];
            $userIp = $_SERVER["REMOTE_ADDR"];
            $email = $row["email"];
            $userN = $row["userName"];
            $details = "ورود";
            $sql = "INSERT INTO `login` (userId , userIp , email , userName , details) VALUE ($userId,$userIp,'$email','$userN','$details')";
            $result = $conn->query($sql);


            $ret = $result;

            $userSession = array(
                "SignInKey" => true ,
                "id" => $row["id"] ,
                "firstName" => $row["firstName"] ,
                "lastName" => $row["lastName"] ,
                "fullName" => $row["firstName"] . " " . $row["lastName"]   ,
                "userName" => $row["userName"] ,
                "password" => $row["password"],
                "mobile" => $row["mobile"]
            );

            $_SESSION["userInfo"] = $userSession ;
        }
        else
            $ret = false;
        self::disconnect($conn);
        return $ret;
    }
}