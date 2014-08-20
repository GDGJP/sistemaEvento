<?php
require_once __DIR__.'/Model.php';
	
class Traducao extends Model {
	
	public $id;
	public $fkItemTraducao;
	public $valor;
	public $lang;
	protected $conexao;
	protected static $tabela = "traducao";
	
	public function Traducao() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	public function excluir() {
		parent::excluir($this);
	}
	
	public function listar($condicao = '') {
		return parent::listar($this, $condicao);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}

  public function gerarStringArquivo($lang) {
    $stringRetorno  = '<?php ';
    $stringRetorno .= '$lang = array(';    
    $array = self::listar(" lang='".$lang."'");
    foreach ($array as $key=>$a) {
      $item = new ItemTraducao();
      $item->selecionarPorId($a->fkItemTraducao);
      $itemTraducao   =  
      $stringRetorno .= '"'.$item->nome.'"=>"'.$a->valor.'"';
      $stringRetorno .= ',';
    }
    $stringRetorno  = substr($stringRetorno, 0, -1);
    $stringRetorno .= '); ';
    $stringRetorno .= 'return $lang;';
    $stringRetorno .= '?>';

    return $stringRetorno;

  }
  public function criarArquivo($content,$lang) {
    $file = __DIR__."/../../lang/lang_".$lang.".php";
    $handle = fopen($file, "w+");
    fwrite($handle, $content);

    return $handle;
  }
   

}
