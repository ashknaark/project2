<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="style/style.css">
    <?php require_once "includes/includes.php"; ?>
</head>

<body>

<?php
if (isset($_POST["submit"])){
    if (!empty($_POST["mobile"] && !empty($_POST["password"]))){
        $user = Users::selectUser($_POST["mobile"] , $_POST["password"]);

    }
    else{
        echo "<span class='alert alert-danger'>لطفا فرم را تکمیل کنید</span>";
    }
}
?>
<div class="main">
    <div class="page-1">
        <div class="nav">

            <ul>
                <?php
                if (isset($_SESSION["userInfo"])) {?>
                    <li><a ><?php echo $_SESSION["userInfo"]["fullName"]?></a></li>
                <?php } ;
                ?>
                <li><a href="index.php"><span class="fa fa-home m-2"></span> خانه</a></li>
                <li><a href="#"><span class="fa fa-gift m-2"></span>محصولات</a>
                    <ul>
                        <?php
                        if ($cats = Category::getCategoryByParentId(0)){
                            foreach ($cats as $cat) {?>
                                <li><a href="<?php echo '?$prCat='.$cat['id']?>"><?php echo $cat["catName"]?></a></li>
                            <?php }} ?>


                    </ul>

                </li>
                <li><a href="admin_form.php"><span class="fa fa-user m-2"></span>ورود کابر</a></li>
                <li><a href="#"><span class="fa fa-phone m-2"></span>تماس با ما</a></li>
                <?php
                if (isset($_SESSION["userInfo"])){ ?>
                    <li><a href="admin_form.php" >ثبت محصول</a></li>


                <?php  }
                ?>
            </ul>

        </div>
        <?php
        if (isset($_SESSION["userInfo"])){?>
            <span class="alert alert-success float-right ">با موفقیت وارد شدید </span>
        <?php } ?>

        <div class="container" id="login">
            <div class="row justify-content-center">
                <div class="col-md-5 ">
                    <div class="card bg-dark" >
                        <div class="card-header bg-dark text-light"></div>
                        <div class="card-body bg-dark text-light">
                            <form action="" method="post">
                                <fieldset>
                                    <legend> ورود مدیر  <span class="fa fa-user"></span> </legend>
                                    <hr>

                                    <div class="form-group">
                                        <label for="">شماره موبایل </label>
                                        <input type="text" class="form-control border-dark" placeholder="شماره موبایل " name="mobile" required>
                                    </div>

                                    <div class="form-group">

                                        <label for="">رمزعبور</label>
                                        <input type="password" class="form-control border-dark" placeholder="رمزعبور" name="password" required >
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-block btn-success">ثبت نام</button>
                                    </div>


                                </fieldset>
                            </form>
                        </div>
                        <div class="card-footer bg-dark text-light">
                            <?php
                            if (isset($_SESSION["userInfo"])){
                                echo "<button class='btn btn-warning' id='show'> ثبت  محصول </button>";
                            }
                            ?>
                        </div>
                    </div>




                </div>



            </div>







</body>
</html>