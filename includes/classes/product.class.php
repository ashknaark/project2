<?php
class Product extends Table{

    protected $data = array(
        "id"=>0,
        "prName"=>"",
        "prCat"=>"",
        "imgsrc"=>"",
        "comment"=>"",
        "price"=>""

    );
    public static function getAllProducts($limit = 0 ,  $start = 0){
        if($limit > 0 ){
            $limiter = "LIMIT $start , $limit";
        }
        else{
            $limiter ="";
        }
        $conn = self::connection();
        $sql = "SELECT * FROM `product` ORDER BY `id`DESC $limiter";
        $result = $conn->query($sql);
        if ($result->num_rows){
            $pro = [];
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
                array_push($pro , $row);
            }
            $ret = $pro;
        }
        else $ret = false;
        self::disconnect($conn);
        return $ret;
    }


    public static function insertPost($prArray){
        $ret  = true;
        $conn = self::connection();
        $prName = $prArray["prName"];
        $prCat = $prArray["prCat"];
        $imgsrc = $prArray["imgsrc"];
        $comment = $prArray["comment"];
        $price = $prArray["price"];

        $sql= "INSERT INTO `product` (prName , prCat , imgsrc  , comment ,price ) VALUE ('$prName', '$prCat' ,'$imgsrc','$comment' , '$price')";



        if(!$conn->query($sql)){
            $ret=false;
            self::disconnect($conn);
            return $ret;
        }


    }


    public static function deleteProduct($id){
        $conn = self::connection();
        $sql = "DELETE FROM `product` WHERE `id` = $id ";
        $result = $conn->query($sql);

        self::disconnect($conn);
        return $result;

    }

    public static function findProductByCat($prCat){
        $conn = self::connection();

        $sql= "SELECT * FROM `product`WHERE ";

        switch ($prCat){
            case 1 :
                $sql.= "`prCat` = 1  ORDER BY `id` DESC";
                break;
            case 2 :
                $sql.= "`prCat` = 2  ORDER BY `id` DESC";
                break;
            case 3 :
                $sql.= "`prCat` = 3  ORDER BY `id` DESC";
                break;
            case 4 :
                $sql.= "`prCat` = 4  ORDER BY `id` DESC";
                break;
        }
        $result = $conn->query($sql);

        if ($result->num_rows){
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $cats = [];
            foreach ($rows as $row){
                array_push($cats , $row);
            }
            $ret = $cats;
        }
        else
            $ret = false;
        self::disconnect($conn);
        return $ret;
    }
    public static function getProductById($id){
       $conn = self::connection();
       $sql = "SELECT * FROM `product` WHERE `id` =$id ";
       $result = $conn->query($sql);

       if ($result->num_rows){
           $prod = array();
           $rows = $result->fetch_assoc();
               array_push($prod , $rows);

           $ret = $prod;
       }
       else{
           $ret = false;
       }
       self::disconnect($conn);
       return $ret ;
    }


}