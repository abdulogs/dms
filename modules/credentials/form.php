<?php
require_once "../../classes/crud.php";

if (!isset($_POST) and $_SERVER['REQUEST_METHOD'] !== "POST") {
  echo "Request failed";
} elseif (empty($_POST['id'])) { ?>

  <form class="modal-content border-0 shadow-lg" method="post" id="create">
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
          <label class="font-weight-bolder mb-0" for="fullname">Fullname</label>
          <input class="form-control font-12" id="fullname" name="fullname" type="text"  />
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="email">Email</label>
          <input class="form-control font-12" id="email" name="email" type="text" />
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="phone">Phone</label>
          <input class="form-control font-12" id="phone" name="phone" type="text" />
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="password">Password</label>
          <input class="form-control font-12" id="password" name="password" type="text" />
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="username">Username</label>
          <input class="form-control font-12" id="username" name="username" type="text" />
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="status">Status</label>
          <select name="status" id="status" class="custom-select  font-12">
            <option value="">Select</option>
            <option value="1" selected>Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
        <div class="form-group col-sm-12 mb-2">
          <label class="font-weight-bolder mb-0" for="website">Website</label>
          <input class="form-control font-12" id="website" name="website"/>
        </div>
        <div class="form-group col-sm-12 mb-2">
          <label class="font-weight-bolder mb-0" for="reference">Reference</label>
          <textarea class="form-control font-12" id="reference" name="reference"></textarea>
        </div>
        <div class="form-group col-sm-12 mb-2">
          <label class="font-weight-bolder mb-0" for="description">Description</label>
          <textarea class="form-control font-12" id="description" name="description"></textarea>
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
  $credential = crud::select();
  $credential = crud::columns(["id", "fullname", "email", "phone","website","reference","description","password"]);
  $credential = crud::columnsmore(["status","username","created_at","updated_at"]);
  $credential = crud::table("credentials")::where(["id" => $id])::execute();
  $credential = crud::fetch("one");

  if ($credential) { ?>
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
          <label class="font-weight-bolder mb-0" for="fullname">Fullname</label>
          <input class="form-control font-12" id="fullname" name="fullname" type="text"  value="<?php echo $credential['fullname']; ?>" />
          <input name="id" type="hidden" value="<?php echo $credential['id']; ?>" />
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="email">Email</label>
          <input class="form-control font-12" id="email" name="email" type="text" value="<?php echo $credential['email']; ?>" />
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="phone">Phone</label>
          <input class="form-control font-12" id="phone" name="phone" type="text" value="<?php echo $credential['phone']; ?>" />
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="password">Password</label>
          <input class="form-control font-12" id="password" name="password" type="text" value="<?php echo $credential['password']; ?>" />
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="status">Status</label>
          <select name="status" id="status" class="custom-select  font-12">
            <optgroup label="Select">
            <option value="<?php echo $credential["status"];?>"> 
             <?php echo ($credential["status"] == 0) ? "Inactive" : "Active" ;?>
            </option>
            </optgroup>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
        <div class="form-group col-sm-6 mb-2">
          <label class="font-weight-bolder mb-0" for="username">Username</label>
          <input class="form-control font-12" id="username" name="username" type="text" value="<?php echo $credential['username']; ?>" />
        </div>
        <div class="form-group col-sm-12 mb-2">
          <label class="font-weight-bolder mb-0" for="website">Website</label>
          <input class="form-control font-12" id="website" name="website" value="<?php echo $credential['website']; ?>">
        </div>
        <div class="form-group col-sm-12 mb-2">
          <label class="font-weight-bolder mb-0" for="reference">Reference</label>
          <textarea class="form-control font-12" id="reference" name="reference"><?php echo $credential['reference']; ?></textarea>
        </div>
        <div class="form-group col-sm-12 mb-2">
          <label class="font-weight-bolder mb-0" for="description">Description</label>
          <textarea class="form-control font-12" id="description" name="description"><?php echo $credential['description'];?></textarea>
        </div>
        </div>
      </div>
      <div class="modal-footer bg-light">
        <button class="btn btn-light border btn-sm" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-success btn-sm btn-submit" id="btn-submit" type="submit">Proceed</button>
      </div>
    </form>
<?php }} ?>