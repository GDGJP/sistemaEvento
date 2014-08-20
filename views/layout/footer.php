		<?php
		    require_once __DIR__.'/../../opix/models/Apoio.php';
		    $apoio = new Apoio();
		    $apoios = $apoio->listar(null, 'RAND()');
		?>
		<!-- APOIO AO EVENTO -->
		<div class="container">
		  <h3>Apoia o Encontro</h3>
		  <div id="wrapper">
		      <div class="bg-client">
		          <div class="container">
		              <div class="row marg50">
		                  <div class="col-lg-12">
		                      <div style="max-width: 1140px; margin: 0px auto; float: left;" class="bx-wrapper">
                                <div style="width: 100%; overflow: hidden; position: relative; height: 100px;" class="bx-viewport">
                                    <div style="width: 1215%; position: relative; transition-duration: 0s; transform: translate3d(-1410px, 0px, 0px);" class="slider4">
                                    <?php foreach( $apoios as $apoio ) : ?>
                                        <div style="float: left; list-style: none outside none; position: relative; width: 200px; margin-right: 35px;" class="slide">
                                            <img src="<?php echo Configuracao::$baseUrl.'apoios/'.$apoio->imagem; ?>">
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
		                      </div>
		                  </div>
		              </div>
		          </div>
		      </div>
		  </div><!-- wrapper -->
		</div><!-- container -->

  <!-- Footer
  ================================================== -->
  <footer class="footer">
    <div class="container">
      <p>Inclusão Digital um Desafio do Tamanho do Brasil - <a href="http://www.anid.com.br" target="_blank">ANID</a>.</p>
      <p>© 2014 <a href="http://www.anid.com.br" target="_blank">Associação Nacional pra Inclusão Digital</a>.</p>
    </div>
  </footer>


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?php echo Configuracao::$baseUrl; ?>arquivos/widgets.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/jquery.js"></script>
    <script type="text/javascript" src="<?php echo Configuracao::$baseUrl; ?>banners/jquery_007.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-transition.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-alert.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-modal.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-dropdown.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-scrollspy.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-tab.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-tooltip.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-popover.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-button.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-collapse.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-carousel.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-typeahead.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/bootstrap-affix.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/holder.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/prettify.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/application.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/jquery.maskedinput.min.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/jasny-bootstrap.min.js"></script>
    <script src="<?php echo Configuracao::$baseUrl; ?>arquivos/str_pad.js"></script>

<!-- Script banners apoio -->
     <script type="text/javascript">
    $(document).ready(function(){
      $('.slider4').bxSlider({
        slideWidth: 200,
        minSlides: 1,
        maxSlides: 5,
        moveSlides: 1,
        slideMargin: 35,
        auto: false,
        pause: 4000,
        speed: 1000,
        controls:false,
        pager:false
      });
    });
    </script>
<!-- end Script banners apoio -->

</html>