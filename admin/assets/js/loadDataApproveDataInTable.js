$(document).ready(() => {
    $.ajax({
        url: "./../../../function/adminFunction/adminFunction.php?action=fetchJournelApprove",
        method: "GET",
        success: function(response) {
          for (var i = 0; i < response.length; i++) {
            var element = response[i];
            var fileIcon, downloadLink;
            var url_link = "./../../assets/upload/";
      
            if (element.docName.toLowerCase().endsWith(".pdf")) {
              fileIcon = '<i class="far fa-file-pdf"></i>';
              downloadLink = `<a href="${url_link}${element.docName}" download><i class="fas fa-download"></i></a>`;
            } else if (element.docName.toLowerCase().endsWith(".doc") || element.docName.toLowerCase().endsWith(".docx")) {
              fileIcon = '<i class="far fa-file-word"></i>';
              downloadLink = `<a href="${url_link}${element.docName}" download><i class="fas fa-download"></i></a>`;
            } else {
              fileIcon = '<i class="far fa-file"></i>';
              downloadLink = `<a href="${url_link}${element.docName}" download><i class="fas fa-download"></i></a>`;
            }
      
            $("#report_table").append(`
              <tr>
                <td>${element.userName}</td>
                <td>${element.userEmail}</td>
                <td>${element.topic}</td>
                <td>${element.title}</td>
                <td>${fileIcon} ${element.docName} ${downloadLink}</td>
                <td><a href="#" class="image-popup" data-toggle="modal" data-target="#imageModal" data-src="${url_link}${element.image}"><img class="img-thumbnail" src="${url_link}${element.image}"/></a></td>
                <td>${element.status}</td>
                <td>
                  <i class="fa fa-trash delete-btn" data-id="${element.id}"></i>
                </td>
              </tr>
            `);
          }
      
          // Enable modal functionality for the image popup
          $('.image-popup').on('click', function() {
            var imageSrc = $(this).data('src');
            $('#imageModal').find('.modal-image').attr('src', imageSrc);
            $('#imageModal').modal('show');
          });
        }
      });
      
    $(document).on("click", ".delete-btn", function() {
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
            url: "./../../../function/adminFunction/adminFunction.php?action=deleteJournal",
            method: "POST",
            data: { id: id },
            success: function(response) {
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
            error: function(xhr, status, error) {
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
  