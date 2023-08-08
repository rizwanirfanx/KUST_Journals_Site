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
                    if (!element.status) continue;
                    var authors = JSON.parse(element.authors).map((val) => (`${val.name}, <em>${val.email}</em>`)).join("<br/>")

                    $("#manuscript-table").append(`
                <tr>
                  <td>${element.title}</td>
                  <td>${element.abstract}</td>
                  <td>${element.keywords}</td>
                  <td>${authors}</td>
                  <td><a href="${element.filepath}" download><i class="fa fa-download"></i></a></td>
                  <td>Approved</td>
                  <td>
                  <i class="fa fa-trash delete-btn" data-id="${element.id}"></i>
                  </td>
                </tr>
              `);
                }

                // Enable modal functionality for the image popup

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
});
