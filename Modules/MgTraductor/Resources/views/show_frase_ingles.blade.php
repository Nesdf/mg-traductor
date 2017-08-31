@extends('layouts.app')

@section('guia')
	<li>
		<i class="ace-icon fa fa-comment-o"></i>
		<a href="{{ url('mgtraductor/frases-ingles') }}">Frases en inglés</a>
	</li>
	<li>
		<i class="ace-icon fa fa-comments-o"></i>
		<a href="#">Frases en espanol</a>
	</li>
@stop

@section('content')
    <div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			
			<div class="row">
				<div class="col-xs-12">
					<h3 class="header smaller lighter blue">Frases en Español</h3>

					<h4> Frase en inglés</h4>
					<div class="alert alert-success"> 
						{{ $fraseEnIngles->frase }} &nbsp; &nbsp; &nbsp; 
						<a data-id="{{ $fraseEnIngles->id }}" data-toggle="modal" data-target="#modal_update_frases_ingles" class="btn btn-xs btn-info update_ingles_id" title="Editar">
							<i class="ace-icon fa fa-pencil bigger-120"></i>
						</a>		
						&nbsp;
						<a data-toggle="modal" data-target="#modal_delete_frase_ingles" data-id="{{ $fraseEnIngles->id }}" class="btn btn-xs btn-danger" title="Eliminar">
							<i class="ace-icon fa fa-trash-o bigger-120"></i>
						</a>
					</div>

					<h4> Traducción en español &nbsp; &nbsp; <a class="texto-link" data-toggle="modal" data-target="#modal_add_frases_espanol" >[+] Agregar frase en español</a></h4> 
					<ul class="list-group">
						@foreach( $frasesEnEspanol as $fraseEspanol )
							<li class="list-group-item list-group-item-info"> {{ $fraseEspanol->frase }} 	
								&nbsp;
								<a data-id="{{ $fraseEspanol->id }}" data-toggle="modal" data-target="#modal_update_frases_espanol" class="btn btn-xs btn-info update_id" title="Editar">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</a>		
								&nbsp;
								<a data-toggle="modal" data-target="#modal_delete_frase_espanol" data-id="{{ $fraseEspanol->id }}" class="btn btn-xs btn-danger delete_id" title="Eliminar">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
								</a>
							</li>
						@endforeach
					</ul>

				</div>
			</div>	
			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
@stop

@section('modales')

	<!-- Modal Agregar frase en español-->
	<div class="col-md-12">
		<div class="modal fade" id="modal_add_frases_espanol" data-name="modal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
				<h4 class="modal-title" id="t_header">Frase nueva</h4>
				<div id="error_create_frase"></div>
			  </div>
			  <form role="form" id="form_create_frase_espanol">
				  <div class="modal-body">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{ $fraseEnIngles->id  }}">
						<div class="form-group">
							<label for="frase_ingles">Frase en Español</label>
							<input type="text" class="form-control" id="frase_ingles" name="frase_espanol" placeholder="Frase en espanol">
						</div>				
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				  </div>
			  </form>
			</div>
		  </div>
		</div>
	</div>

	<!-- Modal Crear-->
	<div class="col-md-12">
		<div class="modal fade" id="modal_frases_ingles" data-name="modal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
				<h4 class="modal-title" id="t_header">Frase nueva</h4>
				<div id="error_create_frase"></div>
			  </div>
			  <form role="form" id="form_create_frase">
			  <div class="modal-body">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="frase_ingles">Frase en Inglés</label>
						<input type="text" class="form-control" id="frase_ingles" name="frase_ingles" placeholder="Frase en inglés">
					</div>				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>
	</div>

	<!-- Modal Update Frase en inglés-->
	<div class="col-md-12">
		<div class="modal fade" id="modal_update_frases_ingles" data-name="modal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
				<h4 class="modal-title" id="t_header">Modificar Frase</h4>
				<div id="error_create_frase"></div>
			  </div>
			  <form role="form" id="form_update_frase_ingles">
			  <div class="modal-body">
					{{ csrf_field() }}
					<input type="hidden" id="id_frase_ingles" name="id">
					<div class="form-group">
						<label for="frase_ingles">Frase en Inglés</label>
						<input type="text" class="form-control" id="frase_ingles_update" name="frase_ingles" placeholder="Frase en inglés">
					</div>				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>
	</div>

	<!-- Modal Update Frase en español-->
	<div class="col-md-12">
		<div class="modal fade" id="modal_update_frases_espanol" data-name="modal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
				<h4 class="modal-title" id="t_header">Modificar Frase</h4>
				<div id="error_update_frase"></div>
			  </div>
			  <form role="form" id="form_update_frase_espanol">
			  <div class="modal-body">
					{{ csrf_field() }}
					<input type="hidden" id="id_update" name="id">
					<input type="hidden" id="id_frase_espanol" name="frase_espanol_id">
					<div class="form-group">
						<label for="frase_ingles">Traducción en Español</label>
						<input type="text" class="form-control" id="frase_espanol_update" name="frase_espanol" placeholder="Traducción en español">
					</div>				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>
	</div>

	<!-- Modal Delete Frase en inglés-->
	<div class="col-md-12">
		<div class="modal fade" id="modal_delete_frase_ingles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title " id="myModalLabel">Eliminar Frase</h4>
			  </div>
			  <form id="form_delete_frase_ingles" method="GET" action="{{ url('mgtraductor/delete') }}/{{ $fraseEnIngles->id  }}">
				  <img src="{{ asset('assets/dashboard/images/error/peligro.png') }}">
				  {{ csrf_field() }}
				  <div id="inputs"></div>
				  <label style="color:red">Al eliminar la frase también se eliminan tods sus traducciones</label>
				  <label>¿Realmente deseas eliminarla?</label>
				  <div class="modal-footer">
					<button type="submit" class="btn btn-danger">Eliminar</button>
				  </div>
			  </form>
			</div>
		  </div>
		</div>
	</div>

	<!-- Modal Delete Frase en español-->
	<div class="col-md-12">
		<div class="modal fade" id="modal_delete_frase_espanol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title " id="myModalLabel">Eliminar Frase</h4>
			  </div>
			  <form  role="form" id="form_delete_frase_espanol" action="#">
				  <img src="{{ asset('assets/dashboard/images/error/peligro.png') }}">
				  {{ csrf_field() }}
				  <div id="inputs"></div>
				  <label>¿Realmente deseas eliminarla?</label>
				  <div class="modal-footer">
					<button type="submit" class="btn btn-danger">Eliminar</button>
				  </div>
			  </form>
			</div>
		  </div>
		</div>
	</div>
