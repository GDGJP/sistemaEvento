<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Foto.php';
	
	class FotoController extends Controller {
		
		public static function excluir(){
		
			$foto = new Foto();
			$foto->selecionarPorId($_POST['id']);
			$foto->excluir();
		
		}
		
	}
