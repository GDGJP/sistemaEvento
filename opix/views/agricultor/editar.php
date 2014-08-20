
<style>
	.preview2 img { height: 100px; }
</style>
<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione uma novo tipo de agricultura</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-tipo-formulario" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" value="<?php echo $agricultor->nome; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="telefone" >Telefone</label>
						<div class="controls">
							<input type="text" class="input-large telefone" name="telefone" value="<?php echo $agricultor->telefone; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="cpf" >CPF</label>
						<div class="controls">
							<input type="text" class="input-large cpf" name="cpf" value="<?php echo $agricultor->cpf; ?>" />
						</div>
					</div>

					<?php if( !empty($listaDeTiposDeAgriculturas) ) : ?>
						<div class="control-group">
							<label class="control-label" >Tipos de Agricultura</label>
							<div class="controls form-inline">
								<?php foreach( $listaDeTiposDeAgriculturas as $agricultura ) : ?>
									<label class="checkbox-inline span3">
										<input type="checkbox" name="agriculturas[]" <?php echo (in_array($agricultura->id, $listaTiposAgriculturaAgricultor)) ? 'checked="checked"' : ''; ?> value="<?php echo $agricultura->id; ?>"> <?php echo $agricultura->nome; ?>
									</label>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'agricultor/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>

			<form id="fileupload" action="<?php echo Configuracao::$baseUrl; ?>agricultor/uploadFoto/<?php echo $agricultor->id.'-'.Funcao::prepararLink($agricultor->nome).Configuracao::$extensaoPadrao; ?>" method="POST" enctype="multipart/form-data">
						<!-- Redirect browsers with JavaScript disabled to the origin page -->
						<noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
						<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
						<div class="row fileupload-buttonbar">
							<div class="col-lg-7">
								<!-- The fileinput-button span is used to style the file input field as button -->
								<span class="btn btn-success fileinput-button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Adicionar Arquivos...</span>
									<input type="file" name="files[]" multiple>
								</span>
								<button type="submit" class="btn btn-primary start">
									<i class="glyphicon glyphicon-upload"></i>
									<span>Enviar Aquivos</span>
								</button>
								<button type="reset" class="btn btn-warning cancel">
									<i class="glyphicon glyphicon-ban-circle"></i>
									<span>Cancelar Envio</span>
								</button>
								<button type="button" class="btn btn-danger delete">
									<i class="glyphicon glyphicon-trash"></i>
									<span>Apagar</span>
								</button>
								<input type="checkbox" class="toggle">
								<!-- The global file processing state -->
								<span class="fileupload-process"></span>
							</div>
							<!-- The global progress state -->
							<div class="col-lg-5 fileupload-progress fade">
								<!-- The global progress bar -->
								<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar progress-bar-success" style="width:0%;"></div>
								</div>
								<!-- The extended global progress state -->
								<div class="progress-extended">&nbsp;</div>
							</div>
						</div>
						<!-- The table listing the files available for upload/download -->
						<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
					</form>

					<!-- The blueimp Gallery widget -->
					<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
						<div class="slides"></div>
						<h3 class="title"></h3>
						<a class="prev">‹</a>
						<a class="next">›</a>
						<a class="close">×</a>
						<a class="play-pause"></a>
						<ol class="indicator"></ol>
					</div>
					<!-- The template to display files available for upload -->
					<script id="template-upload" type="text/x-tmpl">
					{% for (var i=0, file; file=o.files[i]; i++) { %}
						<tr class="template-upload fade">
							<td>
								<span class="preview2"></span>
							</td>
							<td>
								<p class="name">{%=file.name%}</p>
								<strong class="error text-danger"></strong>
							</td>
							<td>
								<p class="size">Processing...</p>
								<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
							</td>
							<td>
								{% if (!i && !o.options.autoUpload) { %}
									<button class="btn btn-primary start" disabled>
										<i class="glyphicon glyphicon-upload"></i>
										<span>Start</span>
									</button>
								{% } %}
								{% if (!i) { %}
									<button class="btn btn-warning cancel">
										<i class="glyphicon glyphicon-ban-circle"></i>
										<span>Cancel</span>
									</button>
								{% } %}
							</td>
						</tr>
					{% } %}
					</script>
					<!-- The template to display files available for download -->
					<script id="template-download" type="text/x-tmpl">
					{% for (var i=0, file; file=o.files[i]; i++) { %}
						<tr class="template-download fade">
							<td>
								<span class="preview2">
									{% if (file.thumbnailUrl) { %}
										<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
									{% } %}
								</span>
							</td>
							<td>
								<p class="name">
									{% if (file.url) { %}
										<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
									{% } else { %}
										<span>{%=file.name%}</span>
									{% } %}
								</p>
								{% if (file.error) { %}
									<div><span class="label label-danger">Error</span> {%=file.error%}</div>
								{% } %}
							</td>
							<td>
								<span class="size">{%=o.formatFileSize(file.size)%}</span>
							</td>
							<td>
								{% if (file.deleteUrl) { %}
									<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
										<i class="glyphicon glyphicon-trash"></i>
										<span>Delete</span>
									</button>
									<input type="checkbox" name="delete" value="1" class="toggle">
								{% } else { %}
									<button class="btn btn-warning cancel">
										<i class="glyphicon glyphicon-ban-circle"></i>
										<span>Cancel</span>
									</button>
								{% } %}
							</td>
						</tr>
					{% } %}
					</script>
					<script type="text/javascript">
					document.ready = function() {
						$('#fileupload').fileupload({
				            url: '<?php echo Configuracao::$baseUrl; ?>agricultor/uploadFoto/<?php echo $agricultor->id.'-'.Funcao::prepararLink($agricultor->nome).Configuracao::$extensaoPadrao; ?>',
				            // Enable image resizing, except for Android and Opera,
				            // which actually support image resizing, but fail to
				            // send Blob objects via XHR requests
				            maxFileSize: 5000000,
				            previewThumbnail : true,
				            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
				        });

				        $.getScript("<?php echo Configuracao::$baseUrl; ?>blueimp/js/main.js");
					}
					</script>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
