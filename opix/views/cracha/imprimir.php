<html>
<head>
	<meta charset="UTF-8">
	<style>
		#layoutAdesivo { width: 280px; height: 145px; border:1px solid #000; }
		#layoutAdesivo > img { float: left; height: 145px; margin: 0 10px 0 0; width: 110px; }
		#layoutAdesivo span { font-family: Helvetica, Arial, Ubuntu; }
		#layoutAdesivo span h4 { text-transform: capitalize; height:60px; margin: 10px 0 0 0; }
		#layoutAdesivo span small { text-transform: uppercase; }
		#layoutAdesivo span img {height: 39px; margin: -23px auto; width: 156px;}
		#layoutAdesivo div { background-color: #000000; color: #FFFFFF; float: left; font-size: 24px; font-weight: bolder; height: 28px; margin: 26px -10px; width: 170px; text-align: center; line-height: 30px; }
	</style>
</head>
<div id="layoutAdesivo">
<img src="<?php echo Configuracao::$baseUrl . '../fotosParticipantes/' . $cracha->foto; ?>" />
<span>
	<h4><?php echo mb_strtolower($cracha->nome, 'UTF-8'); ?></h4>
	<img src="data:image/png;base64,<?php echo base64_encode($codigoDeBarras); ?>" />
	<div>
		<small><?php echo $cracha->funcao; ?></small><br />
	</div>
</span>
</div>
