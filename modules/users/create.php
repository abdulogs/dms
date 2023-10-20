<?php
require_once "../../classes/utilities.php";
require_once "../../classes/messages.php";
require_once "../../classes/crud.php";

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  $fname = htmlentities(htmlspecialchars(strip_tags($_POST['fname'])));
  $lname = htmlentities(htmlspecialchars(strip_tags($_POST['lname'])));
  $email = htmlentities(htmlspecialchars(strip_tags($_POST['email'])));
  $phone = htmlentities(htmlspecialchars(strip_tags($_POST['phone'])));
  $password = htmlentities(htmlspecialchars(strip_tags($_POST['password'])));
  $about = htmlentities(htmlspecialchars(strip_tags($_POST['about'])));
  $address = htmlentities(htmlspecialchars(strip_tags($_POST['address'])));
  $status = htmlentities(htmlspecialchars(strip_tags($_POST['status'])));

 if (crud::check("users", ["id"], ["email" => $email])) {
    message::error("This email address aleady exists");
  } else {
    $user = crud::insert("users");
    $user = crud::insertdata([
      "first_name" => $fname,
      "last_name" => $lname,
      "email" => $email,
      "phone" => $phone,
      "password" => md5($password),
      "about" => $about,
      "address" => $address,
      "status" => $status,
      "created_at" => date("Y/m/d h:i:s A"),
      "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $user = crud::execute();
    
    if ($user) {
      utility::reload(1000);
      message::success("1 row created successfully");
    }
  }
}
