<?php
require_once "../../../classes/utilities.php";
require_once "../../../classes/messages.php";
require_once "../../../classes/crud.php";

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

  $email = htmlentities(htmlspecialchars(strip_tags($_POST['email'])));
  $password = htmlentities(htmlspecialchars(strip_tags($_POST['password'])));

  /* check user */
  $check = crud::select()::columns(["id"])::table("users");
  $check = crud::where(["email" => $email, "password" => md5($password)])::execute();
  $check = crud::fetch("one");

  if ($check) {
    $_SESSION["id"] = $check["id"];

    utility::redirect("topics.php", 1000);
    message::success("Login successfully");
  } else {
    message::error("Wrong credentials");
  }
}
