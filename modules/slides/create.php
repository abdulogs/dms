<?php
require_once "../../classes/utilities.php";
require_once "../../classes/messages.php";
require_once "../../classes/crud.php";
require_once "../../classes/media.php";

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  $name = htmlspecialchars(strip_tags($_POST['name']));
  $topic = htmlspecialchars(strip_tags($_POST['topic']));
  $description = $_POST['description'];
  $status = htmlspecialchars(strip_tags($_POST['status']));
  $ordering = htmlspecialchars(strip_tags($_POST['ordering']));

  $create = crud::insert("slides");
  $create = crud::insertdata([
    "user_id" => $_SESSION["id"],
    "topic_id" => $topic,
    "name" => $name,
    "description" => $description,
    "ordering" => $ordering,
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
