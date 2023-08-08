$(document).ready(() => {
  $.ajax({
    url: "./../../../function/adminFunction/adminFunction.php?action=manuscript",
    method: "GET",
    success: function (response) {
      if (response.success) {
        response = response.data;
        console.log(response)
        for (var i = 0; i < response.length; i++) {
          var element = response[i];
          if ( element.status ) continue ;
          var authors = JSON.parse(element.authors).map((val) => (`${val.name}, <em>${val.email}</em>`)).join("<br/>")

          $("#manuscript-table").append(`
              <tr>
                <td>${element.title}</td>
                <td>${element.abstract}</td>
                <td>${element.keywords}</td>
                <td>${authors}</td>
                <td><a href="${element.filepath}" download><i class="fa fa-download"></i></a></td>
                <td>pending</td>
                <td>
                <i class="fa fa-edit conform-btn" data-id="${element.id}"></i>
                <i class="fa fa-trash delete-btn" data-id="${element.id}"></i>
                <i class="fa fa-comment remark-btn" data-id="${element.id}"></i>
                </td>
              </tr>
            `);
        }

        // Enable modal functionality for the image popup
        $('.remark-btn').on('click', function () {
          var postId = $(this).data('id');
          var userId = $(this).data('userid');
          if (!userId)
            userId = 0;
          var modal = $('#remarkModal');
          modal.find('.modal-body').html(`
            <textarea class="form-control" id="remarkTextArea" rows="4" placeholder="Enter your remarks..."></textarea>
          `);
          modal.find('.modal-footer').html(`
            <button type="button" class="btn btn-primary" id="saveRemarkBtn">Save</button>
            <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
          `);
          $('#remarkModal').modal('show');

          $(".close-modal").click(function () {
            console.log("close modal")
            $("#remarkModal").modal("hide");
          })


          $('#saveRemarkBtn').on('click', function () {
            var remark = $('#remarkTextArea').val();
            $.ajax({
              url: "./../../../function/adminFunction/adminFunction.php?action=saveRemark",
              method: "POST",
              data: { postId: postId, userId: userId, remark: remark },
              success: function (response) {
                if (response.success) {
                  Swal.fire({
                    icon: "success",
                    title: "Remark Saved",
                    text: "The remark has been saved successfully.",
                    showConfirmButton: false,
                    timer: 3000
                  });
                } else {
                  Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to save the remark.",
                    showConfirmButton: false,
                    timer: 3000
                  });
                }
              },
              error: function (error) {
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "An error occurred while saving the remark: " + error,
                  showConfirmButton: false,
                  timer: 3000
                });
              }
            });
            $('#remarkModal').modal('hide');
          });
        });
      }
    }
  });

  $(document).on("click", ".delete-btn", function () {
    var row = $(this).closest("tr");
    var id = $(this).data('id');
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        console.log("i am here");
        $.ajax({
          url: "./../../../function/adminFunction/adminFunction.php?action=deleteManuscript",
          method: "POST",
          data: { id: id },
          success: function (response) {
            if (response.success) {
              Swal.fire({
                icon: "success",
                title: "Deleted!",
                text: "The journal has been deleted.",
                showConfirmButton: false,
                timer: 3000
              });
              row.remove();
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Failed to delete the journal.",
                showConfirmButton: false,
                timer: 3000
              });
            }
          },
          error: function (xhr, status, error) {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "An error occurred while deleting the journal: " + error,
              showConfirmButton: false,
              timer: 3000
            });
          }
        });
      }
    });
  });

  $(document).on("click", ".conform-btn", function () {
    var row = $(this).closest("tr");
    var id = $(this).data('id');
    Swal.fire({
      title: "Are you sure Approve it?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Approve it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "./../../../function/adminFunction/adminFunction.php?action=approveManuscript",
          method: "POST",
          data: { id: id },
          success: function (response) {
            if (response.success) {
              Swal.fire({
                icon: "success",
                title: "Approve!",
                text: "The journal has been Approve.",
                showConfirmButton: false,
                timer: 3000
              });
              row.remove();
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Failed to Approve the journal.",
                showConfirmButton: false,
                timer: 3000
              });
            }
          },
          error: function (xhr, status, error) {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "An error occurred while Approving the journal: " + error,
              showConfirmButton: false,
              timer: 3000
            });
          }
        });
      }
    });
  })

});
