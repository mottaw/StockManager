<?php
session_start();

require_once "php/data.php";

if(!isset($_SESSION["products"])){
    $_SESSION["products"] = $products;
}