@stop

@section('script') 

<script type="text/javascript">
	
	$(document).ready(function(){
		/* Agregar traducción en español */
		$('#form_create_frase_espanol').on('submit', function(event){	
			event.preventDefault();
			$.ajax({
				url: "{{ url('mgtraductor/save_traduccion_espanol') }}",
				type: "POST",
				data: $( this ).serialize(),
				success: function( data ){
					if(data.msg == 'success'){
						window.location.reload(true);
					}
				},
				error: function(error){
					var err = "";
					for(var i in error.responseJSON.msg){
						err += error.responseJSON.msg[i] + "<br>";														
					}
					$('#error_create_frase').html('<div class="alert alert-danger">' + err + '</div>');
				}
			});
		});

		/* Mostrar dato en ventana modal de frases en inglés */
		$('.update_ingles_id').on('click', function(){
			 id = $( this ).data('id');			 
			$.ajax({
				url: "{{ url('mgtraductor/edit_frase_ingles') }}" + "/" + id,
				type: "GET",
				success: function( data ){
					$('#id_frase_ingles').val(id);
					$('#frase_ingles_update').val(data.frase);
				}
			});
		 });
		/* Modificar frase en inglés*/
		$('#form_update_frase_ingles').on('submit', function(event){
			event.preventDefault();
			$.ajax({
				url: "{{ url('mgtraductor/update_frase_ingles') }}",
				type: "POST",
				data: $( this ).serialize(),
				success: function( data ){
					if(data.msg == 'success'){
						window.location.reload(true);
					}
				},
				error: function(error){
					var err = "";
					for(var i in error.responseJSON.msg){
						err += error.responseJSON.msg[i] + "<br>";														
					}
					$('#error_create_frase').html('<div class="alert alert-danger">' + err + '</div>');
				}
			});
		 });

		/* Modificar frase en español*/
		$('#form_update_frase_espanol').on('submit', function(event){
			event.preventDefault();
			$.ajax({
				url: "{{ url('mgtraductor/update_frase_espanol') }}",
				type: "POST",
				data: $( this ).serialize(),
				success: function( data ){
					if(data.msg == 'success'){
						window.location.reload(true);
					}
				},
				error: function(error){
					var err = "";
					for(var i in error.responseJSON.msg){
						err += error.responseJSON.msg[i] + "<br>";														
					}
					$('#error_update_frase').html('<div class="alert alert-danger">' + err + '</div>');
				}
			});
		 });

		/* Editar frase en español */
		$('.update_id').on('click', function(){
			 id = $( this ).data('id');				
			$.ajax({
				url: "{{ url('mgtraductor/edit_frase_espanol') }}" + "/" + id,
				type: "GET",
				success: function( data ){
					$('#id_update').val(data.id);
					$('#id_frase_espanol').val(data.frase_ingles_id);
					$('#frase_espanol_update').val(data.frase);
				}
			});
		 });

		/* Delete Palabara en inglés */

		$('#form_delete_frase_ingles').on('submit', function(event){
			event.preventDefault();
			$.ajax({
				url: "{{ url('mgtraductor/delete') }}/"+ " {{ $fraseEnIngles->id  }} ",
				type: "GET",
				success: function( data ){
					if(data.msg == 'success'){
						location.href="http://www.neomai.com.mx";
					}
				},
				error: function(error){
					var err = "";
					for(var i in error.responseJSON.msg){
						err += error.responseJSON.msg[i] + "<br>";														
					}
					$('#error_create_frase').html('<div class="alert alert-danger">' + err + '</div>');
				}
			});
		});

		/* Delete palabras en español */

		$('.delete_id').on('click', function(){
			id = $( this ).data('id');
			$('#form_delete_frase_espanol').attr('action', '{{ url("mgtraductor/delete_frase_espanol") }}/' + id);
		 });
	});


</script>

@stop
