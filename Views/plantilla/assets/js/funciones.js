

$(document).ready(function() {

/*var map = L.map('map').setView([13.04614026813303, -86.90305150146241], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">FarmApp</a>'
}).addTo(map);

*/

$('#table').DataTable({
    dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true,rowReorder: { 
            selector: 'td:nth-child(2)'
        },
    "language":{
        "sSearch":"Buscar",
        "lengthMenu":"Mostrar _MENU_ registros",
        "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
        "zeroRecords":"No se encuentran resultados",
        "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
        "oPaginate":{
            "sNext":"Siguiente",
            "sPrevious":"Anterior"
        }        
    } 
     
    }); 

    
$("#busquedas").on("keyup",function(){
    var busq=$("#busquedas").val();

    console.log(busq);

    $.ajax({
        url:"mapa/busquedas/",
        type:'POST',
        data:{'busq':busq},
        success:function(resultado){
            console.log("enviado");
            $("#prueba").html(resultado);
            $('#suggestions').fadeIn(1000).html(resultado);
        }  
        });




    });


/* Filtros funciones */

$("#filtros").on("submit",function(e){
   console.log("Aplicamos pinche filtros");
   var buscar=$("#buscar").val();
   var laboratorio=$("#laboratorio").val();
   var estados=$("#estados").val();
   var delive=$("#delive").val();
   console.log(estados);
   console.log(laboratorio);
   console.log(delive);


    e.preventDefault();
    $.ajax({
        url:'buscar/filtro/',
        type:'post',
        data:{'buscar':buscar,'laboratorio':laboratorio,'estados':estados,'delive':delive},
    success:function(respuesta){
        $("#table").DataTable().destroy();
      $("#table tbody").html(respuesta);
      $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true,rowReorder: {
            selector: 'td:nth-child(2)'
        },
        "language":{
            "sSearch":"Buscar",
            "lengthMenu":"Mostrar _MENU_ registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "zeroRecords":"No se encuentran resultados",
            "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
            "oPaginate":{
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
            }        
        }
        
        });  
       


    }
    ,error:function(){
        console.log('Error');
    }



}); 



});




/*Limpiar Filtros */
$("#limpiar").on("click",function(e){
   console.log("Limpiamos toda esta vaina");
   var buscar=$("#buscar").val();

   $("#laboratorio").val(0);
   $("#estados").val("");


   e.preventDefault();
   $.ajax({
       url:'buscar/limpiarfiltro/',
       type:'post',
       data:{'buscar':buscar},
   success:function(respuesta){
       $("#table").DataTable().destroy();
     $("#table tbody").html(respuesta);
     $('#table').DataTable({
       dom: 'Bfrtip',
       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       responsive: true,rowReorder: {
           selector: 'td:nth-child(2)'
       },
       "language":{
           "sSearch":"Buscar",
           "lengthMenu":"Mostrar _MENU_ registros",
           "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
           "zeroRecords":"No se encuentran resultados",
           "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
           "oPaginate":{
               "sNext":"Siguiente",
               "sPrevious":"Anterior"
           }        
       }
       
       });  
      


   }
   ,error:function(){
       console.log('Error');
   }



}); 

});





/* Funcion para mandar datos al controlador para ingresar datos de farmacia a la base de datos, cuando se haga el envio del formulario*/
$("#formagregarfarmacia").on("submit",function(e){
    var duexo=$("#duexo").val();
    var nombre=$("#nombre").val();
    var registro=$("#registro").val();
    var telefono=$("#telefono").val();
    var abierto=$("#abierto").val();
    var cierre=$("#cierre").val();
    var direccion=$("#direccion").val();
    var latitud=$("#latitud").val();
    var longitud=$("#longitud").val();
    var delivery=$("#delivery").val();
    var extension=$("#farm_image").val().split('.').pop().toLowerCase();;
console.log(extension);
if(extension != '')
{
 if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
 {
  alert("Invalid Image File");
  $('#farm_image').val('');
  return false;
 }
} 

    e.preventDefault();
    $.ajax({
        url:'farmacia/insertarfarmacia/',
        type:'post',
        data:new FormData(this),
        contentType:false,
        processData:false,
    success:function(respuesta){
        $('#modalfarm').modal('hide');
        $("#table").DataTable().destroy();
      $("#table tbody").html(respuesta);
      $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true,rowReorder: {
            selector: 'td:nth-child(2)'
        },
        "language":{
            "sSearch":"Buscar",
            "lengthMenu":"Mostrar _MENU_ registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "zeroRecords":"No se encuentran resultados",
            "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
            "oPaginate":{
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
            }        
        }
        
        });  

        $('#formagregarfarmacia')[0].reset();

        Swal.fire(
            'Se registro la farmacia con exito',
            'en el sistema',
            'success'
        )


    }
    ,error:function(){
        console.log('Error');
    }



}); 



});

