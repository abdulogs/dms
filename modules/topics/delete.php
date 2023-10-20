<?php
require_once "../../classes/utilities.php";
require_once "../../classes/messages.php";
require_once "../../classes/crud.php";
require_once "../../classes/media.php";

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  
  $id = htmlentities(htmlspecialchars(strip_tags($_POST['id'])));

  $logo = crud::select()::columns(["logo"])::table("topics")::where(["id" => $id])::execute();
  $logo = crud::fetch("one");

if($logo){
  media::remove("../../uploads/topics/{$logo["logo"]}");
  $delete = crud::delete("topics")::where(["id" => $id])::execute();
    
  if ($delete) {
    utility::reload(1000);
    message::success("1 row deleted successfully");
    }
  }
}
