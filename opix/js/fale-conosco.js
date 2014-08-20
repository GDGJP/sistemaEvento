function muda(valor,campo,texto){
	if (valor == ""){
		document.getElementById(campo).value = texto; 
	}
}

function validaPF() {
	if (vazio(document.contato.nome.value)){
		alert("Preencha o campo Nome.");
		document.contato.nome.focus();
	return false;}
	if (vazio(document.contato.cpf.value)){
		alert("Preencha o campo CPF.");
		document.contato.cpf.focus();
	return false;}
	if (vazio(document.contato.sexo.value)){
		alert("Preencha o campo Sexo.");
		document.contato.sexo.focus();
	return false;}
	if (vazio(document.contato.cep.value)){
		alert("Preencha o campo CEP.");
		document.contato.cep.focus();
	return false;}
	if (vazio(document.contato.endereco.value)){
		alert("Preencha o campo Logradouro.");
		document.contato.endereco.focus();
	return false;}
	if (vazio(document.contato.numRes.value)){
		alert("Preencha o Numero da Residencia.");
		document.contato.numRes.focus();
	return false;}
	if (vazio(document.contato.bairro.value)){
		alert("Preencha o campo Bairro.");
		document.contato.bairro.focus();
	return false;}
	if (vazio(document.contato.cidade.value)){
		alert("Preencha o campo Cidade.");
		document.contato.cidade.focus();
	return false;}
	if (vazio(document.contato.estado.value)){
		alert("Preencha o campo Estado.");
		document.contato.estado.focus();
	return false;}
	if (vazio(document.contato.telefone1.value)){
		alert("Preencha o campo Telefone.");
		document.contato.telefone1.focus();
	return false;}
	if (vazio(document.contato.email1.value)){ 
		alert("Preencha o campo E-mail.");
		document.contato.email1.focus();
	return false;}
if (vazio(document.contato.login.value)){ 
		alert("Preencha o campo Login.");
		document.contato.login.focus();
	return false;}
	if (vazio(document.contato.senha.value)){ 
		alert("Digite uma senha.");
		document.contato.senha.focus();
	return false;}

	
}

