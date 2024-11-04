<?php
include_once "includes/includes.php";

$test = Product::getProductById(63);
var_dump($test);