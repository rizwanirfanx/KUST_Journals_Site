$.ajax({
    url: './function/homeFunction/homeFunction.php',
    type: 'GET',
    data: {
        action: 'fetchBoxData'
    },
    dataType: 'json',
    success: function(response) {
        let url = "./admin/assets/upload";
        for (var i = 0; i < response.length; i++) {
            let element = response[i];
            let dateObj = new Date(element.date);
            let formattedDate = dateObj.toLocaleDateString('en-US', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });

            $('#showBox').append(`<div class="b-box">
                <div class="b-img">
                    <img src="${url}/${element.image}" alt="">
                </div>
                <div class="b-txt">
                    <h1><a href="#" class="b-title">${element.title}|${element.topic}</a></h1>
                    <span class="b-author">${element.author}</span>
                    <p class="b-detail">${element.description}</p>
                    <div class="b-info">
                        <p>${element.author}</p>
                        <p>${formattedDate}</p>
                    </div>
                </div>
            </div>`);
        }
    },
    error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
    }
});
