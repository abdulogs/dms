<?php
require_once "../../classes/crud.php";

if (!isset($_POST) and $_SERVER['REQUEST_METHOD'] == !"POST") {
  echo '<tr colspan="10"><td>Something went wrong</td></tr>';
} else {

  $limit = (isset($_POST["limit"])) ? $_POST["limit"] : 5;
  $page = (isset($_POST["page"])) ? $_POST["page"] : 1;

  /*** Fetching all data ***/
  $credentials = crud::select();
  $credentials = crud::columns(["id", "fullname", "email", "phone","website","reference","description","password"]);
  $credentials = crud::columnsmore(["status","username","created_at","updated_at"]);
  $credentials = crud::table("credentials");

  /*** Search all data ***/
  if (!empty($_POST["search"]) || $_POST["search"] == " ") {
    $credentials =  crud::search([
      "id" => $_POST["search"],
      "first_name" => $_POST["search"],
      "last_name" => $_POST["search"],
      "email" => $_POST["search"],
    ]);
  }

  /*** sort all data ***/
  if (!isset($_POST["sort"]) || $_POST["sort"] == "recent") {
   
  } else {
    $credentials = crud::order("id", "ASC");
  }

  $credentials = ($limit == "all") ?: crud::paging($page, $limit);
  $credentials = crud::execute();
  $credentials = crud::fetch("all");
 
  if ($credentials) {
    foreach ($credentials as $credential) { ?>
      <tr>
        <td class="align-middle px-3" data-label="Id">
          <?php echo $credential["id"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Fullname">
          <?php echo ucFirst($credential["fullname"]); ?>
        </td>
        <td class="align-middle text-break" data-label="Email">
          <?php echo ucFirst($credential["email"]); ?>
        </td>
        <td class="align-middle text-break" data-label="Username">
          <?php echo ucFirst($credential["username"]); ?>
        </td>
        <td class="align-middle text-break" data-label="Phone">
          <?php echo $credential["phone"]; ?>
        </td>
        <td class="align-middle text-break" data-label="password">
          <?php echo $credential["password"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Website">
          <a href="<?php echo $credential["website"]; ?>" class="text-primary"><?php echo $credential["website"]; ?></a>
        </td>
        <td class="align-middle text-break" data-label="Description">
          <?php echo $credential["description"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Reference">
          <?php echo $credential["reference"]; ?>
        </td>
     
        <td class="align-middle text-break" data-label="Status">
          <?php echo ($credential["status"] == 0) ? "<span class='badge badge-danger'>Inactive</span>" : "<span class='badge badge-success'>Active</span>" ;?>
        </td>
        <td class="align-middle text-break" data-label="Created at">
          <?php echo date('F d, Y H:i:s A', strtotime($credential["created_at"])); ?>
        </td>
        <td class="align-middle text-break" data-label="Updated at">
          <?php echo date('F d, Y H:i:s A', strtotime($credential["updated_at"])); ?>
        </td>
        <td class="align-middle px-3" scope="row" data-label="Controls">
          <a class="updateBtn fa fa-pencil mr-1 font-16 text-success" data-id="<?php echo $credential["id"]; ?>" href="javascript:void(0)" title="View"></a>
          <a class="deleteBtn fa fa-trash mr-1 font-16 text-danger" data-id="<?php echo $credential["id"]; ?>" href="javascript:void(0)" title="Delete"></a>
        </td>
      </tr>

    <?php } ?>
    <tr id="loader"></tr>

    <?php if ($limit == "all") : ?>
    <?php else : ?>
      <tr id="pagination" class="bg-light">
        <td colspan="13" class="text-center">
          <?php $attr = (isset($_POST["sort"]) || isset($_POST["limit"]) || isset($_POST["search"])) ? "loadFiltered" : "loadmore"; ?>
          <button type="button" class="btn btn-sm btn-light border" id="<?php echo $attr; ?>" data-paging="<?php echo $page + 1; ?>">
            Load More
          </button>
        </td>
      </tr>
    <?php endif; ?>

  <?php } else { ?>
    <tr class="bg-light">
      <td colspan="13" class="text-center">
        <button type="button" class="btn btn-sm btn-outline-dark" disabled>No Results</button>
      </td>
    </tr>
<?php }
} ?>