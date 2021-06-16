<?php
/**
 * Created by PhpStorm.
 * User: leonardoavella
 * Date: 12/06/21
 * Time: 6:25 PM
 */
?>

<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <span class="navbar-brand mb-0 h1">Zinobe</span>
    <span class="navbar-brand mb-0 h1">Hola! <?= $_SESSION['user']['first_name']?></span>
    <span class="navbar-brand mb-0 h1"><a href="javascript:sendLogout()">cerrar sesión</a></span>
</nav>

<div class="container">

    <form class="well form-horizontal" action=" " method="post" id="users_form">
        <fieldset>

            <!-- Form Name -->
            <legend>
                <center><h2><b>Usuarios</b></h2></center>
            </legend>
            <br>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label">Busqueda usuario (Nombre o email)</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="search-user" onkeyup="searchUser()"  placeholder="test@example.com"
                               class="form-control" type="text">
                    </div>
                </div>
                <div id="msg-email"></div>
            </div>

            <div id="results"></div>

        </fieldset>
    </form>

</div>





<script>


    function sendLogout(){
        $.ajax({
            data: {'logout': true,  'ajax': true},
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
                    var new_url = url.replace('users', 'login');
                    setTimeout(function(){ location.href = new_url;}, 1500);

                }
            }
        });
    }



    function searchUser(){

        $.ajax({
            data: {'search_user': $("#search-user").val(),  'ajax': true},
            url: window.location.href,
            type: 'post',
            beforeSend: function () {
                $("#results").html('<span class="glyphicon glyphicon-repeat fast-right-spinner"></span>');
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
                    var htmlUsers= "";

                    for(var index in res.data){
                        htmlUsers+="<tr>";
                        if(index==0){
                            for(var attr in res.data[index]){
                                htmlUsers+=`<th>${attr}</th>`;
                            }
                        }
                        htmlUsers+="</tr>";
                        var i = 0;
                        for(var attr in res.data[index]){
                            if(i==0) htmlUsers+="<tr>";
                            htmlUsers+=`<td>${res.data[index][attr]}</td>`;
                            i++;
                        }
                    }
                    $("#results").html(`<table class="table">${htmlUsers}</table>`);
                }
            }
        });

    }



</script>