/* Funciones para cargar informacion en el modal desde Buscar al realizar una busqueda*/
$("#table").on("click",".btverinfobus",function(){
    var datos= JSON.parse($(this).attr('data-verbus'));
    console.log("manda datos");
    $('#buscar').val('');
    $("#farver").val(datos['nombre']);
    $("#nombrecomerver").val(datos['nombre_medico']);
    $("#imgfarmacover").attr("src",'Views/plantilla/assets/img/'+datos['imagen']);
    $("#imgfarmaciaver").attr("src",'Views/plantilla/assets/img/'+datos['imagen_farm']);
    $("#laboratoriover").val(datos['laboratorio']);
    $("#preciover").val(datos['precio']);
    $("#estadover").val(datos['estado']);
    $("#tipover").val(datos['tipo']);
    $("#deliveryver").val(datos['delivery']);
    $("#apliver").val(datos['aplicacion']);
    $("#precaucionesver").val(datos['precauciones']);
    $("#reaccionesver").val(datos['reacciones']);
    $("#interaccionesver").val(datos['interacciones']);
    $("#vencimientover").val(datos['fecha_de_vencimiento']);
    $("#direccionver").val(datos['direccion']);
    $("#abiertover").val(datos['hora_abre']);
    $("#cierrever").val(datos['hora_cierre']);
    $("#numerover").val(datos['telefono']);
    $("#pesover").val(datos['peso']);
    $("#volumenver").val(datos['volumen']);
    $("#idfarmaco").val(datos['id_farmaco']);
    $("#idfarmacia").val(datos['farmacia_id_farmacia']);
   /* $("#divfarmaco").hide();
    $("#divfarmacia").hide();
    $("#enlace").hide();
*/
    

    
    });

    $("#comprabus").on("submit",function(e){
        var idfarmaco=$("#idfarmaco").val();
        var nombrecompra=$("#nombrecompra").val();
        var numerocompra=$("#numerocompra").val();
        var cantidadcompra=$("#cantidadcompra").val();
        var direccioncompra=$("#direccioncompra").val();
        var costo=$("#costo").val();

        
        var extension=$("#receta").val().split('.').pop().toLowerCase();
        console.log(extension);
        if(extension != '')
          {
           if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
           {
            alert("Invalid Image File");
            $('#receta').val('');
            return false;
           }
          } 
        
            e.preventDefault();
            $.ajax({
                url:'buscar/compra/',
                type:'post',
                data:new FormData(this),
                contentType:false,
                processData:false,
            success:function(respuesta){
                $('#modalinfobus').modal('hide');
              
        

                Swal.fire(
                    'Se registro el farmaco con exito',
                    'en el sistema',
                    'success'
                )
        
        
            }
            ,error:function(){
                console.log('Error');
            }
        
        
        
        }); 
        
       
        


      



    });






