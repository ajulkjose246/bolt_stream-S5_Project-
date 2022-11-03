$(document).ready(function(){
        $("#signin").click(function(){
            var r_email = $("#email").val();
            var r_pwd = $("#pwd").val();
            if(r_email != null && r_pwd != null){
                localStorage.setItem("user_value",1);
                window.location = "index.html";
            }else if(r_email != null){
                $("#p_error").text("Password contain at least (A-Z,a-z,0-9)");
            }else if(r_pwd != null){
                $("#e_error").text("Enter a valid Email Address");
            }else{
                $("#p_error").text("Password contain at least (A-Z,a-z,0-9)");
                $("#e_error").text("Enter a valid Email Address");
            }
        })
    })