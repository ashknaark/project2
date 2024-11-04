<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <?php  require_once "includes/includes.php" ?>
</head>
<body>

<div class="main">
    <div class="page-1">
        <div class="nav">

            <ul>
                <li><a href="#"><span class="fa fa-home m-2"></span> خانه</a></li>
                <li><a href="#"><span class="fa fa-gift m-2"></span>محصولات</a>
                <ul>
                    <?php
                        if ($cats = Category::getCategoryByParentId(0)){
                            foreach ($cats as $cat) {?>
                               <li><a href="<?php echo '?prCat='.$cat['id'] ; ?>"><?php echo $cat["catName"] ; ?></a></li>
                                <?php   $finds = Product::findProductByCat($cat["id"]);?>
                            <?php }}?>


                </ul>

                </li>
                <li><a href="loginform.php"><span class="fa fa-user m-2"></span>ورود کابر</a></li>
                <li><a href="#"><span class="fa fa-phone m-2"></span>تماس با ما</a></li>
            </ul>


        </div>
        <div class="hero">
            <p>خوش آمدید </p>
            <div id="show">
                <a href="loginform.php"><button class="btn btn-warning text-light m-2">ورود کاربر </button></a>
            </div>
        </div>



    </div>

    <div class="page2">
        <div class="container-fluid">
            <div class="row">



       <?php
       if (isset($_GET["section"]) &&is_numeric($_GET["section"])){
           $section = $_GET["section"];
       }
       else
           $section = 1;
       $start = ($section-1)*MAX_POST;


       if ($pros = Product::getAllProducts(MAX_POST , $start)){
           foreach ($pros as $pro){?>
               <div class="col-md-3">
                   <div class="card bg bg-danger text-light mt-5">
                       <div class="card-header text-center">
                           <h3><?php echo $pro["prName"]?></h3>

                       </div>
                       <div class="card-body">
                         <div class="img-parent">  <img src="images/<?php echo $pro['imgsrc']?>" class="w-100 h-100" alt=""></div>
                           <span class="badge badge-primary float-right m-2 p-2">
                               <?php
                               switch ($pro["prCat"]){
                                   case (1):
                                       echo "کالای دیجیتال";
                                       break;
                                   case (2):
                                       echo "پوشاک ";
                                       break;
                                   case (3):
                                       echo "لوازم ورزشی ";
                                       break;
                                   case (4):
                                       echo "لوازم تحریر ";
                                       break;

                               }
                               ?>
                           </span>

                       </div>
                       <div class="card-footer">
                           <p><?php echo $pro["comment"]?></p>
                           <span class="fa fa-dollar"><?php echo $pro["price"]?></span>

                           <a href="product.php?id=<?php echo $pro['id']?>"><button class="btn btn-success float-right">خرید</button></a></div>

                   </div>
               </div>

     <?php      }  } ?>
            </div>
        </div>
        <?php      $totalPost = count(Product::getAllProducts());
        $totalSection =ceil( $totalPost /MAX_POST);
        ?>

        <p class="paging-title">صفحه‌ی <?php echo $section ; ?> از <?php echo $totalSection ?></p>


     <div class="footer">

                 <div class="paging">
                     <?php

                     for($i = 1 ; $i <= $totalSection ; $i++){
                         if($i == $section){
                             $class = "class=active";
                         }
                         else
                             $class = "" ;
                         echo  "<a href=\"./?section=$i \" $class>$i</a>";

                     }
                     ?>


                 </div>

     </div>

    </div>


</body>
</html>