$(document).ready(function() {
    $('#registration').submit(function(event) {
      event.preventDefault(); 
  
      var password = $('#password').val();
      var confirmPassword = $('#conformPassword').val();
      if (password !== confirmPassword) {
        Swal.fire({
          icon: 'error',
          title: 'Password Mismatch',
          text: 'Password and Confirm Password do not match',
          showConfirmButton: false,
          showCancelButton: false,
          timer: 3000
        });
        return;
      }
  
      var formData = new FormData(this);
      console.log(formData);
      $.ajax({
        url: './../function/auth/registartionHandler.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json', 
        success: function(response) {
          console.log(response);
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: response.message,
              showConfirmButton: false,
              showCancelButton: false,
              timer: 3000
            }).then((result) => {
               
                window.location.href = './login.php';
               
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
        error: function() {
          console.error('Form submission failed');
        }
      });
    });
  });
  
  $(document).ready(function() {
    $('#loginForm').submit(function(event) {
      event.preventDefault(); 
      var formData = $(this).serialize();
      $.ajax({
        url: './../function/auth/loginHandler.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
          console.log(response);
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: response.message,
              showConfirmButton: false,
              showCancelButton: false,
              timer: 3000
            }).then((result) => {
              window.location.href = './../index.php';
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
        error: function() {
          console.error('Form submission failed');
        }
      });
    });
  });
  