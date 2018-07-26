function guardarCarpeta(){
  $(document).on("click", "#btGuardar", function(){
  var annio = $("#annioCarpeta").val();
  var mes = $("#mesCarpeta").val();

  var resultValidation = validarFormularioCarpeta(annio, mes);
  if(!resultValidation){
    return;
  }

  var idCongregacion = $("#idCongregacion").val();
  var inicioMes = 0;
  /*var inicioMes = $("#inicioMes").val();
  if(inicioMes == ""){
    displayMessage("Alerta!", "El campo Fondos inicio de mes, es obligatorio");
    return false;
  }*/
  var url_base = $("#url_base").val();
  $.post(url_base+"calculos/guardarCarpeta",{idCongregacion: idCongregacion, annio: annio, mes: mes, inicioMes: inicioMes, _token: $("#_token").val()},function( data ) {
      var result = JSON.parse(data);

      if(result.STATUS){
        alertify.alert("Exíto", result.messagge, function(){
          $("#annioCarpeta").val("");
          $("#mesCarpeta").val(0);
          $("#inicioMes").val("");
          $("#inicioMes").attr("readonly", true);
          $("#inicioMes").attr("disabled", true);

          $("#side-menu").html(result.menu);
          $('#side-menu').metisMenu();
          $("#AgregarCarpeta").modal("hide");
        });
      }else{
          displayMessage("Error!", result.messagge);
      }
    });//post

})
}//guardarCarpeta

function validarFormularioCarpeta(annio, mes){
  if(annio == ""){
    displayMessage("Alerta!", "El campo año es Obligatorio");
    return false;
  }
  if(mes == ""){
    displayMessage("Alerta!", "El campo mes es Obligatorio");
    return false;
  }
  if(annio.length < 4 || parseInt(annio) <= 2009){
    displayMessage("Alerta!", "Asegúrese de ingresar un año valido. ejemplo: 2017. Recuerde que solamente se admiten años mayores al 2009");
    return false;
  }
  if(parseInt(mes) < 1 || parseInt(mes) > 12){
    displayMessage("Alerta!", "Por favor seleccione un mes de la lista");
    return false;
  }

  return true;
}

function displayMessage(titulo, mensaje){
   alertify.alert(titulo, mensaje);
}
function calcularFondosInicioMes(){
  $(document).on("click", "#calculoFondosInicioMes", function(){
    var annio = $("#annioCarpeta").val();
    var mes = $("#mesCarpeta").val();

    var resultValidation = validarFormularioCarpeta(annio, mes);
    if(!resultValidation){
      return;
    }

    var idCongregacion = $("#idCongregacion").val();
    var url_base = $("#url_base").val();
    $.post(url_base+"carpeta/calcularInicioMes",{annio: annio, mes: mes, _token: $("#_token").val()},function( data ) {
        var result = JSON.parse(data);

        if(result.balance != false){
          $("#inicioMes").val(result.balance);
          $("#inicioMes").attr("readonly", true);
          $("#inicioMes").attr("disabled", true);
        }else{
            $("#notificationCalculo").show();
            $("#inicioMes").attr("readonly", false);
            $("#inicioMes").attr("disabled", false);
        }
      });//post

  })
}
function eliminarCarpeta(){
  $(document).on("click", ".btnEliminarCarpeta", function(){
    var url_base = $("#url_base").val();
    var id = $(this).data("id");
    alertify.confirm('Realmente Desea Eliminar Esta Carpeta', function(result){
      if(result){
        $.post(url_base+"delCarpeta",{id: id, _token: $("#_token").val()},function( data ) {
            var result = JSON.parse(data);
            if(result.STATUS){
              alertify.alert("Exíto", result.MENSAJE, function(){
                window.location.href = result.URL;
              });
            }else{
              displayMessage("Error!", result.MENSAJE);
            }
          });//post
        }
       }
      )
  })
}
function eliminarRecibos(){
    $(document).on("click", ".deleteRecibo", function(){
      var id = $(this).data("identificacion");

      alertify.confirm('Realmente Desea Eliminar El Recibo',
      function(){
        var url_base = $("#url_base").val();
        $.post(url_base+"Recibo/delRecibo",{idRecibo: id, _token: $("#_token").val()},function( data ) {
            var result = JSON.parse(data);
            if(result.STATUS){
              alertify.alert("Exíto", "El recibo fue eliminado satisfactoriamente", function(){
                cambiarValoresHtml(result);
              });
            }else{
                displayMessage("Error!", "No fue posible eliminar el recibo");
            }
          });//post

       }
      ,function(){
        return true;
      })
    })
}

