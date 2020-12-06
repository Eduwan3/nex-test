$('#add_form').submit('click',function(e){
	e.preventDefault();
	var nombre = $('#nombre').val();
	var orden = $('#orden').val();
	$.ajax({
		type : "POST",
		url  : base_url+'tareas/save',
		dataType : "JSON",
		data : {nombre:nombre, orden:orden},
		success: function(data){
			$('#nombre').val("");
			$('#orden').val("");
			Swal.fire({
			  icon: 'success',
			  title: 'Tarea Guardada!',
			});
			listTareas();
		}
	});
	return false;
});

$( ".delete" ).click(function(e) {
	eliminar(e, this);
});

$( ".tarea" ).click(function(e) {
	e.preventDefault();

	var id = $(this).parent().parent().attr('data-id');
	$('#tareas').attr('data-seleccionado', id);
	$('.row').removeClass('bordeado');
	$(this).parent().parent().addClass('bordeado');
	
});

$( ".subir" ).click(function(e) {
	id_seleccionado = $('#tareas').attr('data-seleccionado');
	subir_elemento(id_seleccionado);
});

$( ".bajar" ).click(function(e) {
	id_seleccionado = $('#tareas').attr('data-seleccionado');
	bajar_elemento(id_seleccionado);
});

function subir_elemento (id_seleccionado){
	$.ajax({
		type : "POST",
		url  : base_url+'tareas/subir_elemento',
		dataType : "JSON",
		data : {id:id_seleccionado},
		success: function(data){
			listTareas(id_seleccionado);
		}
	});
	return false;
}

function bajar_elemento (id_seleccionado){
	$.ajax({
		type : "POST",
		url  : base_url+'tareas/bajar_elemento',
		dataType : "JSON",
		data : {id:id_seleccionado},
		success: function(data){
			listTareas(id_seleccionado);
		}
	});
	return false;
}

function eliminar(e, element) {
	e.preventDefault();
	var id = $(element).parent().parent().attr('data-id');
	console.log(id);
	$.ajax({
		type : "POST",
		url  : base_url+'tareas/delete',
		dataType : "JSON",
		data : {id:id},
		success: function(data){
			// console.log(data);
			Swal.fire({
			  icon: 'success',
			  title: 'Tarea Eliminada!',
			});
			$('#tareas').attr('data-seleccionado', '');
			listTareas();
		}
	});
	return false;
}

function listTareas(id_seleccionado = false){
	$.ajax({
		type  : 'ajax',
		// url   : '<?=base_url("tareas/show");?>',
		url  : base_url+'tareas/show',
		dataType : 'JSON',
		success : function(data){
			var html = '';
			if (data == null){
				$('.flechas').removeClass('d-none');
				html += '<h1 class="text-center">Has eliminado todas las tareas</h1>';
			}else{
				var i;
				for(i=0; i<data.length; i++){
					if (data[i].id == id_seleccionado){
						html += "<div class='row justify-content-center bordeado' data-id='"+data[i].id+"'>";
		    	 		html += 	"<div class='col-6 py-1 text-right'><span class='tarea pointer'>"+data[i].nombre+"</span></div>";
		    	 		html += 	"<div class='col-6 py-1 text-left'><i class='fas fa-trash pointer delete fa-2x'></i></div>";
		    	 		html += "</div>";
					}else{
						html += "<div class='row justify-content-center' data-id='"+data[i].id+"'>";
		    	 		html += 	"<div class='col-6 py-1 text-right'><span class='tarea pointer'>"+data[i].nombre+"</span></div>";
		    	 		html += 	"<div class='col-6 py-1 text-left'><i class='fas fa-trash pointer delete fa-2x'></i></div>";
		    	 		html += "</div>";
		    	 	}
				}
			}
			$('#tareas').html(html);					
			$(".delete").off("click");
			$(".subir").off("click");
			$(".tarea").off("click");
			$(".bajar").off("click");
			$( ".delete" ).click(function(e) {
				eliminar(e, this);
			});
			$( ".subir" ).click(function(e) {
				id_seleccionado = $('#tareas').attr('data-seleccionado');
				subir_elemento(id_seleccionado);
			});
			$( ".bajar" ).click(function(e) {
				id_seleccionado = $('#tareas').attr('data-seleccionado');
				bajar_elemento(id_seleccionado);
			});
			$( ".tarea" ).click(function(e) {
				var id = $(this).parent().parent().attr('data-id');
				$('#tareas').attr('data-seleccionado', id);
				$('.row').removeClass('bordeado');
				$(this).parent().parent().addClass('bordeado');
				
			});
		}

	});
}