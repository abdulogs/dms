<?php
require_once "../../classes/crud.php";

if (!isset($_POST) and $_SERVER['REQUEST_METHOD'] == !"POST") {
  echo '<tr colspan="10"><td>Something went wrong</td></tr>';
} else {


  $limit = (isset($_POST["limit"])) ? $_POST["limit"] : 5;
  $page = (isset($_POST["page"])) ? $_POST["page"] : 1;

  /*** Fetching all data ***/
  $topics = crud::select();
  $topics = crud::columns(["t.id", "t.name","t.technology","t.logo","t.status","t.color"]);
  $topics = crud::columnsmore(["u.first_name","u.last_name","t.created_at","t.updated_at"]);
  $topics = crud::table("topics AS t");
  $topics = crud::join(["users AS u" => ["u.id" => "t.user_id"]],"LEFT");

  /*** Search all data ***/
  if (!empty($_POST["search"])) {
    $topics =  crud::search([
      "t.id" => $_POST["search"],
      "t.name" => $_POST["search"],
      "t.technology" => $_POST["search"],
      "u.first_name" => $_POST["search"],
      "u.last_name" => $_POST["search"],
    ]);
  }

  /*** sort all data ***/
  if (!isset($_POST["sort"]) || $_POST["sort"] == "recent") {
    $topics =  crud::order("t.id", "DESC");
  } else {
    $topics = crud::order("t.id", "ASC");
  }

  $topics = ($limit == "all") ?: crud::paging($page, $limit);
  $topics = crud::execute();
  $topics = crud::fetch("all");
  if ($topics) {
    foreach ($topics as $topic) { ?>
      <tr>
        <td class="align-middle px-3" data-label="ID">
          <?php echo $topic["id"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Logo">
        <img src="./uploads/topics/<?php echo $topic["logo"]; ?>" width="40" class="rounded img-thumbnail" alt="">
          
        </td>
        <td class="align-middle text-break" data-label="Technology">
          <?php echo $topic["technology"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Title">
          <?php echo $topic["name"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Title">
          <?php echo $topic["first_name"]." ".$topic["last_name"]; ?>
        </td>
        <td class="align-middle text-break" data-label="Color">
          <?php echo "<span class='badge' style='background-color:".$topic["color"].";'>color</span>"; ?>
        </td>
        <td class="align-middle text-break" data-label="Status">
          <?php echo ($topic["status"] == 0) ? "<span class='badge badge-danger'>Inactive</span>" : "<span class='badge badge-success'>Active</span>" ;?>
        </td>
        <td class="align-middle text-break" data-label="Created at">
          <?php echo date("F d, Y h:i A", strtotime($topic["created_at"])); ?>
        </td>
        <td class="align-middle text-break" data-label="Updated at">
        <?php echo date("F d, Y h:i A", strtotime($topic["updated_at"])); ?>
        </td>
        <td class="align-middle px-3" data-label="Controls">
          <a class="updateBtn fa fa-pencil mr-1 font-16 text-success" data-id="<?php echo $topic["id"]; ?>" href="javascript:void(0)" title="Update"></a>
          <a class="deleteBtn fa fa-trash mr-1 font-16 text-danger"  data-id="<?php echo $topic["id"]; ?>" href="javascript:void(0)" title="Delete"></a>
          <a class="fa fa-eye mr-1 font-16 text-info"  href="topic.php?id=<?php echo $topic["id"]; ?>"  title="View"></a>
        </td>
      </tr>
    <?php } ?>

    <tr id="loader"></tr>

    <?php if ($limit == "all") : ?>
    <?php else : ?>
      <tr id="pagination" class="bg-light">
        <td colspan="10" class="text-center">
          <?php $attr = (isset($_POST["sort"]) || isset($_POST["limit"]) || isset($_POST["search"])) ? "loadFiltered" : "loadmore"; ?>
          <button type="button" class="btn btn-sm btn-light border" id="<?php echo $attr; ?>" data-paging="<?php echo $page + 1; ?>">
            Load More
          </button>
        </td>
      </tr>
    <?php endif; ?>

  <?php } else { ?>
    <tr class="bg-light">
      <td colspan="10" class="text-center">
        <button type="button" class="btn btn-sm btn-outline-dark" disabled>No Results</button>
      </td>
    </tr>
<?php }
} ?>