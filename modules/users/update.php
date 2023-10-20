<?php
require_once "../../classes/utilities.php";
require_once "../../classes/messages.php";
require_once "../../classes/crud.php";

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  $id = htmlentities(htmlspecialchars(strip_tags($_POST['id'])));
  $fname = htmlentities(htmlspecialchars(strip_tags($_POST['fname'])));
  $lname = htmlentities(htmlspecialchars(strip_tags($_POST['lname'])));
  $email = htmlentities(htmlspecialchars(strip_tags($_POST['email'])));
  $oemail = htmlentities(htmlspecialchars(strip_tags($_POST['oemail'])));
  $password = htmlentities(htmlspecialchars(strip_tags($_POST['password'])));
  $opassword = htmlentities(htmlspecialchars(strip_tags($_POST['opassword'])));
  $status = htmlentities(htmlspecialchars(strip_tags($_POST['status'])));

  if ($email == $oemail) {
    $mail = $oemail;
  } elseif ($email != $oemail) {
    $mail = $email;
  }

  if (!empty($password)) {
    $pass = md5($password);
  } elseif (empty($password) && $password == "") {
    $pass = $opassword;
  }

  $user = crud::update("users");
  $user = crud::updatedata([
    "first_name" => $fname,
    "last_name" => $lname,
    "email" => $mail,
    "password" => $pass,
    "status" => $status,
    "updated_at" => date("Y/m/d h:i:s A")
  ]);
  $user = crud::where(["id" => $id]);
  $user = crud::execute();

  if ($user) {
    message::success("1 row updated successfully");
    utility::reload(1000);
  }
}
