<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <?php require_once "includes/includes.php"; ?>

</head>
<body>

<div class="main">
    <div class="page-1">
        <div class="nav">

            <ul>
                <li><a href="index.php"><span class="fa fa-home m-2"></span> خانه</a></li>
                <li><a href="#"><span class="fa fa-gift m-2"></span>محصولات</a>
                    <ul>
                        <?php
                        if ($cats = Category::getCategoryByParentId(0)){
                            foreach ($cats as $cat) {?>
                                <li><a href=""><?php echo $cat["catName"]?></a></li>

                            <?php }} ?>
                    </ul>

                </li>
                <li><a href="loginform.php"><span class="fa fa-user m-2"></span>ورود کابر</a></li>
                <li><a href="#"><span class="fa fa-phone m-2"></span>تماس با ما</a></li>
            </ul>

        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 ">
                    <div class="card bg bg-dark text-light" id="submit-form">
                        <div class="card-header">ثبت محصول</div>
                        <div class="card-body ">
                            <form action="" method="post" enctype="multipart/form-data">

                                <?php

                                if (isset($_POST["submit"])) {
                                    if (!empty($_POST["prName"]) && !empty($_POST["prCat"]) && !empty($_FILES["imgsrc"]) && !empty($_POST["comment"]) && !empty($_POST["price"])) {

                                        $prArray = array(
                                            'prName' => $_POST["prName"],
                                            'prCat' => $_POST["prCat"],
                                            'imgsrc' => $_FILES["imgsrc"]["name"],
                                            'comment' => $_POST["comment"],
                                            'price' => $_POST["price"]
                                        );
                                        Product::insertPost($prArray);

                                        $uploadDir = __DIR__ . "/images/" ;
                                        $uploadFilePath = $uploadDir . $_FILES["imgsrc"]["name"] ;
                                        $allowedFile_type = array("image/jpeg","image/png","image/gif","image/webp");


                                        if(file_exists($uploadFilePath)){
                                            $uploadFilePath = $uploadDir . rand(11,9999) . "_" . $_FILES["imgsrc"]["name"] ;
                                        }
                                        if(in_array($_FILES["imgsrc"]["type"] , $allowedFile_type)) {
                                            if (move_uploaded_file($_FILES["imgsrc"]["tmp_name"], $uploadFilePath)) {
                                                echo "<div class='alert alert-success'>
                                                    <p class='lead'>upload File Successfully Complited!</p>
                                                         </div>";

                                                         }
                                            else {
                                                echo "<div class='alert alert-danger'>
                                                   <p class='lead'>Error While Uploading File!</p>
                                                    </div>";
                                            }

                                        }
                                        else{
                                            echo "<div class='alert alert-warning'>
                                            <p class='lead'>You can Not upload This File Type!</p>
                                            </div>";
                                        }
                                    }
                                }
                                ?>


                                <div class="form-group">


                                    <label for="">نام محصول</label>
                                    <input type="text" class="form-control border-dark" placeholder=" نام محصول" name="prName" >
                                </div>

                                <div class="form-group">
                                    <label for="">عکس محصول</label>
                                    <input type="file" placeholder="عکس مجصول" class="form-control border-dark" name="imgsrc">
                                </div>
                                <div class="form-group">
                                    <label for="">قیمت </label>
                                    <input type="text" placeholder="قیمت " class="form-control border-dark" name="price">
                                </div>


                                <div class="form-group">
                                    <label for="">توضیحات</label>
                                    <input type="text" class="form-control border-dark" placeholder="توضیحات" name="comment" >
                                </div>

                                <div class="form-group">
                                    <label for="">دسته بندی محصول </label>
                                    <select name="prCat" id="" class="form-control">

                                        <option value="1">کالای دیجیتال</option>
                                        <option value="2">پوشاک</option>
                                        <option value="3"> لوازم ورزشی</option>
                                        <option value="4">لوازم تحریر</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-block btn-success mb-5">ثبت کالا</button>
                                </div>

                            </form>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>








    </div>


</div>


</body>
</html>