function validaPJ() {
	if (vazio(document.contato.razaoSocial.value)){
		alert("Preencha o campo Razao Social.");
		document.contato.razaoSocial.focus();
	return false;}
	if (vazio(document.contato.nomeFantasia.value)){
		alert("Preencha o campo Nome Fantasia.");
		document.contato.nomeFantasia.focus();
	return false;}
	if (vazio(document.contato.cnpj.value)){
		alert("Preencha o campo CNPJ.");
		document.contato.cnpj.focus();
	return false;}
	if (vazio(document.contato.opcao_pjuridica.value)){
		alert("Marque a opção da Peswsoa Jurídica.");
		document.contato.opcao_pjuridica.focus();
	return false;}
	if (vazio(document.contato.data_2_2.value)){
		alert("Preencha a data de Abertura Corretamente.");
		document.contato.data_2_2.focus();
	return false;}
	if (vazio(document.contato.data_2_1.value)){
		alert("Preencha a data de Abertura Corretamente.");
		document.contato.data_2_1.focus();
	return false;}
	if (vazio(document.contato.data_2_3.value)){
		alert("Preencha a data de Abertura Corretamente.");
		document.contato.data_2_3.focus();
	return false;}
	
	if (vazio(document.contato.cep.value)){
		alert("Preencha o campo CEP.");
		document.contato.cep.focus();
	return false;}
	if (vazio(document.contato.endereco.value)){
		alert("Preencha o campo Logradouro.");
		document.contato.endereco.focus();
	return false;}
	if (vazio(document.contato.numRes.value)){
		alert("Preencha o Numero da Residencia.");
		document.contato.numRes.focus();
	return false;}
	if (vazio(document.contato.bairro.value)){
		alert("Preencha o campo Bairro.");
		document.contato.bairro.focus();
	return false;}
	if (vazio(document.contato.cidade.value)){
		alert("Preencha o campo Cidade.");
		document.contato.cidade.focus();
	return false;}
	if (vazio(document.contato.estado.value)){
		alert("Preencha o campo Estado.");
		document.contato.estado.focus();
	return false;}
	if (vazio(document.contato.cepCobranca.value)){
		alert("Preencha o campo CEP.");
		document.contato.cepCobranca.focus();
	return false;}
	if (vazio(document.contato.enderecoCobranca.value)){
		alert("Preencha o campo Logradouro.");
		document.contato.enderecoCobranca.focus();
	return false;}
	if (vazio(document.contato.numResCobranca.value)){
		alert("Preencha o Numero da Residencia.");
		document.contato.numResCobranca.focus();
	return false;}
	if (vazio(document.contato.bairroCobranca.value)){
		alert("Preencha o campo Bairro.");
		document.contato.bairroCobranca.focus();
	return false;}
	if (vazio(document.contato.cidadeCobranca.value)){
		alert("Preencha o campo Cidade.");
		document.contato.cidadeCobranca.focus();
	return false;}
	if (vazio(document.contato.estadoCobranca.value)){
		alert("Preencha o campo Estado.");
		document.contato.estadoCobranca.focus();
	return false;}
	if (vazio(document.contato.telefone4.value)){
		alert("Preencha o campo Telefone da Empresa");
		document.contato.telefone4.focus();
	return false;}
	if (vazio(document.contato.nomeRepresentante.value)){
		alert("Informe o Nome do Representante Legal");
		document.contato.nomeRepresentante.focus();
	return false;}
		if (vazio(document.contato.cpfRepresentante.value)){
		alert("Informe o cpf do Representante Legal");
		document.contato.cpfRepresentante.focus();
	return false;}
	if (vazio(document.contato.rgRepresentante.value)){
		alert("Informe o rg do Representante Legal");
		document.contato.rgRepresentante.focus();
	return false;}
	if (vazio(document.contato.emailRepresentante1.value)){
		alert("Informe o email do Representante Legal");
		document.contato.emailRepresentante1.focus();
	return false;}
	if (vazio(document.contato.telefone1.value)){
		alert("Informe o telefone do Representante Legal");
		document.contato.telefone1.focus();
	return false;}
	if (vazio(document.contato.nomeProcurador.value)){
		alert("Informe o Nome do Procurador");
		document.contato.nomeProcurador.focus();
	return false;}
		if (vazio(document.contato.cpfProcurador.value)){
		alert("Informe o cpf do Procurador ");
		document.contato.cpfProcurador.focus();
	return false;}
	if (vazio(document.contato.rgProcurador.value)){
		alert("Informe o rg do Procurador ");
		document.contato.rgProcurador.focus();
	return false;}
	if (vazio(document.contato.emailProcurador.value)){
		alert("Informe o email do Procurador ");
		document.contato.emailProcurador.focus();
	return false;}
	if (vazio(document.contato.telefoneProcurador.value)){
		alert("Informe o telefone do Procurador ");
		document.contato.telefoneProcurador.focus();
	return false;}
	if (vazio(document.contato.login.value)){ 
		alert("Preencha o campo Login.");
		document.contato.login.focus();
	return false;}
	if (vazio(document.contato.senha.value)){ 
		alert("Digite uma senha.");
		document.contato.senha.focus();
	return false;}

	
}
function validaPLN() {
	if (vazio(document.contato.nome.value)){
		alert("Preencha o campo Nome.");
		document.contato.nome.focus();
	return false;}
	if (vazio(document.contato.tipo.value)){
		alert("Preencha o campo Tipo.");
		document.contato.tipo.focus();
	return false;}
	if (vazio(document.contato.descricao.value)){
		alert("Preencha o campo Descricao.");
		document.contato.descricao.focus();
	return false;}
	if (vazio(document.contato.periodicidade.value)){
		alert("Preencha o campo Periodicidade.");
		document.contato.periodicidade.focus();
	return false;}
	if (vazio(document.contato.quantidade.value)){
		alert("Preencha o campo Quantidade.");
		document.contato.quantidade.focus();
	return false;}
	if (vazio(document.contato.valorunitario.value)){
		alert("Preencha o campo Valor Unitario.");
		document.contato.valorunitario.focus();
	return false;}
	if (vazio(document.contato.formapagamento.value)){
		alert("Preencha o campo Forma de Pagamento.");
		document.contato.formapagamento.focus();
	return false;}
	
}

