<?php
require_once "inc/headers.php";
require_once "inc/functions.php";

$input = json_decode(file_get_contents("php://input"));
$id = filter_var($input->id, FILTER_SANITIZE_STRING);

$db = openDb();  
$db = new PDO("mysql:host=localhost;dbname=shoppinglist;charset=utf8", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = $db->prepare("delete from item where id=(:id)");
$query->bindValue(":id",$id,PDO::PARAM_INT);
$query->execute();

header("HRRP/1.1 200 ok");
$data = array("id" => $id);
print json_encode($data);

