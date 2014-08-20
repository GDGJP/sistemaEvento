<style>
		#fotoCracha span {
			margin: 10px 0 10px 10px !important;
			clear: both;
			float: left;
		}

		#preview-pane {
			display: none;
			position: absolute;
			z-index: 2000;
			margin: 2% 0 0 45%;
			padding: 6px;
			border: 1px rgba(0,0,0,.4) solid;
			background-color: white;

			-webkit-border-radius: 6px;
			-moz-border-radius: 6px;
			border-radius: 6px;

			-webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
			-moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
			box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
		}

		#preview-pane .preview-container {
			width: 300px;
			height: 400px;
			overflow: hidden;
		}
</style>
<script>
	document.ready = function() {

		var file = new FileReader(); 
		var jcrop_api;
		var boundx;
		var boundy;

		var xsize = $('#preview-pane .preview-container').width();
		var ysize = $('#preview-pane .preview-container').height();

		var cropFoiUsado = false;
		
		/**
		 * Funcão que alimenta os inputs tipo "hidden" que mostra as coordenadas do Crop
		 */
		function salvarCoordenadas( coordenadas ) {
			cropFoiUsado = typeof coordenadas == 'object';

			if (parseInt(coordenadas.w) > 0) {
				var rx = xsize / coordenadas.w;
				var ry = ysize / coordenadas.h;

				$('#preview-pane .preview-container img').css({
					width: Math.round(rx * jcrop_api.getBounds()[0]) + 'px',
					height: Math.round(ry * jcrop_api.getBounds()[1]) + 'px',
					marginLeft: '-' + Math.round(rx * coordenadas.x) + 'px',
					marginTop: '-' + Math.round(ry * coordenadas.y) + 'px'
				});

				$("input[name=foto_x]").val(coordenadas.x).change();
				$("input[name=foto_y]").val(coordenadas.y).change();
				$("input[name=foto_w]").val(coordenadas.w).change();
				$("input[name=foto_h]").val(coordenadas.h).change();

			}
			
		}

/*		$('input[type=hidden][name^=foto]').change(function(){
				$('input[type=submit]').attr('disabled', 'disabled');

				if( typeof contador != 'undefined' ) {
					window.clearTimeout(contador);
				}

				contador = window.setTimeout(function(){
					$('input[type=submit]').attr('disabled', false);
				}, 2000);
		});*/
		
		file.onload = function( event ){
			$('img#alvoFoto').closest('form').submit(function(){

				if( !cropFoiUsado ) {

					alert('Por favor, selecione a área a ser recortada da imagem...');
					return false;

				} else {
				
					return true;

				}

			});

			if( typeof jcrop_api != 'undefined' ) {
				jcrop_api.setImage(event.target.result); 
				$('img#alvoFotoPreview').attr('src', event.target.result);
			} else {
			
				$('img#alvoFoto').attr('src', event.target.result);
				$('img#alvoFoto').css('width', 'auto').css('height', 'auto');
				$('img#alvoFotoPreview').attr('src', event.target.result);
			
				setTimeout(function(){ 
					$('img#alvoFoto').Jcrop({
						aspectRatio : xsize / ysize,
						onChange: salvarCoordenadas,
						onSelect: salvarCoordenadas,
						maxWidth: 300,
						maxHeight: 400,
						boxWidth:450
					}, function() {
						$('#alvo').show();
						$("#preview-pane").show();
						jcrop_api = this;
						//$('#preview-pane').appendTo(jcrop_api.ui.holder);
					})
				}, 1000);

			}
		}
		
		$("input[type=file]").change(function(){
			var image = $(this)[0]['files'][0];
			if( image['type'] == 'image/jpeg' || image['type'] == 'image/png' || image['type'] == 'image/gif' ){
				file.readAsDataURL(image);
			}
		});
	};
</script>
<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Atualize o crachá</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-formulario" class="form-horizontal categoriaForm" enctype="multipart/form-data">
				<input type="hidden" name="idParticipante" value="<?php echo $cracha->fk_participante; ?>" />
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome Para Crachá</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" id="nome" value="<?php echo $cracha->nome; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="funcao" >Função</label>
						<div class="controls">
							<select name="funcao">
								<option value="participante" <?php echo ($cracha->funcao == 'participante') ? 'selected="selected"' : ''; ?> >Participante</option>
								<option value="staff" <?php echo ($cracha->funcao == 'staff') ? 'selected="selected"' : ''; ?> >Staff</option>
								<option value="imprensa" <?php echo ($cracha->funcao == 'imprensa') ? 'selected="selected"' : ''; ?> >Imprensa</option>
								<option value="painelista" <?php echo ($cracha->funcao == 'painelista') ? 'selected="selected"' : ''; ?> >Painelista</option>
								<option value="expositor" <?php echo ($cracha->funcao == 'expositor') ? 'selected="selected"' : ''; ?> >Expositor</option>
								<option value="organizacao" <?php echo ($cracha->funcao == 'organizacao') ? 'selected="selected"' : ''; ?> >Organização</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="foto">Foto Para Crachá</label>
						<div class="controls" id="fotoCracha">
							<span>
								<input type="file" name="foto_cracha" />
								<input type="hidden" name="foto_x" />
								<input type="hidden" name="foto_y" />
								<input type="hidden" name="foto_w" />
								<input type="hidden" name="foto_h" />
							</span>
							<span id="alvo" >
								<img id="alvoFoto" <?php echo (!empty($cracha->foto)) ? "src='".Configuracao::$baseUrl."../fotosParticipantes/".$cracha->foto."'" : ""; ?> />
							</span>
							<div id="preview-pane" >
								<div class="preview-container">
									<img class="jcrop-preview" id="alvoFotoPreview" alt="Preview" />
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'cracha/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 -->
