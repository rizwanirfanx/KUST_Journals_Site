$(document).ready(function() {
    $('#submitJornel').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: './../function/docFunction/docFunction.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.message,
              showConfirmButton: false,
              timer: 3000 
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.message,
              showConfirmButton: false,
              timer: 3000 
            });
          }
        },
        error: function(xhr, status, error) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: xhr.responseText,
            showConfirmButton: false,
            timer: 3000 
          });
        }
      });
    });
  });
  