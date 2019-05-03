var arr_servicios=new Array();
var arr_estados=new Array();
var arr_eventos=new Array();
					 
getServicios();	

function estados(data){
	$(".active").removeClass("active");
	$(data).parent().addClass("active");
	getEstados();
	fx_div("#divestados");
	$("#navbar").removeClass("in");
	
	}
function servicios(data){
	$(".active").removeClass("active");
	$(data).parent().addClass("active");
	getServicios();
	fx_div("#divservicios");
	$("#navbar").removeClass("in");

	
	}	
function eventos(data){
	$(".active").removeClass("active");
	$(data).parent().addClass("active");
	getEventos();
	fx_div("#diveventos");
	$("#navbar").removeClass("in");

	}
	function usuarios(data){
	$(".active").removeClass("active");
	$(data).parent().addClass("active");
	getUsuarios();
	fx_div("#divusuarios");
	$("#navbar").removeClass("in");

	}

function activos(data)
{
    $(".active").removeClass("active");
    $(data).parent().addClass("active");
    
    var tblEstadoActivos = $('#tblEstadoActivos').DataTable();
    tblEstadoActivos.destroy();
    
    $('#tblEstadoActivos').DataTable(
      {
        dataType: 'json',
        responsive: true,
        contentType: "application/json; charset=utf-8",
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'csv', 'print'
        ],
        ajax: 
        {
          url: 'get/estadosActivos.php',
          type: "GET"
        },
        //"pageLength": dataTableGridJS.verRegistro,
        "bFilter": true,
        "destroy": true,
        "columns": [
          {
            "data": "proceso"
          },
          {
            "data": "subproceso"
          },
          {
            "data": "host"
          },
          {
            "data": "interface"
          },
          {
            "data": "problema"
          },
          {
            "data": "fecha"
          }
        ],
        fixedHeader: true,
        language: 
        {
          url:dataTableGridJS.url
        }
      }
    );


    fx_div("#divactivos");
    $("#navbar").removeClass("in");
}

function fx_div(data)
{
	$("#diveventos").hide();
	$("#divestados").hide();
	$("#divservicios").hide();
	$("#divusuarios").hide();
  $("#divactivos").hide();
	$("#formevento").hide();
	$("#formestado").hide();
	$("#formservicio").hide();
	$("#formusuario").hide();
	
	$(data).show();
	}	



	
function form_servicio(data)	 
{
	aux=$(data).parent().parent();

 
		 $.ajax({
                url:   "get/servicios.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					 
				
					for(var i = 0; i < r.servicios.length; i++) 
					{		
					   
					 
					 
						var v = r.servicios[i];

						
						$("#id",$("#formservicio")).val(v.id);
						$("#nombre",$("#formservicio")).val(v.servicio);
						$("#estado",$("#formservicio")).val(v.estado); 
	
								 		
					}	
				  
				 	 $(".update",$("#formservicio")).show();
					fx_div("#formservicio"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor ..");
					 $("#msg").removeClass().addClass("alert alert-info").html("error no se pudo ingresar a la BD");
 $('#alert').modal("show");
                }
            });
	
}

