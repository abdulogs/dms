<?php
require_once "../../classes/crud.php";

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){

  $topics = crud::select()::columns(["id","name"])::table("topics")::execute();
  $topics = crud::fetch("all");


  if (empty($_POST['id'])) { ?>

<form class="modal-content border-0 shadow-lg" method="post" id="create" enctype="multipart/form-data">
  <div class="modal-header d-flex align-items-center align-middle p-2">
    <h5 class="modal-title font-20 m-0">
      <b><span class="fa fa-plus-circle mr-2 font-20 text-success"></span>CREATE</b>
    </h5>
    <button class="btn btn-icon waves-effect waves-light text-dark btn-sm" data-dismiss="modal" aria-label="Close">
      <i class="fa fa-close"></i>
    </button>
  </div>
  <div class="modal-body">
    <div class="form-row">
      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="name">Name</label>
        <input class="form-control font-12" id="name" name="name" type="text" required />
      </div>
      <div class="form-group col-sm-6 mb-2">
      <label class="font-weight-bolder mb-0" for="topic">Topic</label>
        <select class="custom-select font-12" id="topic" name="topic" required>
          <option value="">Select</option>
          <?php foreach ($topics as $topic): ?>
            <option value="<?php echo $topic["id"]; ?>"><?php echo $topic["name"]; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col-sm-12 mb-2">
      <label class="font-weight-bolder mb-0" for="description">Description</label>
        <div id="description" style="height:150px;"></div>
      </div>
      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="ordering">Ordering</label>
        <input class="form-control font-12" id="ordering" name="ordering" type="text" required />
      </div>
      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="status">Status</label>
        <select name="status" id="status" class="custom-select  font-12">
          <option value="">Select</option>
          <option value="1" selected>Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer bg-light">
    <button class="btn btn-light border btn-sm" type="button" data-dismiss="modal">Close</button>
    <button class="btn btn-success btn-sm btn-submit" id="btn-submit" type="submit">Proceed</button>
  </div>
</form>
<?php } ?>


<?php
if (!empty($_POST['id'])) {
  $id = htmlentities(htmlspecialchars(strip_tags($_POST['id'])));
  $slide = crud::select()::columns(["id","name","topic_id","description","status","ordering"]);
  $slide = crud::table("slides")::where(["id" => $id])::execute();
  $slide = crud::fetch("one");
  if ($slide) { ?>
<form class="modal-content border-0 shadow-lg" id="update">
  <div class="modal-header d-flex align-items-center align-middle p-2">
    <h5 class="modal-title font-20 m-0">
      <b><span class="fa fa-plus-circle mr-2 font-20 text-success"></span>UPDATE</b>
    </h5>
    <button class="btn btn-icon waves-effect waves-light text-dark btn-sm" data-dismiss="modal" aria-label="Close">
      <i class="fa fa-close"></i>
    </button>
  </div>
  <div class="modal-body">
    <div class="form-row">   
      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="name">Name</label>
        <input class="form-control font-12" id="name" name="name" value="<?php echo $slide['name']; ?>" type="text" required />
        <input type="hidden" value="<?php echo $slide['id']; ?>" name="id" required />
      </div>
      <div class="form-group col-sm-6 mb-2">
      <label class="font-weight-bolder mb-0" for="topic">Topic</label>
        <select class="custom-select font-12" id="topic" name="topic" required>
          <option value="">Select</option>
          <?php foreach ($topics as $topic): ?>
            <option  <?php echo ($topic["id"] == $slide["topic_id"]) ? "selected" : "" ; ?> value="<?php echo $topic["id"]; ?>"><?php echo $topic["name"]; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group col-sm-12 mb-2">
        <label class="font-weight-bolder mb-0" for="description">Description</label>
        <div id="description" style="height: 150px;"><?php echo $slide["description"]; ?></div>
      </div>

      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="ordering">Ordering</label>
        <input class="form-control font-12" id="ordering" name="ordering" value="<?php echo $slide['ordering']; ?>" type="number" required />
      </div>
      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="status">Status</label>
        <select name="status" id="status" class="custom-select  font-12">
          <optgroup label="Select">
            <option value="<?php echo $slide["status"];?>">
              <?php echo ($slide["status"] == 0) ? "Inactive" : "Active" ;?>
            </option>
          </optgroup>
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer bg-light">
    <button class="btn btn-light border btn-sm" type="button" data-dismiss="modal">Close</button>
    <button class="btn btn-success btn-sm btn-submit" id="btn-submit" type="submit">Proceed</button>
  </div>
</form>
<?php }}} ?>



<script>editor("#description");</script>