/* Funciones para cargar informacion en el modal desde mapa al realizar una busqueda*/
$("#suggestions").on("click",".btverinfo",function(){
    var datos= JSON.parse($(this).attr('data-ver'));
    console.log("manda datos");
    $('#busquedas').val('');
    $('#suggestions').hide();
    $("#farver").val(datos['nombre']);
    $("#nombrecomerver").val(datos['nombre_medico']);
    $("#imgfarmacover").attr("src",'Views/plantilla/assets/img/'+datos['imagen']);
    $("#imgfarmaciaver").attr("src",'Views/plantilla/assets/img/'+datos['imagen_farm']);
    $("#laboratoriover").val(datos['laboratorio']);
    $("#preciover").val(datos['precio']);
    $("#estadover").val(datos['estado']);
    $("#tipover").val(datos['tipo']);
    $("#deliveryver").val(datos['delivery']);
    $("#apliver").val(datos['aplicacion']);
    $("#precaucionesver").val(datos['precauciones']);
    $("#reaccionesver").val(datos['reacciones']);
    $("#interaccionesver").val(datos['interacciones']);
    $("#vencimientover").val(datos['fecha_de_vencimiento']);
    $("#direccionver").val(datos['direccion']);
    $("#abiertover").val(datos['hora_abre']);
    $("#cierrever").val(datos['hora_cierre']);
    $("#numerover").val(datos['telefono']);
    $("#pesover").val(datos['peso']);
    $("#volumenver").val(datos['volumen']);
    $("#idfarmaco").val(datos['id_farmaco']);
    $("#idfarmacia").val(datos['farmacia_id_farmacia']);
   /* $("#divfarmaco").hide();
    $("#divfarmacia").hide();
    $("#enlace").hide();
*/
    

    
    });

    $( "#cantidadcompra" ).bind('keyup mouseup', function() {

        var cantidadcompra=$("#cantidadcompra").val();
        var costo=$("#preciover").val();
        var costo_total=costo*cantidadcompra;
        console.log(costo_total);
        $("#costo").val(costo_total);
      } );

      

    $("#compra").on("submit",function(e){
        var idfarmaco=$("#idfarmaco").val();
        var nombrecompra=$("#nombrecompra").val();
        var numerocompra=$("#numerocompra").val();
        var cantidadcompra=$("#cantidadcompra").val();
        var direccioncompra=$("#direccioncompra").val();
        var costo=$("#costo").val();
        var nombrefarmaco=$("#nombrecomerver").val();

        
        var extension=$("#receta").val().split('.').pop().toLowerCase();
        console.log(extension);
        if(extension != '')
          {
           if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
           {
            alert("Invalid Image File");
            $('#receta').val('');
            return false;
           }
          } 
        
            e.preventDefault();
            $.ajax({
                url:'mapa/compra/',
                type:'post',
                data:new FormData(this),
                contentType:false,
                processData:false,
            success:function(respuesta){
                $('#modalinfo').modal('hide');
              
        

                Swal.fire(
                    'Se realizo la solicitud del farmaco con exito',
                    'en el sistema',
                    'success'
                )
        
        
            }
            ,error:function(){
                console.log('Error');
            }
        
        
        
        }); 
        
        var enlace = $("#enlace");
        $("#enlace").attr("href",'https://api.whatsapp.com/send?phone=505'+numerocompra+'&text=Hola%20mi%20nombre%20es%20'+nombrecompra+'%20estaba%20interesado%20en%20el%20farmaco:%20'+nombrefarmaco+'%20me%20gustaria%20solicitar%20el%20envio%20de%20'+cantidadcompra+'%20Unidades%20a%20la%20siguiente%20dirección%20'+direccioncompra+'%20Saludos%20espero%20su%20pronta%20respuesta');
        window.open(enlace.attr("href"), "_blank");
    
        $('#compra')[0].reset();

      



    });





/* Funciones para editar farmacia*/

/*funcion para cargar informacion en el modal para editar farmacia*/
$("#table").on("click",".btEditarfarmacia",function(){
    var datos= JSON.parse($(this).attr('data-farmacia'));
    $("#idfarm").val(datos['id_farmacia']);
    $("#duexoup").val(datos['regente_id_regente']);
    $("#nombreup").val(datos['nombre']);
    $("#registroup").val(datos['registro']);
    $("#telefonoup").val(datos['telefono']);
    $("#abiertoup").val(datos['hora_abre']);
    $("#cierreup").val(datos['hora_cierre']);
    $("#direccionup").val(datos['direccion']);
    $("#latitudup").val(datos['latitud']);
    $("#longitudup").val(datos['longitud']);
    $("#deliveryu").val(datos['delivery']);
    $("#abiertoup").val(datos['hora_abre']);
    $("#farm_uploaded_image").html(datos['imagen_farm']);
    $("#probando").attr("src",'Views/plantilla/assets/img/'+datos['imagen_farm']);
    
    });

    
    /*fucnion para realizar actualizacion con el modal actu usuario*/
    
    $("#formeditarfarmacia").submit(function(e){
        var idfarm=$("#idfarm").val();
        var duexoup=$("#duexoup").val();
        var nombreup=$("#nombreup").val();
        var registroup=$("#registroup").val();
        var telefonoup=$("#telefonoup").val();
        var abiertoup=$("#abiertoup").val();
        var cierreup=$("#cierreup").val();
        var direccionup=$("#direccionup").val();
        var latitudup=$("#latitudup").val();
        var longitudup=$("#longitudup").val();
        var deliveryu=$("#deliveryu").val();
        var imagen_farm=$("#imagen_farm").val();
        var extension=$("#farm_imageA").val().split('.').pop().toLowerCase();;
        console.log(extension);
        if(extension != '')
          {
           if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
           {
            alert("Invalid Image File");
            $('#imagen_farm').val('');
            return false;
           }
          } 
    
    e.preventDefault();
    
    $.ajax({
        url:'farmacia/editarfarmacia/',
        type:'post',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(respuesta){
            $('#modalfarmup').modal('hide');
            $("#table").DataTable().destroy();
            $("#table tbody").html(respuesta);
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true,rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                "language":{
                    "sSearch":"Buscar",
                    "lengthMenu":"Mostrar _MENU_ registros",
                    "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                    "zeroRecords":"No se encuentran resultados",
                    "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
                    "oPaginate":{
                        "sNext":"Siguiente",
                        "sPrevious":"Anterior"
                    }        
                }
                
                });  
    
            Swal.fire(
                'Se actualizo con exito!',
                'el registro',
                'success'
            )
    
        }
    
    
    
    
    });
    
    
    });
    
