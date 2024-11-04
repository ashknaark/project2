<?php
class Comments extends Table{
    protected $data = array(
        "id"=>0,
        "parent_id"=>0,
        "comment"=>"",
        "comment_time"=>0
    );
    public static function InsertComment($commentArray)
    {
        $conn = self::connection();
        $id = $commentArray["id"];
        $parent_id = $commentArray["parent_id"];
        $comment = $commentArray["comment"];
        $comment_time = $commentArray["comment_time"];
        $sql = "INSERT INTO `Comments`(,) ";
    }
}
