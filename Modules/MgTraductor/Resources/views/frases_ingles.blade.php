@extends('layouts.app')

@section('guia')
	<li>
		<i class="ace-icon fa fa-child"></i>
		<a href="#">Frases en inglés</a>
	</li>
@stop

@section('content')
    <div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			
			<div class="row">
				<div class="col-xs-12">
					<h3 class="header smaller lighter blue">Lista de frases en inglés</h3>

					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
						@if (Session::has('message'))
							
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="ace-icon fa fa-times"></i>
								</button>
								{{  Session::get('message') }}
								<br />
							</div>
							
						@endif
					</div>
					<div class="table-header">
						<a data-toggle="modal" data-target="#modal_frases_ingles" class="btn btn-success">
							Frase Nueva
						</a>
					</div>

					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Frase</th>
									<th>Total traducciones en español</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>								
								@foreach($frases as $frase)
									<tr>
										<td>
											{{ $frase->id }}
										</td>
										<td>
											{{ $frase->frase }}
										</td>
										<td>
											{{ $frase->total }}
										</td>
										<td>
											<a href="{{ '/mgtraductor/update/' . $frase->id }}" class="btn btn-xs btn-info" title="Editar">
												<i class="ace-icon fa fa-pencil bigger-120"></i>
											</a>		
											
											<a data-toggle="modal" data-target="#modal_delete_frase" data-id="{{ $frase->id }}" class="btn btn-xs btn-danger delete_id" title="Eliminar">
												<i class="ace-icon fa fa-trash-o bigger-120"></i>
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>		

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
@stop

@section('modales')
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
	<!-- Modal Show traducciones en español-->
	<div class="col-md-12">
		<div class="modal fade" id="modal_show_frase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title " id="myModalLabel">Frases en Español</h4>
				<div id="show_list_espanol"></div>
				<button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
			  </div>
			</div>
		  </div>
		</div>
	</div>
	<!-- Modal Delete-->!
	<div class="col-md-12">
		<div class="modal fade" id="modal_delete_frase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title " id="myModalLabel">Eliminar Frase</h4>
			  </div>
			  <form id="form_delete_frase" method="GET" action="{{ url('mgetraductordelete') }}">
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
@stop

@section('script') 

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#form_create_frase').on('submit', function(event){
			event.preventDefault();
			$.ajax({
				url: "{{ url('mgtraductor/save') }}",
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

		$('.delete_id').on('click', function(){
			 id = $( this ).data('id');
			  $('#form_delete_frase').attr('action', '{{ url("mgtraductor/delete") }}/' + id);
		 });
	});

</script>

@stop