/* Funcion para eliminar farmacia*/

$("#table").on("click",".btBorrarfarmacia",function(){
    Swal.fire({
        title: 'Estas seguro?',
        text: "No podrá recuperar los datos!",
        icon: 'warning',
        confirmButtonColor: '#d9534f',
        cancelButtonColor: '#428bca',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Sí, Eliminarlo!',
        cancelButtonText: 'No, cancelar',

        reverseButtons:true
    }).then((result)=>{
        if(result.isConfirmed){
            var idfarmacia=$(this).attr('data-borrarfarmacia');

            $.ajax({
                url:'farmacia/borrarfarmacia/',
                type:"POST",
                data:{'idfarmacia':idfarmacia},
                success:function(respuesta){
                    $("#table").DataTable().destroy();
                    $("#table tbody").html(respuesta);
                    $('#table').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        responsive: true,rowReorder: {
                            selector: 'td:nth-child(2)'
                        },
                        "language":{
                            "sSearch":"Buscar",
                            "lengthMenu":"Mostrar _MENU_ registros",
                            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                            "zeroRecords":"No se encuentran resultados",
                            "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
                            "oPaginate":{
                                "sNext":"Siguiente",
                                "sPrevious":"Anterior"
                            }        
                        }
                        
                        });  
                    Swal.fire(
                        'Borrado',
                        'El registro a sido eliminado',
                        'success'
                    )

                    
                }
            });



            


        }
        else if (
            result.dismiss === Swal.DismissReason.cancel
          ){
            Swal.fire(
            'cancelado',
            'el registro esta a salvo',
            'error'
    
            )
    
          }

    });


});


/* Funcion para mandar datos al controlador para ingresar datos de eventos a la base de datos, cuando se haga el envio del formulario*/
$("#formagregarevento").on("submit",function(e){

    var farmacia=$("#farmacia").val();
    var actividad=$("#actividad").val();
    var direccionevent=$("#direccionevent").val();
    var fecha=$("#fecha").val();
    var hora=$("#hora").val();
    var encargado=$("#encargado").val();

    var extension=$("#image_invitado").val().split('.').pop().toLowerCase();;
console.log(extension);
if(extension != '')
  {
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#image_invitado').val('');
    return false;
   }
  } 

    e.preventDefault();
    $.ajax({
        url:'evento/insertarevento/',
        type:'post',
        data:new FormData(this),
        contentType:false,
        processData:false,
    success:function(respuesta){
  
        $('#modalevent').modal('hide');
        $("#table").DataTable().destroy();
      $("#table tbody").html(respuesta);
      $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true,rowReorder: {
            selector: 'td:nth-child(2)'
        },
        "language":{
            "sSearch":"Buscar",
            "lengthMenu":"Mostrar MENU registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "zeroRecords":"No se encuentran resultados",
            "info":"Mostrando registros del START al END de un TOTAL de registros",
            "oPaginate":{
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
            }        
        }
        
        });  

        $('#formagregarevento')[0].reset();

        Swal.fire(
            'Se registro el evento con exito',
            'en el sistema',
            'success'
        )


    }
    ,error:function(){
        console.log('Error');
    }



}); 



});


/* Funciones para editar eventos*/


