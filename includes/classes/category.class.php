<?php
class Category extends Table{
    protected $data = array(
        "id" =>0,
        "category_name"=> "",
        "parent_id"=>0
    );
    public static function getAllCategory(){
     $conn  =   self::connection();
     $sql = "SELECT * FROM `category` ORDER  BY `id` DESC";
     $result = $conn->query($sql);
    if ($result->num_rows){
        $cats = [];
        $rows = $result->fetch_all(MYSQLI_ASSOC);
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
    public static function getCategoryByParentId($parentId){
        $conn  = self::connection();
        $sql = "SELECT * FROM `category` WHERE `parent_id` = $parentId";
        $result = $conn->query($sql);
        if ($result->num_rows){
            $cats = [];
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $row) {
                array_push($cats , $row);
            }
            $ret= $cats;
        }
        else
            $ret = false;
        self::disconnect($conn);
        return $ret;
    }

}