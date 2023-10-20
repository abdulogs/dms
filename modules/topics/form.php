<?php
require_once "../../classes/crud.php";

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){

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
        <label class="font-weight-bolder mb-0" for="color">Color</label>
        <input class="form-control font-12" id="color" name="color" type="text" required />
      </div>
 
      <div class="form-group col-sm-12 mb-2">
        <label class="font-weight-bolder mb-0" for="Image">Image</label>
        <input class="font-12 border p-1 rounded w-100 d-block" name="image" id="image" type="file" />
      </div>
      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="technology">Technology</label>
        <input class="form-control font-12" id="technology" name="technology" type="text" required />
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
  $topic = crud::select()::columns(["id","name","logo","technology","status"]);
  $topic = crud::table("topics")::where(["id" => $id])::execute();
  $topic = crud::fetch("one");
  if ($topic) { ?>
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
        <input class="form-control font-12" id="name" name="name" type="text" value="<?php echo $topic['name']; ?>" required />
        <input type="hidden" value="<?php echo $topic['id']; ?>" name="id" required />
        <input type="hidden" value="<?php echo $topic['logo']; ?>" name="logo" required />
      </div>
      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="color">Color</label>
        <input class="form-control font-12" id="color" name="color" type="text" value="<?php echo $topic['color']; ?>" required />
      </div>
 
      <div class="form-group col-sm-12 mb-2">
        <label class="font-weight-bolder mb-0" for="Image">Image</label>
        <input class="font-12 border p-1 rounded w-100 d-block" name="image" id="image" type="file" />
      </div>
      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="technology">Technology</label>
        <input class="form-control font-12" id="technology" name="technology" value="<?php echo $topic['technology']; ?>" type="text" required />
      </div>
  
      <div class="form-group col-sm-6 mb-2">
        <label class="font-weight-bolder mb-0" for="status">Status</label>
        <select name="status" id="status" class="custom-select  font-12">
          <optgroup label="Select">
            <option value="<?php echo $topic["status"];?>">
              <?php echo ($topic["status"] == 0) ? "Inactive" : "Active" ;?>
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