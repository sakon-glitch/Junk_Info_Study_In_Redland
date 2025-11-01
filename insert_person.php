<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$firstName = $data["firstName"];
$lastName = $data["lastName"];
$tel = $data["tel"];
$dateOfBirth = $data["dateOfBirth"];

// Calculate age (simple method)
$birthDate = new DateTime($dateOfBirth);
$today = new DateTime("today");
$age = $birthDate->diff($today)->y;

// Insert into personal info
$sql = "INSERT INTO Tb_PersonalInfo (firstname, lastname, dateofbirth, tel, age)
        VALUES ('$firstName', '$lastName', '$dateOfBirth', '$tel', '$age')";
$conn->query($sql);
$personId = $conn->insert_id;

// Example: Insert 3 addresses
$addresses = [
  ["village" => "Vill A", "district" => "Dist X", "province" => "Prov Y"],
  ["village" => "Vill B", "district" => "Dist B", "province" => "Prov B"],
  ["village" => "Vill C", "district" => "Dist C", "province" => "Prov C"]
];

foreach ($addresses as $addr) {
  $v = $addr["village"];
  $d = $addr["district"];
  $p = $addr["province"];
  $conn->query("INSERT INTO Tb_Address (village, district, province, personalId) VALUES ('$v','$d','$p',$personId)");
}

// Build response
$response = [
  "id" => $personId,
  "firstName" => $firstName,
  "lastName" => $lastName,
  "tel" => $tel,
  "address" => $addresses
];

echo json_encode($response);
?>