$("#table").on("click",".btEditarevento",function(){
    var datos= JSON.parse($(this).attr('data-evento'));
    $("#idevento").val(datos['id_evento']);
    $("#farmaciaeditar").val(datos['farmacia_id_farmacia']);
    $("#actividadA").val(datos['actividad']);
    $("#direccioneventA").val(datos['direccion']);
    $("#fechaA").val(datos['fecha']);
    $("#horaA").val(datos['hora']);
    $("#encargadoA").val(datos['encargado']);

   $("#user_uploaded_image").html(datos['imagen_invit']);
   $("#probando").attr("src",'Views/plantilla/assets/img/'+datos['imagen_invit']);
   var idevento=$("#idevento").val();
    console.log(idevento);
   
   
    });

    

    
    $("#formaactualizarevento").submit(function(e){
        $("#idevento").attr("disabled", false);
        var idevento=$("#idevento").val();
        var farmaciaeditar=$("#farmaciaeditar").val();
        var actividadA=$("#actividadA").val();
        var direccioneventA=$("#direccioneventA").val();
        var fechaA=$("#fechaA").val();
        var horaA=$("#horaA").val();
        var encargadoA=$("#encargadoA").val();

        var image_invitadoA=$("#image_invitadoA").val();
        var extension=$("#image_invitadoA").val().split('.').pop().toLowerCase();;
        console.log(extension);
        if(extension != '')
          {
           if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
           {
            alert("Invalid Image File");
            $('#image_invitadoA').val('');
            return false;
           }
          } 
    
    e.preventDefault();
    
    $.ajax({
        url:'evento/editarevento/',
        type:'post',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(respuesta){
            $('#modaleventA').modal('hide');
            $("#table").DataTable().destroy();
            $("#table tbody").html(respuesta);
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true,rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                "language":{
                    "sSearch":"Buscar",
                    "lengthMenu":"Mostrar MENU registros",
                    "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                    "zeroRecords":"No se encuentran resultados",
                    "info":"Mostrando registros del START al END de un TOTAL de registros",
                    "oPaginate":{
                        "sNext":"Siguiente",
                        "sPrevious":"Anterior"
                    }        
                }
                
                });  
    
            Swal.fire(
                'Se actualizo el registro con exito!',
                'el registro',
                'success'
            )
    
        }
    
    
    
    
    });
    
    
    });

  /* Funcion para mandar datos al controlador para ingresar datos de usuario a la base de datos, cuando se haga el envio del formulario*/
$("#formagregarusuario").submit(function(e){

    var nombreU=$("#nombreusuario").val();
    var claveU=$("#claveu").val();
    var privilegio=$("#privilegio").val();



    e.preventDefault();
    $.ajax({
        url:'usuario/insertarusuario/',
        type:'post',
        data:{'nombreU':nombreU,'claveU':claveU,'privilegio':privilegio},
    success:function(respuesta){
        $('#modalusuario').modal('hide');
        $("#table").DataTable().destroy();
      $("#table tbody").html(respuesta);
      $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true,rowReorder: {
            selector: 'td:nth-child(2)'
        },
        "language":{
            "sSearch":"Buscar",
            "lengthMenu":"Mostrar MENU registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "zeroRecords":"No se encuentran resultados",
            "info":"Mostrando registros del START al END de un TOTAL de registros",
            "oPaginate":{
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
            }        
        }
        
        });  

        $('#formagregarusuario')[0].reset();

        Swal.fire(
            'Se registro el regente con exito',
            'en el sistema',
            'success'
        )


    }
    ,error:function(){
        console.log('Error');
    }



});  

});  




    /* Funcion para eliminar evento*/

$("#table").on("click",".btBorrarevento",function(){
    Swal.fire({
        title: 'Estas seguro?',
        text: "No podrá recuperar los datos!",
        icon: 'warning',
        confirmButtonColor: '#d9534f',
        cancelButtonColor: '#428bca',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Sí, Eliminarlo!',
        cancelButtonText: 'No, cancelar',

        reverseButtons:true
    }).then((result)=>{
        if(result.isConfirmed){
            var ideventoborrar=$(this).attr('data-borrarevento');

            $.ajax({
                url:'evento/borrarevento/',
                type:"POST",
                data:{'ideventoborrar':ideventoborrar},
                success:function(respuesta){
                    $("#table").DataTable().destroy();
                    $("#table tbody").html(respuesta);
                    $('#table').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        responsive: true,rowReorder: {
                            selector: 'td:nth-child(2)'
                        },
                        "language":{
                            "sSearch":"Buscar",
                            "lengthMenu":"Mostrar MENU registros",
                            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                            "zeroRecords":"No se encuentran resultados",
                            "info":"Mostrando registros del START al END de un TOTAL de registros",
                            "oPaginate":{
                                "sNext":"Siguiente",
                                "sPrevious":"Anterior"
                            }        
                        }
                        
                        });  
                    Swal.fire(
                        'Borrado',
                        'El registro a sido eliminado',
                        'success'
                    )

                    
                }
            });



            


        } else if (
            result.dismiss === Swal.DismissReason.cancel
          ){
            Swal.fire(
            'cancelado',
            'el registro esta a salvo',
            'error'
    
            )
    
          }

    });


});


