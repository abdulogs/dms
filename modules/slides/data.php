<?php
require_once "../../classes/crud.php";

if (!isset($_POST) and $_SERVER['REQUEST_METHOD'] == !"POST") {
  echo '<tr colspan="9"><td>Something went wrong</td></tr>';
} else {


  $limit = (isset($_POST["limit"])) ? $_POST["limit"] : 5;
  $page = (isset($_POST["page"])) ? $_POST["page"] : 1;

  $paging = 1;

  /*** Fetching all data ***/
  $slides = crud::select();
  $slides = crud::columns(["s.id", "s.name","s.description","s.status","s.ordering","t.name AS slide"]);
  $slides = crud::columnsmore(["u.first_name","u.last_name","s.created_at","s.updated_at"]);
  $slides = crud::table("slides AS s");
  $slides = crud::join(["users AS u" => ["u.id" => "s.user_id"]],"LEFT");
  $slides = crud::join(["topics AS t" => ["t.id" => "s.topic_id"]],"LEFT");

  /*** Search all data ***/
  if (!empty($_POST["search"])) {
    $slides =  crud::search([
      "t.id" => $_POST["search"],
      "t.name" => $_POST["search"],
      "s.name" => $_POST["search"],
      "t.description" => $_POST["search"],
      "u.first_name" => $_POST["search"],
      "u.last_name" => $_POST["search"],
    ]);
  }

  /*** sort all data ***/
  if (!isset($_POST["sort"]) || $_POST["sort"] == "recent") {
    $slides =  crud::order("t.id", "DESC");
  } else {
    $slides = crud::order("t.id", "ASC");
  }

  $slides = ($limit == "all") ?: crud::paging($page, $limit);
  $slides = crud::execute();
  $slides = crud::fetch("all");
  if ($slides) {
    foreach ($slides as $slide) { ?>
      <tr>
        <td class="align-middle px-3" data-label="ID">
          <?php echo $slide["id"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Title">
          <?php echo $slide["name"]; ?>
        </td>
        <td class="align-middle text-break" data-label="slide">
          <?php echo $slide["slide"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Author">
          <?php echo $slide["first_name"]." ".$slide["last_name"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Ordering">
          <?php echo $slide["ordering"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Status">
          <?php echo ($slide["status"] == 0) ? "<span class='badge badge-danger'>Inactive</span>" : "<span class='badge badge-success'>Active</span>" ;?>
        </td>
        <td class="align-middle text-break" data-label="Created at">
          <?php echo date("F d, Y h:i A", strtotime($slide["created_at"])); ?>
        </td>
        <td class="align-middle text-break" data-label="Updated at">
        <?php echo date("F d, Y h:i A", strtotime($slide["updated_at"])); ?>
        </td>
        <td class="align-middle px-3" data-label="Controls">
          <a class="updateBtn fa fa-pencil mr-1 font-16 text-success" data-id="<?php echo $slide["id"]; ?>" href="javascript:void(0)" title="Update"></a>
          <a class="deleteBtn fa fa-trash mr-1 font-16 text-danger"  data-id="<?php echo $slide["id"]; ?>" href="javascript:void(0)" title="Delete"></a>
          <a class="fa fa-eye mr-1 font-16 text-info"  href="slide.php?id=<?php echo $slide["id"]; ?>&page=<?php echo $paging++; ?>"  title="View"></a>
        </td>
      </tr>
    <?php } ?>

    <tr id="loader"></tr>

    <?php if ($limit == "all") : ?>
    <?php else : ?>
      <tr id="pagination" class="bg-light">
        <td colspan="9" class="text-center">
          <?php $attr = (isset($_POST["sort"]) || isset($_POST["limit"]) || isset($_POST["search"])) ? "loadFiltered" : "loadmore"; ?>
          <button type="button" class="btn btn-sm btn-light border" id="<?php echo $attr; ?>" data-paging="<?php echo $page + 1; ?>">
            Load More
          </button>
        </td>
      </tr>
    <?php endif; ?>

  <?php } else { ?>
    <tr class="bg-light">
      <td colspan="9" class="text-center">
        <button type="button" class="btn btn-sm btn-outline-dark" disabled>No Results</button>
      </td>
    </tr>
<?php }
} ?>