function controlCambioTipoRecibo(){
  $(document).on("change", "#tipoRecibo", function(){
    if($(this).val() == "2"){
      $("#container_descripcionRecibo").show("slow");
      $("#descripcionRecibo").attr("placeholder", "Escriba la descripción del Gasto");
    }else if($(this).val() == "5"){
      $("#container_descripcionRecibo").show("slow");
      $("#descripcionRecibo").attr("placeholder", "Escriba el nombre del banco donde consigno");
    }else{
      $("#container_descripcionRecibo").hide("slow");
    }

  })
}
function guardarRecibo(){
  $(document).on("click", "#btGuardarRecibo", function(){
    var fecha = $("#fechaRecibo").val();
    var tipo = $("#tipoRecibo").val();
    var valor = $("#valorRecibo").val();
    var descripcion = "";

    if(fecha == ""){
      displayMessage("Error!", "Seleccione una fecha");
      return;
    }
    if(parseInt(tipo) < 1 || parseInt(tipo) > 6){
      displayMessage("Error!", "El tipo de recibo es incorrecto");
      return;
    }
    if(valor == ""){
      displayMessage("Error!", "Ingrese un valor");
      return;
    }
    if( (tipo == "2" || tipo == "5")){
      descripcion = $("#descripcionRecibo").val();
      if(descripcion == ""){
        displayMessage("Error!", "La descripcion es obligatoria");
        return;
      }
    }

    var idCarpeta = $("#idCarpeta").val();
    var url_base = $("#url_base").val();
    $.post(url_base+"Recibo/addRecibo",{idCarpeta: idCarpeta, fecha: fecha, tipo: tipo, valor: valor, descripcion: descripcion, _token: $("#_token").val()},function( data ) {
        var result = JSON.parse(data);
        if(result.STATUS){
          alertify.alert("Exíto", "El recibo fue creado satisfactoriamente", function(){
            cambiarValoresHtml(result);
            $("#AgregarRecibo").modal("hide");
            $("#fechaRecibo").val("");
            $("#tipoRecibo").val(1);
            $("#valorRecibo").val("");
            $("#descripcionRecibo").val("");
            $("#container_descripcionRecibo").hide();
          });
        }else{
            displayMessage("Error!", "No fue posible crear el recibo");
        }
      });//post

  })
}
function cambiarValoresHtml(result){
  $("#tblRecibosBody").html(result.html.html);
  $("#value_totalObraMundial").html(result.html.totalObraMundial);
  $("#value_totalGastos").html(result.html.totalGastos);
  $("#value_totalEntradaCongregacion").html(result.html.totalEntradaCongregacion);
  $("#value_totalConsignacion").html(result.html.totalConsignacion);
  $("#value_balance").html(result.html.balance);
}
function colorTable(){
  $(document).on("click", ".colorTable", function(){
    var option = $(this).data("option");
    if(option == "EC"){
      if($(".tipoRecibo6").hasClass("info")){
        $(".tipoRecibo6").removeClass("info");
      }else{
        $(".tipoRecibo6").addClass("info");
      }
    }else if(option == "TG"){
      if($(".tipoRecibo2").hasClass("danger")){
        $(".tipoRecibo2").removeClass("danger");
      }else{
        $(".tipoRecibo2").addClass("danger");
      }

      if($(".tipoRecibo4").hasClass("danger")){
        $(".tipoRecibo4").removeClass("danger");
      }else{
        $(".tipoRecibo4").addClass("danger");
      }
    }else if(option == "OM"){
      if($(".tipoRecibo1").hasClass("success")){
        $(".tipoRecibo1").removeClass("success");
      }else{
        $(".tipoRecibo1").addClass("success");
      }
    }else if(option == "CO"){
      if($(".tipoRecibo5").hasClass("purple")){
        $(".tipoRecibo5").removeClass("purple");
      }else{
        $(".tipoRecibo5").addClass("purple");
      }
    }
  })
}
function crearUsuario(){
  $(document).on("submit", "#formularioUsuario", function(){
    var password = $("#contrasenna").val();
    var password_clon = $("#contrasenna_clon").val();
    if(password != password_clon){
      $("#error-pass").show("slow");
      return false;
    }

    var nombre = $("#nombreUsuario").val();
    var email = $("#email").val();
    var url_base = $("#url_base").val();

    $.post(url_base+"usuario/add",{_token: $("#_token").val(), nombre: nombre, email: email, password: password},function( data ) {
        var result = JSON.parse(data);
        if(result.STATUS){
          alertify.alert("Exíto", "El Usuario fue creado satisfactoriamente", function(){
            $("#bodyTablaUsers").html(result.htmlTabla);
            $("#nombreUsuario").val("");
            $("#email").val("");
            $("#url_base").val("");
            $("#contrasenna").val("");
            $("#contrasenna_clon").val("");
            $("#error-pass").hide();

            $("#ModalUsuarios").modal("hide");
            //location.reload();
          });
        }else{
          displayMessage("Error!", "Ocurrio un problema al intentar crear el usuario, refreque e intente de nuevo");
        }
        })
    return false;
  })
}
function dspModalUpdateUser(){
  $(document).on("click", ".editUser", function(){
    var infoUser = $(this).data("infouser");
    $("#ModalUpdateUsuarios #nombreUsuario").val(infoUser.name);
    $("#ModalUpdateUsuarios #email").val(infoUser.email);
    $("#ModalUpdateUsuarios .updateUsuario").data("id", infoUser.id);
    $("#ModalUpdateUsuarios").modal("show");
  })
}
function dspModalPermisos(){
  $(document).on("click", ".permisosUser", function(){
    var infoUser = $(this).data("infouser");
    $("#ModalPermisosUsuario #nombreUsuario").html(infoUser.name);
    $("#ModalPermisosUsuario #infoUsuario").val(JSON.stringify(infoUser));

    $(".container-check").find("input").attr("checked", false);
    $(".container-check").removeClass("selected");

    //se cambia el icono
    if($(".container-check span.fa").hasClass("fa-check-square-o")){
        $(".container-check span.fa").removeClass("fa-check-square-o");
        $(".container-check span.fa").addClass("fa-circle-o");
    }

    if(infoUser.config != "" && infoUser.config != null){
      var permisos = JSON.parse(infoUser.config);
      if(permisos.permisosCuentas == "soloLectura"){
        //se coloca el estilo seleccionado
        $(".soloLectura").addClass("selected");
        //se cambia el icono
        if($(".soloLectura span.fa").hasClass("fa-circle-o")){
          $(".soloLectura span.fa").removeClass("fa-circle-o");
          $(".soloLectura span.fa").addClass("fa-check-square-o");
        }
        //Se selecciona el input
        $(".soloLectura input").attr("checked", true);
      }else if(permisos.permisosCuentas == "controlTotal"){
        //se coloca el estilo seleccionado
        $(".controlTotal").addClass("selected");
        //se cambia el icono
        if($(".controlTotal span.fa").hasClass("fa-circle-o")){
          $(".controlTotal span.fa").removeClass("fa-circle-o");
          $(".controlTotal span.fa").addClass("fa-check-square-o");
        }
        //Se selecciona el input
        $(".controlTotal input").attr("checked", true);
      }
    }
    /*$("#ModalPermisosUsuario #email").val(infoUser.email);
    $("#ModalPermisosUsuario .updateUsuario").data("id", infoUser.id);*/
    $("#ModalPermisosUsuario").modal("show");
  })
}
function viewCheck(){
  $(document).on("click", ".container-check", function(){
    $(".container-check").removeClass("selected");
    $(".container-check").find(".fa").removeClass("fa-check-square-o");
    $(".container-check").find(".fa").addClass("fa-circle-o");
    $(".container-check").find("input").attr("checked", false);

    $(this).addClass("selected");
    $(this).find(".fa").removeClass("fa-circle-o");
    $(this).find(".fa").addClass("fa-check-square-o");
    $(this).find("input").attr("checked", true);
  })
}
function sendFormularioGuardar(){
  $(document).on("click", "#ModalPermisosUsuario #btnGuardar", function(){
    var permisoCuentas = $("input[name=perfilCuentas]:checked").val();
    if(permisoCuentas == "" || permisoCuentas == undefined){
      displayMessage("Error!", "Por favor seleccione una de las opciones");return;
    }

    var infoUser = $("#ModalPermisosUsuario #infoUsuario").val();
    var url_base = $("#url_base").val();
    $.post(url_base+"usuario/permisos",{_token: $("#_token").val(), permisoSel: permisoCuentas, infoUser: infoUser},function( data ) {
        var result = JSON.parse(data);
        if(result.STATUS){
          alertify.alert("Exíto", result.MENSAJE, function(){
            var infoUserObject = JSON.parse(infoUser);
            infoUserObject.config = "{\"permisosCuentas\":\""+permisoCuentas+"\"}";
            $("#iconPermiso"+infoUserObject.id).data("infouser", infoUserObject);
            $("#ModalPermisosUsuario").modal("hide");
          });
        }else{
          displayMessage("Error!", result.MENSAJE);
        }

        })

  })
}
function dspContainerPassword(){
  $(document).on("click", ".dspContainerPassword", function(){
    $("#ModalUpdateUsuarios .containerPassword").slideToggle();
  })
}
function sendFormularioUpdateUser(){
  $(document).on("click", ".updateUsuario", function(){
    var id = $(this).data("id");
    var nombre = $("#ModalUpdateUsuarios #nombreUsuario").val();
    var email = $("#ModalUpdateUsuarios #email").val();

    if($("#ModalUpdateUsuarios .containerPassword").is(":visible")){
      var password = $("#ModalUpdateUsuarios #contrasenna").val();
      var password_clon = $("#ModalUpdateUsuarios #contrasenna_clon").val();
      if(password != password_clon){
        $("#ModalUpdateUsuarios #error-pass").show("slow");
        return false;
      }
    }else{
      var password = false;
      var password_clon = false;
    }
    var url_base = $(this).data("url");

    $.post(url_base+"usuario/upd",{_token: $("#_token").val(), id: id, nombre: nombre, email: email, password: password},function( data ) {
        var result = JSON.parse(data);
        if(result.STATUS){
          alertify.alert("Exíto", "El Usuario fue modificado satisfactoriamente", function(){
            $("#bodyTablaUsers").html(result.htmlTabla);
            $("#ModalUpdateUsuarios #nombreUsuario").val("");
            $("#ModalUpdateUsuarios #email").val("");
            $("#ModalUpdateUsuarios #contrasenna").val("");
            $("#ModalUpdateUsuarios #contrasenna_clon").val("");
            $("#ModalUpdateUsuarios #error-pass").hide();

            $("#ModalUpdateUsuarios").modal("hide");
          });
        }else{
          displayMessage("Error!", "Ocurrio un problema al intentar modificar el usuario, refreque e intente de nuevo");
        }
        })


  })
}
function deleteUser(){
  $(document).on("click", ".deleteUser", function(){

    var yo = $(this);
    var id = $(this).data("id");
    var url_base = $("#url_base").val();

    alertify.confirm('¿Realmente desea eliminar el usuario?', function(){
      $.post(url_base+"usuario/del",{_token: $("#_token").val(), id: id},function( data ) {
        var result = JSON.parse(data);
          if(result.STATUS){
            yo.parent().parent().remove();
        }else{
            displayMessage("Error!", "Ocurrio un problema al intentar eliminar el usuario. Por favor refresque la pagina e intente de nuevo");
        }
      });

    });

  });
}
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
  guardarCarpeta();
  calcularFondosInicioMes();
  eliminarCarpeta();
  eliminarRecibos();
  controlCambioTipoRecibo();
  guardarRecibo();
  colorTable();
  crearUsuario();
  dspContainerPassword();
  sendFormularioUpdateUser();
  dspModalUpdateUser();
  dspModalPermisos();
  viewCheck();
  sendFormularioGuardar();
  deleteUser();
})
