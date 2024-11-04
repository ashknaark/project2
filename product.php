<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <?php
    require_once "includes/includes.php"
    ?>



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

        <?php

        $Id =$_SERVER['QUERY_STRING'][3].$_SERVER['QUERY_STRING'][4];



        if ($product = Product::getProductById($Id)){
            foreach ($product as $pro){?>

              <div class="container m-3">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="card">
                              <div class="card-body">
                                  <div class="img-parent">
                                      <img src= <?php  echo "images/".$pro["imgsrc"]?> alt="">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-8 bg-light" >
                          <dl>
                              <dt class="col-sm-6"><strong> قیمت</strong></dt>
                              <dd class="col-sm-6 m-0"> <?php echo $pro["price"] ?>  </dd>

                              <dt class="col-sm-6"><strong> توضیحات </strong></dt>
                              <dd class="col-sm-6 m-0"> <?php echo $pro["comment"] ?></dd>

                              <dt class="col-sm-6"><strong>دسته بندی</strong></dt>
                              <dd class="col-sm-6 m-0"> <span class="badge badge-primary">
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
                                  </span></dd>


                          </dl>
                      </div>
                  </div>
              </div>





            <?php }} ?>


    </div>



</div>

</body>
</html>