/* Funcion para confirmar solicitud de compra */

$("#table").on("click",".btconfirmarcompra",function(){
    Swal.fire({
        title: 'Estas seguro?',
        text: "Confirmar venta!",
        icon: 'info',
        confirmButtonColor: '#d9534f',
        cancelButtonColor: '#428bca',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Sí, Confirmar!',
        cancelButtonText: 'No, cancelar',

        reverseButtons:true
    }).then((result)=>{
        if(result.isConfirmed){
            var idconfirmar=$(this).attr('data-confirmar');

            $.ajax({
                url:'solicitud/confirmar/',
                type:"POST",
                data:{'idconfirmar':idconfirmar},
                success:function(respuesta){
                    $("#table").DataTable().destroy();
                    $("#table tbody").html(respuesta);
                    $('#table').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        responsive: true,rowReorder: {
                            selector: 'td:nth-child(2)'
                        },
                        "language":{
                            "sSearch":"Buscar",
                            "lengthMenu":"Mostrar _MENU_ registros",
                            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                            "zeroRecords":"No se encuentran resultados",
                            "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
                            "oPaginate":{
                                "sNext":"Siguiente",
                                "sPrevious":"Anterior"
                            }        
                        }
                        
                        });  
                    Swal.fire(
                        'Confirmado',
                        'La venta se realizo',
                        'success'
                    )

                    
                }
            });



            


        }
        else if (
            result.dismiss === Swal.DismissReason.cancel
          ){
            Swal.fire(
            'cancelado',
            'el registro esta a salvo',
            'error'
    
            )
    
          }

    });


});






/* Funcion para mandar datos al controlador para ingresar datos de farmacos a la base de datos, cuando se haga el envio del formulario*/
$("#formagregarfarmaco").on("submit",function(e){

    var farmacia=$("#farmacia").val();
    var nombremedico=$("#nombremedico").val();
    var nombrecomercial=$("#nombrecomercial").val();
    var laboratorio=$("#laboratorio").val();
    var estado=$("#estado").val();
    var peso=$("#peso").val();
    var volumen=$("#volumen").val();
    var vencimiento=$("#vencimiento").val();
    var tipo=$("#tipo").val();
    var cantidad=$("#cantidad").val();
    var precio=$("#precio").val();
    var aplica=$("#aplica").val();
    var precauciones=$("#precauciones").val();
    var reacciones=$("#reacciones").val();
    var interacciones=$("#interacciones").val();
    var extension=$("#user_image").val().split('.').pop().toLowerCase();;
console.log(extension);
if(extension != '')
  {
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#user_image').val('');
    return false;
   }
  } 

    e.preventDefault();
    $.ajax({
        url:'farmaco/insertarfarmaco/',
        type:'post',
        data:new FormData(this),
        contentType:false,
        processData:false,
    success:function(respuesta){
  
        $('#modalfarmco').modal('hide');
        $("#table").DataTable().destroy();
      $("#table tbody").html(respuesta);
      $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true,rowReorder: {
            selector: 'td:nth-child(2)'
        },
        "language":{
            "sSearch":"Buscar",
            "lengthMenu":"Mostrar _MENU_ registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "zeroRecords":"No se encuentran resultados",
            "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
            "oPaginate":{
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
            }        
        }
        
        });  

        $('#formagregarfarmaco')[0].reset();

        Swal.fire(
            'Se registro el farmaco con exito',
            'en el sistema',
            'success'
        )


    }
    ,error:function(){
        console.log('Error');
    }



}); 



});



