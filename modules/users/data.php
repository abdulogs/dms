<?php
require_once "../../classes/crud.php";

if (!isset($_POST) and $_SERVER['REQUEST_METHOD'] == !"POST") {
  echo '<tr colspan="10"><td>Something went wrong</td></tr>';
} else {

  $limit = (isset($_POST["limit"])) ? $_POST["limit"] : 5;
  $page = (isset($_POST["page"])) ? $_POST["page"] : 1;

  /*** Fetching all data ***/
  $users = crud::select();
  $users = crud::columns(["id", "first_name", "last_name", "email","status"]);
  $users = crud::columnsmore(["created_at","updated_at"]);
  $users = crud::table("users");

  /*** Search all data ***/
  if (!empty($_POST["search"]) || $_POST["search"] == " ") {
    $users =  crud::search([
      "id" => $_POST["search"],
      "first_name" => $_POST["search"],
      "last_name" => $_POST["search"],
      "email" => $_POST["search"],
    ]);
  }

  /*** sort all data ***/
  if (!isset($_POST["sort"]) || $_POST["sort"] == "recent") {
   
  } else {
    $users = crud::order("id", "ASC");
  }

  $users = ($limit == "all") ?: crud::paging($page, $limit);
  $users = crud::execute();
  $users = crud::fetch("all");
 
  if ($users) {
    foreach ($users as $user) { ?>
      <tr>
        <td class="align-middle px-3" data-label="Id">
          <?php echo $user["id"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Firstname">
          <?php echo ucFirst($user["first_name"]); ?>
        </td>
        <td class="align-middle text-break" data-label="Lastname">
          <?php echo ucFirst($user["last_name"]); ?>
        </td>
        <td class="align-middle text-break" data-label="Email">
          <?php echo $user["email"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Status">
          <?php echo ($user["status"] == 0) ? "<span class='badge badge-danger'>Inactive</span>" : "<span class='badge badge-success'>Active</span>" ;?>
        </td>
        <td class="align-middle text-break" data-label="Created at">
          <?php echo date('F d, Y H:i:s A', strtotime($user["created_at"])); ?>
        </td>
        <td class="align-middle text-break" data-label="Updated at">
          <?php echo date('F d, Y H:i:s A', strtotime($user["updated_at"])); ?>
        </td>
        <td class="align-middle px-3" scope="row" data-label="Controls">
          <a class="updateBtn fa fa-pencil mr-1 font-16 text-success" data-id="<?php echo $user["id"]; ?>" href="javascript:void(0)" title="View"></a>
          <a class="deleteBtn fa fa-trash mr-1 font-16 text-danger" data-id="<?php echo $user["id"]; ?>" href="javascript:void(0)" title="Delete"></a>
        </td>
      </tr>

    <?php } ?>
    <tr id="loader"></tr>

    <?php if ($limit == "all") : ?>
    <?php else : ?>
      <tr id="pagination" class="bg-light">
        <td colspan="8" class="text-center">
          <?php $attr = (isset($_POST["sort"]) || isset($_POST["limit"]) || isset($_POST["search"])) ? "loadFiltered" : "loadmore"; ?>
          <button type="button" class="btn btn-sm btn-light border" id="<?php echo $attr; ?>" data-paging="<?php echo $page + 1; ?>">
            Load More
          </button>
        </td>
      </tr>
    <?php endif; ?>

  <?php } else { ?>
    <tr class="bg-light">
      <td colspan="8" class="text-center">
        <button type="button" class="btn btn-sm btn-outline-dark" disabled>No Results</button>
      </td>
    </tr>
<?php }
} ?>