$(document).ready(function () {
    let r_fname, r_lname, r_email, r_pwd, cr_pwd, pwd, cpwd, pswd_suc;
    $("#fname").keyup(function () {
        var f_name = $("#fname").val();
        var c_fname = /^[a-z ]{3,}$/i;
        r_fname = c_fname.test(f_name)
        if (!r_fname) {
            $("#f_error").text("Enter a valid First Name");
        } else {
            $("#f_error").text("");

        }
    })
    $("#lname").keyup(function () {
        var l_name = $("#lname").val();
        var c_lname = /^[a-z ]{1,}$/i;
        r_lname = c_lname.test(l_name);
        if (!r_lname) {
            $("#l_error").text("Enter a valid Last Name");
        } else {
            $("#l_error").text("");

        }
    })
    
    $("#email").keyup(function () {
        var email = $("#email").val();
        var c_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        r_email = c_email.test(email);
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
                success: function (data) {
                    if (data > 0) {
                        $('#e_errors').html("<i class='bi bi-x-circle-fill'></i>");
                        $('#e_errors').css("color", "red");
                        $("#signup").prop('disabled', true);
                        $("#e_error").text("Email already exists");

                    } else {
                        $('#e_errors').html("<i class='bi bi-check-circle-fill'></i>");
                        $('#e_errors').css("color", "green");
                        $("#signup").prop('disabled', false);
                    }
                }
            });

        }
    })
    $("#pwd").keyup(function () {
        pwd = $("#pwd").val();
        var c_pwd = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
        r_pwd = c_pwd.test(pwd);
        if (!r_pwd) {
            $("#p_error").text("Password contain at least (A-Z,a-z,0-9)");
        } else {
            $("#p_error").text("");

        }
    })
    $("#cpwd").keyup(function () {
        cpwd = $("#cpwd").val();
        var c_pwd = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
        cr_pwd = c_pwd.test(cpwd);
        if (!cr_pwd) {
            $("#cp_error").text("Password contain at least (A-Z,a-z,0-9)");
        } else if (pwd != cpwd) {
            $("#cp_error").text("Password and confirm password does not match");
        }
        else {
            $("#cp_error").text("");
            pswd_suc = "true";

        }
    })
    $("#signup").click(function () {
        if (r_fname == true && r_lname == true && r_email == true && pwd == cpwd) {
            $("#signup").prop('disabled', false);
        }
        if (!r_fname) {
            $("#f_error").text("Enter a valid First Name");
            $("#signup").prop('disabled', true);
        }
        if (!r_lname) {
            $("#l_error").text("Enter a valid Last Name");
            $("#signup").prop('disabled', true);
        }
        if (!r_email) {
            $("#e_error").text("Enter a valid Email Address");
            $("#signup").prop('disabled', true);
        }
        if (!r_pwd) {
            $("#p_error").text("Password contain at least (A-Z,a-z,0-9)");
            $("#signup").prop('disabled', true);
        }
        if (!cr_pwd) {
            $("#cp_error").text("Password contain at least (A-Z,a-z,0-9)");
            $("#signup").prop('disabled', true);
        }
    })
})