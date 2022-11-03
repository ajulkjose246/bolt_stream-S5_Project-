$(document).ready(function () {
    $(".upld_movies").hide();
    $(".disp_mov").hide();
    $(".upld_movies_btn").click(function () {
        $(".home_div").hide();
        $(".upld_movies").show();
    })
    $(".disp_movies_btn").click(function () {
        $(".home_div").hide();
        $(".upld_movies").hide();
        $(".disp_mov").show();

    })
    $("#search_val").keyup(function () {
        var text = $("#search_val").val();
        $.ajax({
            url: './js/display_mov.php',
            type: 'post',
            data: {
                text: text
            },
            success: function(data) {
                var x =data;
                alert(x);
            }
        });
    })
})