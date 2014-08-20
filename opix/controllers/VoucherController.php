<?php

  set_time_limit(0); 

	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Voucher.php';
	require_once __DIR__.'/../components/dompdf/dompdf_config.inc.php';
	
	class VoucherController extends Controller {
		
		private static $viewController = "voucher";
		

    public static function listarParaImprimir() {

			$voucher = new Voucher();
			$listaDeVouchers = $voucher->listar(" html IS NOT NULL AND html != '' AND usado = 0 ");
			self::$variaveis = array('listaDeVouchers' => $listaDeVouchers);
      self::$topo = '';
      self::$menu = '';
      self::$header = '';
      self::$footer = '';
			self::$corpo = "listarParaImprimir";
			self::renderizar(self::$viewController);
			
		}


		public static function adicionar() {
				
			$voucher = new Voucher();
			
			if(!empty($_POST)) {
			
				if( isset($_POST['quantidade']) && $_POST['quantidade'] > 0 ) {
					for ($i = 0; $i < $_POST['quantidade']; $i++) { 
            
            $template = str_replace(array('[[voucher]]', '[[desconto]]'), array($dados['hash'], $_POST['desconto'].'%'), $_POST['template']);

						$dados = array(
							'hash' => md5($i.date('YmdHisu')),
							'arquivo' => 'Voucher['.md5($i.date('YmdHisu')).'].pdf',
							'fkEvento' => $_POST['fkEvento'],
              'desconto' => $_POST['desconto'],
							'enviado' => 1,
              'html' => $template
              
						);

						$dompdf = new DOMPDF();
						$dompdf->load_html($template);
						$dompdf->set_paper('letter', 'landscape');
						$dompdf->render();
						$output = $dompdf->output();
						file_put_contents(__DIR__.'/../vouchers/'.$dados['arquivo'], $output);

						$vouchers[] = $dados;

						$voucher = new Voucher();
						$voucher->hash = $dados['hash'];
						$voucher->desconto = $dados['desconto'];
						$voucher->arquivo = $dados['arquivo'];
						$voucher->fkEvento = $dados['fkEvento'];
						$voucher->enviado = $dados['enviado'];
						$voucher->html = $template;

//print_r($dados); exit;

						$voucher->salvar();
					}

					if( isset($_POST['quantidade_por_zip']) && $_POST['quantidade_por_zip'] > 0 ) {
						$totalPorZip = $_POST['quantidade_por_zip'];
						$contagem = count($vouchers);
						for( $i=0; $i <= $contagem / $totalPorZip; $i++) {
							$arrayNumeroVoucher = array_slice($vouchers, $i * $totalPorZip, $totalPorZip); 
							$vouchersZip = '';
							foreach($arrayNumeroVoucher as $indice => $voucher) {
								if(!empty($voucher)) {
									$vouchersZip .= ' '.$voucher['arquivo'];
								}
							}
								
							$arquivo = date('YmdHis').'_'.'_vouchers_'.$i.'.zip';
							$zips[] = $arquivo;
							$comando = 'zip -r '.$arquivo.' '.$vouchersZip;
								
							if (!(exec('cd ./vouchers && '.$comando))) {
								echo "Houve um erro ao criar o arquivo vouchers.zip";
								exit;
							}

						}

						$arquivoGeral = 'vouchers_'.date('YmdHis').'.zip';
						if (!(exec('cd ./vouchers && zip -r '.$arquivoGeral.' '.implode(' ', $zips)))) {
							echo "Houve um erro ao criar o arquivo vouchers.zip";
							exit;
						}

						$arquivo = 'vouchers/'.$arquivoGeral;
						header("Content-Type: application/zip");
						header("Content-Length: ".filesize($arquivo));
						header("Content-Disposition: attachment; filename=".basename($arquivo));
						readfile($arquivo);
						exit;

					}

				}
				
				self::redirecionar(Configuracao::$baseUrl.'voucher/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {

			$voucher = new Voucher();
			$listaDeVouchers = $voucher->listar();
			self::$variaveis = array('listaDeVouchers' => $listaDeVouchers);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$voucher = new Voucher();
			$voucher->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				if( !empty($_FILES["Event"]["name"]["imagem"]) ) {
					$imagem = $_FILES["Event"]["name"]["imagem"];
					$imagem = strtolower(str_replace(" ", "-", $_POST['Event']['nome'])).md5(date('YmdHis')).'.'.pathinfo($imagem, PATHINFO_EXTENSION);
					move_uploaded_file($_FILES['Event']['tmp_name']['imagem'], __DIR__.'/../imagens_evento/'.$imagem);
					unlink(__DIR__.'/../imagens_evento/'.$_POST['Event']['imagem_antiga']);
				}
				
				unset($_POST['Event']['imagem_antiga']);
				
				foreach( $_POST['Event'] as $atributo => $valor )
					$evento->$atributo = $valor;
				$evento->imagem = $imagem;

				$idEvento = $evento->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.'evento/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$variaveis = array('voucher' => $voucher);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$voucher = new Voucher();
			$voucher->selecionarPorId($_POST['id']);
			$voucher->excluir();
			
		}

		public static function baixar() {

			$vouchersZip = implode(" ", $_POST['vouchers']);

			$arquivo = date('YmdHis').'_vouchers.zip';
			$comando = 'zip -r '.$arquivo.' '.$vouchersZip;
								
			if (!(exec('cd ./vouchers && '.$comando))) {
				echo "Houve um erro ao criar o arquivo vouchers.zip";
				exit;
			}

			$arquivo = 'vouchers/'.$arquivo;
			header("Content-Type: application/zip");
			header("Content-Length: ".filesize($arquivo));
			header("Content-Disposition: attachment; filename=".basename($arquivo));
			readfile($arquivo);
			exit;

		}
		
	}
