@extends('layouts.app')

@section('guia')
	<li>
		<i class="ace-icon fa fa-child"></i>
		<a href="#">Traducción al Español</a>
	</li>
@stop

@section('content')
    <div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			
			<div class="row">
				<div class="col-xs-12">
					<h3 class="header smaller lighter blue">Traducción al Español &nbsp; &nbsp; <a href="{{url('mgtraductor')}}" class="label label-info" href="">Limpiar texto</a></h3>
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
					<div class="table-header"></div>
					<form role="form" id="form_traductor">
						{{ csrf_field() }}
						<textarea name="texto_ingles" id="texto1" rows="15"></textarea>	<br>					
						<button type="submit" class="btn btn-primary">Click para traducir </button>
					</form>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<!-- Agregar wygwys  --><br><br>
						<div id="texto_traducido"></div>
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
				<div id="error_create_personal"></div>
			  </div>
			  <form role="form" id="form_create_cliente">
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
@stop

@section('script')
	<script type="text/javascript">

		$(document).on('ready', function(){

	  	tinymce.init({ 
	  		selector:'textarea#texto1',
	  		setup: function (editor) {
		        editor.on('change', function () {
		            editor.save();
		        });
		    }
	  	});


			$('#form_traductor').on('submit', function(event){
				event.preventDefault();
				$.ajax({
					url: "{{ url('mgtraductor/list_traduccion') }}",
					type: "POST",
					data: $( this ).serialize(),
					success: function( data ){
						
						
						$('#texto_traducido').html('<div class="label label-success"> Click sobre la frase subrayadas para mostrar las traducciones en el idioma español. </div><br><br><div>'+data['texto']+'</div>');	
						/*tinymce.init({ 
							selector:'textarea#texto2',
							setup: function (editor) {
						        editor.on('change', function () {
						            editor.save();
						        });
						    }
			     		});*/
						// Permite mostrar boto de traducción
						$('span').on('click', function(){
			            	console.log($(this).attr('id'));
			            	$('#'+$(this).attr('id')).popover({
			            		html: true,
			            	});
			            });				
					}					
				});
			});
				//Permite
            //CKEDITOR.replace( 'editor1' );

		});		
	</script>
@stop
