$(document).ready(()=>{
    $.ajax({
        url: './../function/homeFunction/homeFunction.php',
        type: 'GET',
        data: {
            action: 'getCount'
        },
        dataType: 'json',
        success:function(response){
            $('#count').append(`${response[0]}`);
        }
    });

    $.ajax({
        url: './../function/homeFunction/homeFunction.php',
        type: 'GET',
        data: {
          action: 'GetRemarkDetailsForUser'
        },
        dataType: 'json',
        success: function(response) {
          for (var i = 0; i < response.length; i++) {
            let element = response[i];
            let date = new Date(element.date);
            let formattedDate = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            let truncatedMessage = truncateString(element.message, 5);
            let expandIcon = element.message.length > 30 ? '<span style="font-weight:bold;cursor:pointer">read more >><span>' : '';
            $('#report_table').append(`
              <tr>
                <td>${element.RemarkId}</td>
                <td>${element.title}</td>
                <td>${element.topic}</td>
                <td>
                  <span class="message-preview" data-toggle="modal" data-target="#messageModal" data-message="${element.message}">
                    ${truncatedMessage}
                    ${expandIcon}
                  </span>
                </td>
                <td>${formattedDate}</td>
              </tr>
            `);
          }
      
          $('.message-preview').on('click', function() {
            let fullMessage = $(this).data('message');
            $('#messageModal').find('.modal-body').text(fullMessage);
            $('#messageModal').modal('show');
          });
        }
      });
      
      function truncateString(string, numWords) {
        let wordArray = string.split(' ');
        let truncatedArray = wordArray.slice(0, numWords);
        let truncatedString = truncatedArray.join(' ');
        return truncatedString;
      }
      
      
      
})