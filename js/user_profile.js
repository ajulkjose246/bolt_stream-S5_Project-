$(document).ready(function(){
    let r_fname,r_lname,r_email,r_uname;
        $("#fname").keyup(function () {
            var f_name = $("#fname").val();
            var c_fname = /^[a-z ]{3,}$/i;
            r_fname=c_fname.test(f_name)
            if (!r_fname) {
                $("#f_error").text("Enter a valid First Name");
            } else {
                $("#f_error").text("");
    
            }
        })
        $("#lname").keyup(function () {
            var l_name = $("#lname").val();
            var c_lname = /^[a-z ]{1,}$/i;
            r_lname=c_lname.test(l_name);
            if (!r_lname) {
                $("#l_error").text("Enter a valid Last Name");
            } else {
                $("#l_error").text("");
    
            }
        })
        $("#email").keyup(function () {
            var email = $("#email").val();
            var c_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            r_email=c_email.test(email);
            if (!r_email) {
                $("#e_error").text("Enter a valid Email Address");
                $('#e_errors').html("");
            } else {
                $("#e_error").text("");
                $.ajax({
                    url: './js/email_ajax.php',
                    type: 'post',
                    data: {
                        email: email
                    },
                    success: function(data) {
                        if (data > 0) {
                            $('#e_errors').html("<i class='bi bi-x-circle-fill'></i>");
                            $(".update_data").prop('disabled', true);
                        } else {
                            $('#e_errors').html("<i class='bi bi-check-circle-fill'></i>");
                            $(".update_data").prop('disabled', false);
                        }
                    }
                });
    
            }
        })
        $("#username").keyup(function () {
            var u_name = $("#username").val();
            var c_name = /^[a-z.@0-9]{5,}$/i;
            r_uname=c_name.test(u_name);
            if (!r_uname) {
                $("#u_error").text("Enter a valid username");
            } else {
                $("#u_error").text("");
                $.ajax({
                    url: './js/username_ajax.php',
                    type: 'post',
                    data: {
                        u_name: u_name
                    },
                    success: function(data) {
                        if (data > 0) {
                            $('#e_errorss').html("<i class='bi bi-x-circle-fill'></i>");
                            $(".update_data").prop('disabled', true);
                        } else {
                            $('#e_errorss').html("<i class='bi bi-check-circle-fill'></i>");
                            $(".update_data").prop('disabled', false);
                        }
                    }
                });
            }
        })
        
    })