/*funcion para cargar informacion en el modal para editar farmacos*/
$("#table").on("click",".btEditarfarmaco",function(){
    var datos= JSON.parse($(this).attr('data-farmacos'));
    $("#idfarmaco").val(datos['id_farmaco']);
    $("#farmaciaeditar").val(datos['farmacia_id_farmacia']);
    $("#nombremedicoA").val(datos['nombre_medico']);
    $("#nombrecomercialA").val(datos['nombre_comercial']);
    $("#laboratorioA").val(datos['laboratorio']);
    $("#estadoA").val(datos['estado']);
    $("#pesoA").val(datos['peso']);
    $("#volumenA").val(datos['volumen']);
    $("#vencimientoA").val(datos['fecha_de_vencimiento']);
    $("#tipoA").val(datos['tipo']);
    $("#cantidadA").val(datos['cantidad']);
    $("#precioA").val(datos['precio']);

    $("#aplicaA").val(datos['aplicacion']);
    $("#precaucionesA").val(datos['precauciones']);
    $("#reaccionesA").val(datos['reacciones']);
    $("#interaccionesA").val(datos['interacciones']);
    $("#user_uploaded_image").val(datos['interacciones']);
   $("#user_uploaded_image").html(datos['imagen']);
   $("#probando").attr("src",'Views/plantilla/assets/img/'+datos['imagen']);

   
   
    });
    
    /*fucnion para realizar actualizacion con el modal actu farmacos*/
    
    $("#formeditarfarmaco").submit(function(e){
        var idfarmaco=$("#idfarmaco").val();
        var farmaciaeditar=$("#farmaciaeditar").val();
        var nombremedicoA=$("#nombremedicoA").val();
        var nombrecomercialA=$("#nombrecomercialA").val();
        var laboratorioA=$("#laboratorioA").val();
        var estadoA=$("#estadoA").val();
        var pesoA=$("#pesoA").val();
        var volumenA=$("#volumenA").val();
        var vencimientoA=$("#vencimientoA").val();
        var tipoA=$("#tipoA").val();
        var cantidadA=$("#cantidadA").val();
        var precioA=$("#precioA").val();
        var aplicaA=$("#aplicaA").val();
        var precaucionesA=$("#precaucionesA").val();
        var reaccionesA=$("#reaccionesA").val();
        var interaccionesA=$("#interaccionesA").val();
        var user_imageA=$("#user_imageA").val();
        var extension=$("#user_imageA").val().split('.').pop().toLowerCase();;
        console.log(extension);
        if(extension != '')
          {
           if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
           {
            alert("Invalid Image File");
            $('#user_imageA').val('');
            return false;
           }
          } 
    
    e.preventDefault();
    
    $.ajax({
        url:'farmaco/editarfarmaco/',
        type:'post',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(respuesta){
            $('#modalactualizarfarmacos').modal('hide');
            $("#table").DataTable().destroy();
            $("#table tbody").html(respuesta);
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true,rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                "language":{
                    "sSearch":"Buscar",
                    "lengthMenu":"Mostrar _MENU_ registros",
                    "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                    "zeroRecords":"No se encuentran resultados",
                    "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
                    "oPaginate":{
                        "sNext":"Siguiente",
                        "sPrevious":"Anterior"
                    }        
                }
                
                });  
    
                $('#formeditarfarmaco')[0].reset();
            Swal.fire(
                'Se actualizo el registro con exito!',
                'el registro',
                'success'
            )
    
        }
    
    
    
    
    });
    
    
    });


/* Funcion para eliminar Farmacos*/

$("#table").on("click",".btBorrarfarmaco",function(){
    Swal.fire({
        title: 'Estas seguro?',
        text: "No podrá recuperar los datos!",
        icon: 'warning',
        confirmButtonColor: '#d9534f',
        cancelButtonColor: '#428bca',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Sí, Eliminarlo!',
        cancelButtonText: 'No, cancelar',

        reverseButtons:true
    }).then((result)=>{
        if(result.isConfirmed){
            var idfarmacoborrar=$(this).attr('data-borrarfarmaco');

            $.ajax({
                url:'farmaco/borrarfarmaco/',
                type:"POST",
                data:{'idfarmacoborrar':idfarmacoborrar},
                success:function(respuesta){
                    $("#table").DataTable().destroy();
                    $("#table tbody").html(respuesta);
                    $('#table').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        responsive: true,rowReorder: {
                            selector: 'td:nth-child(2)'
                        },
                        "language":{
                            "sSearch":"Buscar",
                            "lengthMenu":"Mostrar _MENU_ registros",
                            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                            "zeroRecords":"No se encuentran resultados",
                            "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
                            "oPaginate":{
                                "sNext":"Siguiente",
                                "sPrevious":"Anterior"
                            }        
                        }
                        
                        });  
                    Swal.fire(
                        'Borrado',
                        'El registro a sido eliminado',
                        'success'
                    )

                    
                }
            });



            


        } else if (
            result.dismiss === Swal.DismissReason.cancel
          ){
            Swal.fire(
            'cancelado',
            'el registro esta a salvo',
            'error'
    
            )
    
          }

    });


});
    





