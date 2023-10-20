<?php
require_once "../../classes/utilities.php";
require_once "../../classes/messages.php";
require_once "../../classes/crud.php";
require_once "../../classes/media.php";

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  $name = htmlspecialchars(strip_tags($_POST['name']));
  $color = htmlspecialchars(strip_tags($_POST['color']));
  $technology = htmlspecialchars(strip_tags($_POST['technology']));
  $status = htmlspecialchars(strip_tags($_POST['status']));

  $file = media::file("image")::type(["png","jpg","jpeg"]);
  $file = media::type(["png","jpg","jpeg"]);
  $file = media::size(2097152);
  $file = media::name("topic");
  $file = media::folder("../../uploads/topics");

  $create = crud::insert("topics");
  $create = crud::insertdata([
    "user_id" => $_SESSION["id"],
    "name" => $name,
    "technology" => $technology,
    "color" => $color,
    "logo" => $file,
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
