<?php
require_once "../../classes/utilities.php";
require_once "../../classes/messages.php";
require_once "../../classes/crud.php";
require_once "../../classes/media.php";

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  $id = htmlentities(htmlspecialchars(strip_tags($_POST['id'])));
  $name = htmlspecialchars(strip_tags($_POST['name']));
  $color = htmlspecialchars(strip_tags($_POST['color']));
  $technology = htmlspecialchars(strip_tags($_POST['technology']));
  $logo = htmlspecialchars(strip_tags($_POST['logo']));
  $status = htmlspecialchars(strip_tags($_POST['status']));


  if(empty($_FILES["image"]["name"])){
   $file = $logo; 
  } else{
    media::remove("../../uploads/topics/{$logo}");
    $file = media::file("image")::type(["png","jpg","jpeg"]);
    $file = media::type(["png","jpg","jpeg"]);
    $file = media::size(2097152);
    $file = media::name("topic");
    $file = media::folder("../../uploads/topics");
  }

  $update = crud::update("topics");
  $update = crud::updatedata([
    "name" => $name,
    "technology" => $technology,
    "color" => $color,
    "logo" => $file,
    "status" => $status,
    "updated_at" => date("Y/m/d h:i:s A")
  ]);
  $update = crud::where(["id" => $id]);
  $update = crud::execute();

  if ($update) {
    utility::reload(1000);
    message::success("1 row created successfully");
  }
}
