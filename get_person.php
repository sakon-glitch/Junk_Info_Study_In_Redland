<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include "db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM Tb_PersonalInfo WHERE id=$id";
$result = $conn->query($sql);
$person = $result->fetch_assoc();

$addrSql = "SELECT id, village, district, province FROM Tb_Address WHERE personalId=$id";
$addrResult = $conn->query($addrSql);
$addresses = [];
while ($row = $addrResult->fetch_assoc()) {
  $addresses[] = $row;
}

$response = [
  "id" => $person["id"],
  "firstName" => $person["firstname"],
  "lastName" => $person["lastname"],
  "tel" => $person["tel"],
  "address" => $addresses
];

echo json_encode($response);
?>