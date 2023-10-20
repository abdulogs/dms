var loading = `<td><div class="skeleton-loader" style="border-radius:5px;width:100%;height:10px;"></div></td>`;
loading = loading + loading + loading + loading + loading + loading + loading + loading + loading + loading;

$(document).ready(function () {
  function loadData(page) {
    $.ajax({
      url: "modules/topics/data.php",
      method: "POST",
      data: {
        page: page
      },
      cache: false,
      beforeSend: function () {
        $('#loader').html(loading);
      },
      success: function (data) {
        if (data) {
          $('#loader').remove();
          $("#pagination").remove();
          $('#data').append('<tr id="loader"></tr>');
          $('#data').append(data);
        } else {
          $("#loadmore").append("No more results");
          $("#loadmore").prop("disabled", true);
        }
      },
      complete: function () {
        $('#loader').remove()
      },
    });
  }
  loadData();

  function loadFiltered(page) {
    var search = $("#search").val();
    var sort = $("#sort").val();
    var limit = $("#limit").val();
    $.ajax({
      url: "modules/topics/data.php",
      method: "POST",
      data: {
        search: search,
        sort: sort,
        limit: limit,
        page: page
      },
      cache: false,
      beforeSend: function () {
        $('#loader').html(loading);
        $(".filter-btn").attr("disabled", true);
      },
      success: function (data) {
        if (data) {
          var replace = "";
          replace += data;
          $('#loader').remove();
          $("#pagination").remove();
          $('#data').append('<tr id="loader"></tr>');
          $('#data').append(replace);
        } else {
          $("#loadmore").append("No more results");
          $("#loadmore").prop("disabled", true);
        }
      },
      complete: function () {
        $('#loader').remove()
        $(".filter-btn").attr("disabled", false);

      },
    });
  }

  $(document).on("submit", "#filter", function (e) {
    e.preventDefault();
    loadFiltered();
    $("#data").html("");
  });


  $(document).on("click", "#loadFiltered", function () {
    var pageId = $(this).data("paging");
    loadFiltered(pageId);
  });

  $(document).on("click", "#loadmore", function () {
    var pageId = $(this).data("paging");
    loadData(pageId);
  });

  // Create
  $(document).on('click', '.createBtn', function (e) {
    $.ajax({
      url: "modules/topics/form.php",
      type: "POST",
      cache: false,
      beforeSend: function () {
      },
      success: function (data) {
        $("#modalForm").modal("show");
        $("#form").html(data);
      },
      complete: function () {

      },
    });
  });

  $(document).on('submit', '#create', function (e) {
    e.preventDefault();
    var description = $('.ql-editor').html();
    var fd = new FormData(this);
    fd.append('description', description);
    $.ajax({
      url: "modules/topics/create.php",
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      cache: false,
      beforeSend: function () {
        $("#btn-submit").attr("disabled", true);
      },
      success: function (data) {
        $('#response').html(data);
      },
      complete: function () {

        $("#btn-submit").attr("disabled", false);
      },
    });
  });

  // Create

  // Update
  $(document).on('click', '.updateBtn', function (e) {
    var id = $(this).data('id');
    $.ajax({
      url: "modules/topics/form.php",
      type: "POST",
      data: {
        id: id
      },
      cache: false,
      beforeSend: function () {
      },
      success: function (data) {
        $("#modalForm").modal("show");
        $("#form").html(data);
      },
      complete: function () {

      },
    });
  });

  $(document).on("submit", "#update", function (e) {
    e.preventDefault();
    var description = $('.ql-editor').html();
    var fd = new FormData(this);
    fd.append('description', description);
    $.ajax({
      url: "modules/topics/update.php",
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      cache: false,
      beforeSend: function () {
        $("#btn-submit").attr("disabled", true);
      },
      success: function (feedback) {
        $('#response').html(feedback);
      },
      complete: function () {
        $("#btn-submit").attr("disabled", false);
      },
    });
  });
  // Update

  // Delete
  $(document).on('click', '.deleteBtn', function (e) {
    if (confirm("Do you really want to delete this!")) {
      var id = $(this).data('id');
      $.ajax({
        url: "modules/topics/delete.php",
        type: 'post',
        data: {
          id: id
        },
        beforeSend: function () {

        },
        success: function (feedback) {
          $('#response').html(feedback);
        },
        complete: function () {

        }
      });
    }
  });

  $(document).on('click', '.deleteImage', function (e) {
    if (confirm("Do you really want to delete this!")) {
      var id = $(this).data('id');
      $(this).parent().parent().remove();
      $.ajax({
        url: "modules/topics/deleteImage.php",
        type: 'post',
        data: {
          id: id
        },
        beforeSend: function () {
        },
        success: function (feedback) {

          $('#response').html(feedback);

        },
        complete: function () {
        }
      });
    }
  });

  // append

  $(document).on('click', '#appendImg', function (e) {
    $('#images').append(
      `<tr>
  <td>
    <div class="form-group mb-0"><input class="font-12 border p-1 rounded"  name="image[]" type="file" /></div>
  </td>
  <td>
  <div class="form-group mb-0">
    <input class="form-control font-12 border" id="caption" name="caption[]" placeholder="Caption..." type="text" />
  </div>
  </td>
  <td><button class="btn btn-outline-danger fa fa-times removeImg" type="button"></button></td>
</tr>
`);
  });

  $(document).on('click', '.removeImg', function (e) {
    $(this).parent().parent().remove();
  });

});