function form_estado(data)	 
{
	aux=$(data).parent().parent();

		 $.ajax({
                url:   "get/estados.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					 
				
					for(var i = 0; i < r.estados.length; i++) 
					{		
					   
					 
					 
						var v = r.estados[i];

						
						$("#id",$("#formestado")).val(v.id);
						$("#nombre",$("#formestado")).val(v.nombre);
						$("#estado",$("#formestado")).val(v.estado); 
	                    $("#color",$("#formestado")).val(v.color);
						fsc(v.color);		 		
					}	
				  
				 	 $(".update",$("#formestado")).show();
					fx_div("#formestado"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
			
}

function form_evento(data)	 
{
	aux=$(data).parent().parent();


	
			 $.ajax({
                url:   "get/eventos.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					
					
					for(var i = 0; i < r.eventos.length; i++) 
					{		
					   
					 
					 
						var v = r.eventos[i];
                salida=""; 
				for(var i = 0; i < r.estados.length; i++) 
					{
						var e = r.estados[i];
						if (v.estado_id==e.id) {
						salida=salida+"<option value='"+e.id+"'>"+e.nombre+"</option>";
						}
						
					}
					$("#estado_evento",$("#formevento")).html(salida);
						
						$("#id",$("#formevento")).val(v.id);
						$("#servicio",$("#formevento")).html("<option value="+v.id_servicio+">"+v.nombre_servicio+"</option>");
						
						$("#servicio",$("#formevento")).val(v.id_servicio);
						$("#evento",$("#formevento")).html("<option value="+v.evento_id+">"+v.nombre_evento +"</option>");
						$("#evento",$("#formevento")).val(v.evento_id); 
	                    $("#detalle",$("#formevento")).val(v.detalle);
						$("#fecha",$("#formevento")).val(v.fechaformato);
						$('#fecha').datepicker('update');
						$("#hora",$("#formevento")).val(v.hora);
						$("#estado_evento",$("#formevento")).val(v.estado_id);
						 		 		
					}	
				  
				 	 $(".update",$("#formevento")).show();
					fx_div("#formevento"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
}

function form_usuario(data)	 
{
	aux=$(data).parent().parent();

		 $.ajax({
                url:   "get/usuarios.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					 
				
					for(var i = 0; i < r.usuarios.length; i++) 
					{		
					   
					 
					 
						var v = r.usuarios[i];

						
						$("#id",$("#formusuario")).val(v.id);
						$("#nombre",$("#formusuario")).val(v.nombre);
						$("#estado",$("#formusuario")).val(v.estado); 
	                    $("#login",$("#formusuario")).val(v.login);
						$("#mail",$("#formusuario")).val(v.mail);

					}	
				  
				 	 $(".update",$("#formusuario")).show();
					fx_div("#formusuario"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
			
}

function form_evento_add(data)	 
{
	aux=$(data).parent().parent();


	
			 $.ajax({
                url:   "get/eventos.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					      salida=""; 
				     for(var i = 0; i < r.estados.length; i++) 
					{
						var e = r.estados[i];
						
						salida=salida+"<option value='"+e.id+"'>"+e.nombre+"</option>";
						
						
					}
					$("#estado_evento",$("#formevento")).html(salida);
					
					for(var i = 0; i < r.eventos.length; i++) 
					{		
					   
					 
					 
						var v = r.eventos[i];
          
						
						$("#id",$("#formevento")).val("");
						$("#servicio",$("#formevento")).html("<option value="+v.id_servicio+">"+v.nombre_servicio+"</option>");
						
						$("#servicio",$("#formevento")).val(v.id_servicio);
						$("#evento",$("#formevento")).html("<option value="+v.id+">"+v.fecha+ " "+ v.estado_evento+" "+ v.detalle +"</option>");
						$("#evento",$("#formevento")).val(v.evento_id); 
	                    $("#detalle",$("#formevento")).val("");
						$("#fecha",$("#formevento")).val(v.fechaformato);
						$("#hora",$("#formevento")).val("");
						$("#estado_evento",$("#formevento")).val("");
						 		 		
					}	
				  
				 	 $(".update",$("#formevento")).show();
					fx_div("#formevento"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
}


function add_servicio()	 
{
	$(".update",$("#formservicio")).hide();
	$("#id",$("#formservicio")).val("");
	$("#nombre",$("#formservicio")).val("");
	$("#estado",$("#formservicio")).val("vigente"); 
	fx_div("#formservicio");
}
function add_estado(data)	 
{
$('#color').val("error");
fsc("error");	
 $(".update",$("#formestado")).hide();
 $("#id",$("#formestado")).val("");
 $("#nombre",$("#formestado")).val("");
  $("#estado",$("#formestado")).val("");
 fx_div("#formestado");
}
function add_evento(data)	 
{ $(".update",$("#formevento")).hide();

  $("#id",$("#formevento")).val("");
  $("#detalle",$("#formevento")).val("");
  $("#fecha",$("#formevento")).val("");
  $("#hora",$("#formevento")).val("");
	
 			 $.ajax({
                url:   "get/servicios.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="<option value=''>Seleccione Servicio</option>";
					
					for(var i = 0; i < r.servicios.length; i++) 
					{		
						var v = r.servicios[i];

						if (v.estado=='vigente'){
				 
						salida=salida+"<option value='"+v.id+"'>"+v.servicio+"</option>";
						}							 		
					}	
				   $("#servicio").html(salida);
			 			 $.ajax({
                url:   "get/estados.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="<option value=''>seleccione un estado</option>";
					
					for(var i = 0; i < r.estados.length; i++) 
					{		
						var v = r.estados[i];

						if (v.estado=='vigente'){
				 
						salida=salida+"<option value='"+v.id+"'>"+v.nombre+"</option>";
						}
						
						
						
								 		
					}	
				   $("#estado_evento").html(salida);
				 fx_div("#formevento");
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            })
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            })
	
}
function add_usuario()	 
{
	$(".update",$("#formusuario")).hide();
	$("#id",$("#formusuario")).val("");
	$("#nombre",$("#formusuario")).val("");
	$("#login",$("#formusuario")).val("");
	$("#mail",$("#formusuario")).val("");
	$("#password",$("#formusuario")).val("");
	$("#estado",$("#formusuario")).val("vigente"); 
	fx_div("#formusuario");
}
function fsc(data)
{   $('#color').val(data);
	$("#selcolor").removeClass();
	$("#selcolor").addClass("badge");
	$("#selcolor").addClass("badge-"+data);
	
	}
		
		
		function grabar_estado()
			{
				
				id=$("#id",$("#formestado")).val();
				url="post/estado.php";
				
				if (id*1>0) {
					url="update/estado.php";
	
			       }
			if ( $("#nombre",$("#formestado")).val()=="")
			{
				fx_alert("info","Complete el campo nombre , gracias");
				return false;
				}
				
				 $.ajax({
                url:   url,
                type:  "POST",
                dataType: "json",
				data: $("#form",$("#formestado")).serialize(),
                success:  function (r) 
                {  
				estados($('#m2'));	
				 fx_alert(r.tipo,r.respuesta);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
			}
				function grabar_servicio()
			{
				
				
				id=$("#id",$("#formservicio")).val();
				url="post/servicio.php";
				
				if (id*1>0) {
					url="update/servicio.php";
	
			}
			
				if ( $("#nombre",$("#formservicio")).val()=="")
			{
				fx_alert("info","Complete el campo nombre , gracias");
				return false;
				}
				 $.ajax({
                url:  url ,
                type:  "POST",
                dataType: "json",
				data: $("#form",$("#formservicio")).serialize(),
                success:  function (r) 
                {  
				 
				servicios($('#m1'));	
				 fx_alert(r.tipo,r.respuesta);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
	
				
			}
			
					function grabar_evento()
			{
				
				id=$("#id",$("#formevento")).val();
				url="post/evento.php";
				
				if (id*1>0) {
					url="update/evento.php";
	
			}
			
			if ( $("#servicio",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo servicio , gracias");
				return false;
			}
			if ( $("#detalle",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo detalle , gracias");
				return false;
			}
		 	if ( $("#fecha",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo fecha , gracias");
				return false;
			}
			if ( $("#hora",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo hora , gracias");
				return false;
			}
			
				if ( $("#estado_evento",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo Estado evento , gracias");
				return false;
			}
			
				 $.ajax({
                url:  url,
                type:  "POST",
                dataType: "json",
				data: $("#form",$("#formevento")).serialize(),
                success:  function (r) 
                {  
				 getServicios();
				eventos($('#m3'));	
				 fx_alert(r.tipo,r.respuesta);
					 			  
				  },
                error: function(e)
                {
                   fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
			}
				
	function grabar_usuario()
			{
				
				
				id=$("#id",$("#formusuario")).val();
				url="post/usuario.php";
				
				if (id*1>0) {
					url="update/usuario.php";
	
			}
			
				if ( $("#login",$("#formusuario")).val()=="")
			{
				fx_alert("info","Complete el campo login , gracias");
				return false;
			}
				
					if (id*1==0) {
					if ( $("#password",$("#formusuario")).val()=="")
			{
				fx_alert("info","Complete el campo password , gracias");
				return false;
			}
	
			}
				if ( $("#nombre",$("#formusuario")).val()=="")
			{
				fx_alert("info","Complete el campo nombre , gracias");
				return false;
			}
				 $.ajax({
                url:  url ,
                type:  "POST",
                dataType: "json",
				data: $("#form",$("#formusuario")).serialize(),
                success:  function (r) 
                {  
				 
				usuarios($('#m4'));	
				 fx_alert(r.tipo,r.respuesta);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
	
				
			}				
					
			function getCalendario(fecha)
			{
				 $.ajax({
                url:   "get/calendario.php",
                type:  "POST",
                dataType: "json",
				data: "dia="+fecha,
                success:  function (r) 
                {  
					var j=1;
				    $(".evento").html("&nbsp;");
				   $(".evento").removeClass("evento");
					calendarioIndice=new Array();
				    calendario=new Array();
					for(var i = 0; i < r.calendario.length; i++) 
					{
						var v = r.calendario[i];
						calendario[j]=v;
						calendarioIndice[v.original]=j;
						$("#d"+j++).html(v.fecha);
								 		
					}	
				 $("#siguiente").removeClass("disabled");	
					fechas=r.fechas;
					if (fechas.siguiente == "")
					{
					$("#siguiente").addClass("disabled");	
					}
					
				 
			
				     getEventos();	 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
				
							
			function getServicios()
			{
				 $.ajax({
                url:   "get/servicios.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="";
					arr_servicios=new Array();
					for(var i = 0; i < r.servicios.length; i++) 
					{		var cuerpo=$("#cuerpo",$("#renderServicio")).html();
					      var aux=$(cuerpo);
					 
					 
						var v = r.servicios[i];

						
						$("#e1",aux).html(v.id);
						$("#e2",aux).html(v.servicio);
						$("#e3",aux).html('<span class="badge badge-'+v.color+'">&nbsp;</span> ' + v.estado_servicio);
						$("#e4",aux).html(v.estado);
						arr_servicios[v.id]=v;
						
						salida=salida+"<tr id='servicio"+v.id+"'>"+$(aux).html()+"</tr>";
						
								 		
					}	
				   $("#cuerpotabla",$("#divservicios")).html(salida);
				 
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
				
				
					function getEstados()
			{
				 $.ajax({
                url:   "get/estados.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="";
					arr_estados=new Array();
					for(var i = 0; i < r.estados.length; i++) 
					{		var cuerpo=$("#cuerpo",$("#renderEstado")).html();
					      var aux=$(cuerpo);
					 
					 
						var v = r.estados[i];

						
						$("#e1",aux).html(v.id);
						$("#e2",aux).html(v.nombre);
						$("#e3",aux).html('<span class="badge badge-'+v.color+'">&nbsp;</span>');
						$("#e4",aux).html(v.estado);
						arr_estados[v.id]=v;
						
						salida=salida+"<tr>"+$(aux).html()+"</tr>";
						
								 		
					}	
				   $("#cuerpotabla",$("#divestados")).html(salida);
				 
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
		function getEventos()
			{
				 $.ajax({
                url:   "get/evento_detalle.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="";
					for(var i = 0; i < r.eventos.length; i++) 
					{		var cuerpo=$("#cuerpo",$("#renderEvento")).html()
					      var aux=$(cuerpo);
					 
					 
						var v = r.eventos[i];

						$("#e1",aux).html(v.id);

						$("#e3",aux).html(v.detalle);
						$("#e4",aux).html(v.fecha);
						$("#e5",aux).html(v.estado_evento);
						$("#e6",aux).html(v.estado);
						if (v.id==v.evento_id){
						$("#e8",aux).html("Nuevo evento");
						
						}else {
						$("#e8",aux).html("Detalle");
						$("#plus",aux).remove();
						}
						arr_eventos[v.id]=v;	 										                        $("#e2",aux).html("<span class='badge badge-"+arr_servicios[v.id_servicio].color+"' >&nbsp;</span> "+ arr_servicios[v.id_servicio].servicio);	
						salida=salida+"<tr>"+$(aux).html()+"</tr>";
					}	
				  
				 $("#cuerpotabla",$("#diveventos")).html(salida);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
				
					function getUsuarios()
			{
				 $.ajax({
                url:   "get/usuarios.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="";
					 
					for(var i = 0; i < r.usuarios.length; i++) 
					{		var cuerpo=$("#cuerpo",$("#renderUsuario")).html();
					      var aux=$(cuerpo);
					 
					 
						var v = r.usuarios[i];

						
						$("#e1",aux).html(v.id);
						$("#e2",aux).html(v.login);
						$("#e3",aux).html(v.nombre);
						$("#e4",aux).html(v.mail);
						$("#e5",aux).html(v.estado);
					 
						
						salida=salida+"<tr>"+$(aux).html()+"</tr>";
						
							 		
					}	
				   $("#cuerpotabla",$("#divusuarios")).html(salida);
				 
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
			
				function cambioServicio(data)
				{
									 $.ajax({
                url:   "get/eventos.php",
                type:  "POST",
                dataType: "json",
				data:"servicio="+$(data).val(),
                success:  function (r) 
                {  
					var salida="<option value=''>Nuevo Evento</option>";
					for(var i = 0; i < r.eventos.length; i++) 
					{		 
					 
						var v = r.eventos[i];

				 
						salida=salida+"<option value="+v.evento_id+">"+v.original+"- "+v.estado_evento+" "+ v.detalle +"</tr>";
					}	
				  
				 $("#evento",$("#formevento")).html(salida);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
				
function fx_alert(tipo,texto)
{
 $("#msg").removeClass().addClass("alert alert-"+tipo).html(texto);
 $('#alert').modal("show");
}

$('#fecha').datepicker({
	format: "yyyy-mm-dd",
    todayBtn: "linked",
    language: "es",
	todayHighlight: true,
    autoclose: true
});
$('#hora').clockpicker({
    donetext: 'Listo'
});