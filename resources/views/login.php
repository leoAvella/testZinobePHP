<?php
/**
 * Created by PhpStorm.
 * User: leonardoavella
 * Date: 12/06/21
 * Time: 6:25 PM
 */
?>

<div class="container">

    <form class="well form-horizontal"  id="login_form">
        <fieldset>

            <!-- Form Name -->
            <legend>
                <center><h2><b>Login</b></h2></center>
            </legend>
            <br>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label">email</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="email" onkeyup="validateEmail()" name="email" placeholder="test@example.com"
                               class="form-control" type="text">
                    </div>
                </div>
                <div id="msg-email"></div>
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label">contraseña</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="password" onkeyup="validateEmail()" name="password" placeholder="contraseña"
                               class="form-control" type="password">
                    </div>
                </div>
                <div id="msg-password"></div>
            </div>


            <div class="row">
                <div class="form-group">

                    <div class="col-md-4">
                        <a href="index.php?r=register">Registro usuario</a>
                    </div>

                    <div class="col-md-4">
                        <button type="button" onclick="sendLogin()" id="login" disabled="disabled" class="btn btn-info">
                             Login
                        </button>


                    </div>

                </div>

            </div>


        </fieldset>
    </form>

</div>

<script>

    function sendLogin(){
        $.ajax({
            data: {'password': $("#password").val(), 'email': $("#email").val(),  'ajax': true, 'login': true},
            url: window.location.href,
            type: 'post',
            beforeSend: function () {
                Swal.fire({
                    icon: 'question',
                    title: 'Almacenando usuario',
                    allowOutsideClick: false,
                    timerProgressBar: true,
                    showCancelButton: false,
                    showConfirmButton: false,
                    didOpen: function () {
                        Swal.showLoading()
                    }
                })
            },
            success: function (response) {
                var res = JSON.parse(response);
                Swal.close();
                if (res.error) {
                    Swal.fire({
                        icon: 'error',
                        text: res.message,
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    var url = window.location.href;
                    var new_url = url.replace('register', 'login');
                    setTimeout(function(){ location.href = "index.php?r=users";}, 1500);

                }
            }
        });
    }


    function validateEmail() {

        var validEmail = false;
        var validPass = false;

        var email = $("#email").val();
        var password = $("#password").val();
        var result = email.match(/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/mg);

        if (result != null) {
            $("#msg-email").html("");
            validEmail = true;
        } else{
            $("#msg-email").html("No es un formato valido de correo");
            validEmail = false;
        }

        if(password.length==0){
            validPass = false;
            $("#msg-password").html("La contraseña no puede ser nula");
        } else {
            validPass = true;
            $("#msg-password").html("");
        }
        $("#login").prop("disabled", !(validPass && validEmail));
    }




</script>