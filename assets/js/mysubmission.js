$(document).ready(() => {
    $.ajax({
        url: "function/adminFunction/adminFunction.php?action=manuscript",
        method: "GET",
        success: function (response) {
            if (response.success) {
                response = response.data;
                console.log(response)
                for (var i = 0; i < response.length; i++) {
                    var element = response[i];
                    var authors = JSON.parse(element.authors).map((val) => (`${val.name}, <em>${val.email}</em>`)).join("<br/>")
                    var status = element.status? "Approved": "Pending";
                    $("#manuscript-table").append(`
                        <tr>
                        <td>${element.title}</td>
                        <td>${element.abstract}</td>
                        <td>${element.keywords}</td>
                        <td>${authors}</td>
                        <td><a href="${element.filepath}" download><i class="fa fa-download"></i></a></td>
                        <td>${status}</td>
                        </tr>
                    `);
                }
            }
        }
    });
});
