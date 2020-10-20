$("#btn-rate").on("click", function() {
    var star = $("input:checked").val();
    var id_post = document.URL;
    id_post = parseInt(id_post.substr(31));

    if (star == undefined) {
        alert("оценка не выбрана");
    }

    $.ajax({
        url: '/account/rating',
        type: 'POST',
        cache: false,
        data: {
            'star': star,
            'id_post': id_post,
        },
        dataType: 'html',
        beforeSend: function() {
            $("#btn-rate").prop("disabled", true);
        },
        success: function(data) {
            if (data) {
                $("#errorMess").text(data);
                $(".rating-area").hide();
            }
        }
    });
});