function validaUSU() {
	if (vazio(document.contato.nome.value)){
		alert("Preencha o campo Nome.");
		document.contato.nome.focus();
	return false;}
	if (vazio(document.contato.email.value)){ 
		alert("Preencha o campo E-mail.");
		document.contato.email.focus();
	return false;}
	if (!isEmail(document.contato.email.value)){
		alert("Endere�o de E-mail inv�lido.");
		document.contato.email.focus();
	return false;}
	if (vazio(document.contato.tipo.value)){
		alert("Preencha o campo Tipo.");
		document.contato.tipo.focus();
	return false;}
	if (vazio(document.contato.setor.value)){
		alert("Preencha o campo Setor.");
		document.contato.setor.focus();
	return false;}
	if (vazio(document.contato.login.value)){ 
		alert("Preencha o campo Login.");
		document.contato.login.focus();
	return false;}
	if (vazio(document.contato.senha.value)){ 
		alert("Digite uma senha.");
		document.contato.senha.focus();
	return false;}
	if (vazio(document.contato.outrasenha.value)){ 
		alert("Por Favor Repita sua Senha.");
		document.contato.outrasenha.focus();
	return false;}
	
	var senha = document.contato.senha.value;
	var outrasenha = document.contato.outrasenha.value; 
	if (senha != outrasenha){ 
		alert("As senhas não são iguais");
		document.contato.outrasenha.focus();
	return false;}

	
}	




function validaBO() {
	if (vazio(document.contato.nomeAssoc.value)){
		alert("Preencha o campo Nome do Sacado.");
		document.contato.nomeAssoc.focus();
	return false;}
	
	if (vazio(document.contato.cep.value)){
		alert("Preencha o campo cep.");
		document.contato.cep.focus();
	return false;}
	if (vazio(document.contato.endereco.value)){
		alert("Preencha o campo endereco.");
		document.contato.endereco.focus();
	return false;}
	if (vazio(document.contato.numRes.value)){ 
		alert("Preencha o campo Número.");
		document.contato.numRes.focus();
	return false;}
	if (vazio(document.contato.bairro.value)){ 
		alert("Digite uma bairro.");
		document.contato.bairro.focus();
	return false;}
	if (vazio(document.contato.cidade.value)){ 
		alert("Preencha o campo Cidade.");
		document.contato.cidade.focus();
	return false;}
	if (vazio(document.contato.estado.value)){ 
		alert("Preencha o campo Estado.");
		document.contato.estado.focus();
	return false;}
	if (vazio(document.contato.email.value)){ 
		alert("Preencha o campo E-mail.");
		document.contato.email.focus();
	return false;}
	if (!isEmail(document.contato.email.value)){
		alert("Endere�o de E-mail inv�lido.");
		document.contato.email.focus();
	return false;}
	if (vazio(document.contato.data_2_2.value)){ 
		alert("Preencha da Data de Vencimeto.");
		document.contato.data_2_2.focus();
	return false;}
	if (vazio(document.contato.data_2_1.value)){ 
		alert("Preencha da Data de Vencimeto.");
		document.contato.data_2_1.focus();
	return false;}
	if (vazio(document.contato.data_2_3.value)){ 
		alert("Preencha da Data de Vencimeto.");
		document.contato.data_2_3.focus();
	return false;}

	if (vazio(document.contato.valor.value)){ 
		alert("Preencha o campo Valor.");
		document.contato.valor.focus();
	return false;}
	
	
}	
  
function isEmail(str){
	return ((str != "") && (str.indexOf("@") != -1) && (str.indexOf(".") != -1));
}	 


function vazio(str){
	wd = str.length;
	cont = 0;
	for (x=0; x<wd; x++){
		if (str.substring(x,x+1) == " ") { ++ cont; }
	}
	return ((cont == wd) || (str == ""));
}