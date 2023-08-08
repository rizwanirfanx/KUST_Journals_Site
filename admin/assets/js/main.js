$(document).ready(function() {
    $('#loginForm').submit(function(e) {
      e.preventDefault();
      // var formData = $(this).serialize();
      var formData = {
        username: $("#username").val(),
        password: $("#password").val()
      }
      console.log(formData)
      $.ajax({
        url: './../../../function/adminFunction/adminFunction.php?action=loginHandler',
        type: 'POST',
        data: formData,
        success: function(res) {
          var response = JSON.parse(res);
          console.log(response);
          if (response.status) { 
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: response.message,
              showConfirmButton: false,
              showCancelButton: false,
              timer: 3000
            }).then((result) => {
              window.location.href = './home/home.php';
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.message,
              showConfirmButton: false,
              showCancelButton: false,
              timer: 3000
            });
          }
        },
        error: function(xhr, status, error) {
          Swal.fire({
            icon: 'error',
            title: 'Login Error',
            text: 'An error occurred during login: ' + error
          });
        }
      });
    });


    $('#uploadJournal').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
          url: './../../../function/adminFunction/adminFunction.php?action=uploadJournal',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            Swal.fire({
              icon: 'success',
              title: 'Journal Uploaded',
              text: 'Your journal has been uploaded successfully.',
              showConfirmButton: false,
              timer: 3000
            })
          },
          error: function(error) {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'An error occurred during journal upload: ' + error,
              showConfirmButton: false,
              timer: 3000
            });
          }
        });
      });
      
    
  });
  $(document).ready(()=>{
    $.ajax({
        url: "./../../../function/adminFunction/adminFunction.php?action=fetchJournelRequest",
        method: "GET",
        success: function(response) {
            for (var i = 0; i < response.length; i++) {
                var element = response[i];
                $("#report_table").append(`
                    <tr>
                        <td>${element.userName}</td>
                        <td>${element.userEmail}</td>
                        <td>${element.topic}</td>
                        <td>${element.title}</td>
                        <td>${element.status}</td>
                        <td>
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash"></i>
                        </td>
                    </tr>
                `);
            }
        },
    });
})
  
  
 


  