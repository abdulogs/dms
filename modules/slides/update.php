<?php
require_once "../../classes/utilities.php";
require_once "../../classes/messages.php";
require_once "../../classes/crud.php";
require_once "../../classes/media.php";

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  $id = htmlentities(htmlspecialchars(strip_tags($_POST['id'])));
  $name = htmlspecialchars(strip_tags($_POST['name']));
  $topic = htmlspecialchars(strip_tags($_POST['topic']));
  $description = $_POST['description'];
  $ordering = htmlspecialchars(strip_tags($_POST['ordering']));
  $status = htmlspecialchars(strip_tags($_POST['status']));

  $update = crud::update("slides");
  $update = crud::updatedata([
    "topic_id" => $topic,
    "name" => $name,
    "description" => $description,
    "ordering" => $ordering,
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
