<div class="container">
	<div class="marketing">
		<h2>Sobre o Encontro</h2>
		<p class="marketing-byline"><?php echo $texto->texto; ?></p>

		<?php if( !empty($noticias) ) : ?>
			<div class="row-fluid">
			<?php foreach( $noticias as $noticia ) : ?>
				<div class="span4">
					<a title="<?php echo $noticia->titulo; ?>" href="<?php echo Configuracao::$baseUrl.'noticia/'.$noticia->id.'-'.Funcao::prepararLink($noticia->titulo).Configuracao::$extensaoPadrao; ?>" >
						<img class="marketing-img" src="<?php echo Configuracao::$baseUrl.'noticias/'.$noticia->imagem; ?>">
						<h3><?php echo $noticia->titulo; ?></h3>
						<p><?php echo $noticia->resumo; ?></p>
					</a>
				</div>
			<?php endforeach; ?>
			</div>
		<?php else: ?>
			<div class="row-fluid">
		      <div class="span12">
		        <div class="bs-docs-example bs-docs-example-images">
		        <?php foreach( $expositores as $expositor ) : ?>
		        	<a href="<?php echo $expositor->link; ?>" target="_blank" title="<?php echo $expositor->nome; ?>" >
		          		<img class="img-polaroid" src="<?php echo Configuracao::$baseUrl.'expositores/'.$expositor->imagem; ?>">
		          	</a>
		        <?php endforeach; ?>
		        </div>
		      </div>
		    </div>
		<?php endif; ?>
	</div>
</div>


