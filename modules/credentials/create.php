<?php
require_once "../../classes/utilities.php";
require_once "../../classes/messages.php";
require_once "../../classes/crud.php";

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  $fullname = htmlentities(htmlspecialchars(strip_tags($_POST['fullname'])));
  $email = htmlentities(htmlspecialchars(strip_tags($_POST['email'])));
  $phone = htmlentities(htmlspecialchars(strip_tags($_POST['phone'])));
  $password = htmlentities(htmlspecialchars(strip_tags($_POST['password'])));
  $website = htmlentities(htmlspecialchars(strip_tags($_POST['website'])));
  $reference = htmlentities(htmlspecialchars(strip_tags($_POST['reference'])));
  $description = htmlentities(htmlspecialchars(strip_tags($_POST['description'])));
  $username = htmlentities(htmlspecialchars(strip_tags($_POST['username'])));
  $status = htmlentities(htmlspecialchars(strip_tags($_POST['status'])));

  $create = crud::insert("credentials");
  $create = crud::insertdata([
    "fullname" => $fullname,
    "email" => $email,
    "phone" => $phone,
    "password" => $password,
    "website" => $website,
    "reference" => $reference,
    "description" => $description,
    "username" => $username,
    "status" => $status,
    "created_at" => date("Y/m/d h:i:s A"),
    "updated_at" => date("Y/m/d h:i:s A")
  ]);
  $create = crud::execute();
  
  if ($create) {
    utility::reload(1000);
    message::success("1 row created successfully");
  }
}