/* Funcion para mandar datos al controlador para ingresar datos de regentes a la base de datos, cuando se haga el envio del formulario*/
$("#formagregarregentes").on("submit",function(e){

    var nomb=$("#nombres").val();
    var apell=$("#apellidos").val();
    var sex=$("#sexo").val();
    var tel=$("#telefono").val();
    var corr=$("#correo").val();
    var nombreu=$("#nombreu").val();
    var clave=$("#clave").val();
    


    e.preventDefault();
    $.ajax({
        url:'regente/insertarregente/',
        type:'post',
        data:{'nomb':nomb,'apell':apell,'sex':sex,
    'tel':tel,'corr':corr,'nombreu':nombreu,'clave':clave},
    success:function(respuesta){
        $('#modalregente').modal('hide');
        $("#table").DataTable().destroy();
      $("#table tbody").html(respuesta);
      $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true,rowReorder: {
            selector: 'td:nth-child(2)'
        },
        "language":{
            "sSearch":"Buscar",
            "lengthMenu":"Mostrar _MENU_ registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "zeroRecords":"No se encuentran resultados",
            "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
            "oPaginate":{
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
            }        
        }
        
        });  

        $('#formagregarregentes')[0].reset();

        Swal.fire(
            'Se registro el regente con exito',
            'en el sistema',
            'success'
        )


    }
    ,error:function(){
        console.log('Error');
    }



}); 



});

/* Funciones para editar*/

/*funcion para cargar informacion en el modal para editar farmacos*/
$("#table").on("click",".btEditarregente",function(){
    var datos= JSON.parse($(this).attr('data-regente'));
    $("#idr").val(datos['id_regente']);
    $("#nombresu").val(datos['nombres']);
    $("#apellidosu").val(datos['apellidos']);
    $("#sexou").val(datos['sexo']);
    $("#telefonou").val(datos['telefono']);
    $("#correou").val(datos['correo']);
    $("#nombreup").val(datos['nombre_usuario']);
    $("#claveu").val(datos['clave']);
    
    });
    
    /*fucnion para realizar actualizacion con el modal actu usuario*/
    
    $("#formeditarregentes").submit(function(e){
        var idr=$("#idr").val();
        var nombu=$("#nombresu").val();
        var apellu=$("#apellidosu").val();
        var sexu=$("#sexou").val();
        var telu=$("#telefonou").val();
        var corru=$("#correou").val();
        var nombreup=$("#nombreup").val();
        var claveu=$("#claveu").val();
    
    e.preventDefault();
    
    $.ajax({
        url:'regente/editaregente/',
        type:'post',
        data:{'idr':idr,'nombu':nombu,'apellu':apellu,'sexu':sexu,
    'telu':telu,'corru':corru,'nombreup':nombreup,'claveu':claveu},
        success:function(respuesta){
            $('#modaleditarregente').modal('hide');
            $("#table").DataTable().destroy();
            $("#table tbody").html(respuesta);
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true,rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                "language":{
                    "sSearch":"Buscar",
                    "lengthMenu":"Mostrar _MENU_ registros",
                    "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                    "zeroRecords":"No se encuentran resultados",
                    "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
                    "oPaginate":{
                        "sNext":"Siguiente",
                        "sPrevious":"Anterior"
                    }        
                }
                
                });  
    
            Swal.fire(
                'Se actualizo con exito!',
                'el registro',
                'success'
            )
    
        }
    
    
    
    
    });

    
    
    });
    

/* Funcion para eliminar regente*/

$("#table").on("click",".btBorrarregente",function(){
    Swal.fire({
        title: 'Estas seguro?',
        text: "No podrá recuperar los datos!",
        icon: 'warning',
        confirmButtonColor: '#d9534f',
        cancelButtonColor: '#428bca',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Sí, Eliminarlo!',
        cancelButtonText: 'No, cancelar',

        reverseButtons:true
    }).then((result)=>{
        if(result.isConfirmed){
            var idreg=$(this).attr('data-borraregente');

            $.ajax({
                url:'regente/borraregente/',
                type:"POST",
                data:{'idreg':idreg},
                success:function(respuesta){
                    $("#table").DataTable().destroy();
                    $("#table tbody").html(respuesta);
                    $('#table').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        responsive: true,rowReorder: {
                            selector: 'td:nth-child(2)'
                        },
                        "language":{
                            "sSearch":"Buscar",
                            "lengthMenu":"Mostrar _MENU_ registros",
                            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                            "zeroRecords":"No se encuentran resultados",
                            "info":"Mostrando registros del _START_ al _END_ de un _TOTAL_ de registros",
                            "oPaginate":{
                                "sNext":"Siguiente",
                                "sPrevious":"Anterior"
                            }        
                        }
                        
                        });  
                    Swal.fire(
                        'Borrado',
                        'El registro a sido eliminado',
                        'success'
                    )

                    
                }
            });



            


        }

    });


});





});

