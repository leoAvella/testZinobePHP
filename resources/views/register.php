<div class="container">

    <form class="well form-horizontal" action=" " method="post" id="contact_form">
        <fieldset>

            <!-- Form Name -->
            <legend>
                <center><h2><b>Registro</b></h2></center>
            </legend>
            <br>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label">Número Documento</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="document" onkeyup="validateDocument()" name="document" placeholder="111-11-1111"
                               class="form-control" type="text">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8">
                    <button type="button" id="search-document" disabled="disabled" class="btn btn-info">
                        <span class="glyphicon glyphicon-search"></span> Search
                    </button>
                </div>
            </div>

            <div id="validation-doc"></div>

        </fieldset>
    </form>





    <form class="well form-horizontal">

        <div id="data-user"></div>

    </form>
</div><!-- /.container -->


<script>
    $(document).ready(function () {
       console.log(window.location.href);
        var url = window.location.href;
        var new_url = url.replace('register', 'login');

        console.log(new_url );

    });


    var dataUser = [];
    var attr = {
        "id": "id",
        "cargo":"job_title",
        "correo":"email",
        "primer_nombre":"first_name",
        "apellido":"last_name",
        "cedula":"document",
        "telefono":"phone_number",
        "pais":"country",
        "departamento":"state",
        "ciudad":"city",
        "fecha_nacimiento":"birth_date"
    };

    function validatePass(){

        var pass1  = $("#pass1").val();
        var pass2  =$("#pass2").val();

        var result = pass1.match(/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,16}$/mg);



        if (result != null) {
            if ( pass1 == pass2 ){
                $("#save-user").prop("disabled", false);
                $("#validation-pass").html("");
                console.dir(dataUser);
            } else{
                $("#save-user").prop("disabled", true);
                $("#validation-pass").html("<p>La contraseña debe coincidir con la confirmación de contraseña </p>");
            }
        } else {
            $("#save-user").prop("disabled", true);
            $("#validation-pass").html("<p>La contraseña debe tener al entre 6 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. </p>");
        }
    }


    function saveUser(){

        dataUser['password'] = $("#pass1").val();

        $.ajax({
            data: {'user': dataUser, 'ajax': true},
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
                        title: "Usuario Guardado",
                        showConfirmButton: false,
                        timer: 1500
                    });

                   var url = window.location.href;
                   var new_url = url.replace('register', 'login');
                   setTimeout(function(){ location.href = new_url;}, 2000);

                }
            }
        });

    }


    function validateDocument() {
        var doc = $("#document").val();

        var result = doc.match(/^\d{3}\-\d{2}\-\d{4}$/mg);
        if (result != null) {
            $("#search-document").prop("disabled", false);
            $("#validation-doc").html("")
        } else {
            $("#search-document").prop("disabled", true);
            $("#validation-doc").html("<p class='text text-red'>El formato de documento debe ser: 111-11-1111</p>")
        }
    }

    $("#search-document").click(function () {
        $.ajax({
            data: {'documentSearch': $("#document").val(), 'ajax': true},
            url: window.location.href,
            type: 'post',
            beforeSend: function () {
                Swal.fire({
                    icon: 'question',
                    title: 'Validando Documento',
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
                Swal.close();
                var res = JSON.parse(response);
                console.dir(res);
                if (res.error) {
                    Swal.fire({
                        icon: 'error',
                        text: res.message,
                    });
                    $("#data-user").html("");
                } else {

                    if(res.api == 1)
                        dataUser = {};
                    else
                        dataUser = res.data;

                    console.log("NO hay error");
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    var formUser = `<fieldset>
            <!-- Form Name -->
                        <legend>
                        <center><h2><b>Registro</b></h2></center>
                        </legend>
                        <br>

                        <div class="form-group">
                        <label class="col-md-4 control-label">Contraseña</label>
                        <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="pass1" onkeyup="validatePass()" name="document" placeholder="Contraseña" class="form-control"
                        type="text">
                        </div>
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="col-md-4 control-label">Confirmación Contraseña</label>
                        <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="pass2" onkeyup="validatePass()" name="document" placeholder="Contraseña" class="form-control"
                        type="text">
                        </div>
                        </div>
                        </div>
                        <div id="validation-pass"></div>

                        <div class="form-group">
                        <div class="col-md-8">
                        <button onclick="saveUser()" type="button" id="save-user" disabled="disabled" class="btn btn-info">
                        Guardar
                        </button>
                        </div>
                        </div>
                        </fieldset>`;
                    var html = "";
                    for (var itm in res.data) {
                        if(res.api == 1)
                            dataUser[attr[itm]] = res.data[itm];

                        html += `<tr><th>${itm}</th><td>${res.data[itm]}</td></tr>`;
                    }

                    $("#data-user").html(`<table class="table" > ${html} </table>`+formUser);
                }
            },
        });
    });

</script>