<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione um novo evento</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-evento" class="form-horizontal eventoForm" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[nome]" id="nome" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">Imagem</label>
						<div class="controls">
							<input type="file" class="input-large" name="Event[imagem]" id="imagem" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="dataInicio" >Data de Início</label>
						<div class="controls">
							<input type="text" class="input-large dataMinima" name="Event[dataInicio]" id="dataInicio" rel="evento" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="dataFim" >Data de Término</label>
						<div class="controls">
							<input type="text" class="input-large dataMaxima" name="Event[dataFim]" id="dataFim" rel="evento" />
						</div>
					</div>
					<div class="control-group">
						<h4>Ingressos
							<small>(Pelo menos um tipo de ingresso deve ser criado para que seu evento possa ser publicado)</small>
						</h4>
						<div class="control-group">
							<table border="1" width="100%">
								<thead>
									<th>Tipo de ingresso</th>
									<th>Valor</th>
									<th>Quantidade</th>
									<th>Descri&ccedil;&atilde;o</th>
									<th>In&iacute;cio</th>
									<th>T&eacute;rmino</th>
								</thead>
								<tbody id="ticket_table" >
									<tr>
										<td colspan="7"></td>
									</tr>
								</tbody>
							</table>
						</div>                  
						<div id="ticket_form" class="control-group" >
							<div class="four columns">
								<label>Tipo de ingresso *</label>
								<input name="tipo"  id="ticket_tipo" type="text">
							</div>
							<div class="three columns" id="campoPreco">
								<label>Preço R$ *</label>
								<input class="valor" name="valor" id="ticket_preco" type="text">
							</div>
							<div class="two columns" style="position:relative;margin-left:575px;margin-top:-60px;">
								<input name="gratis" id="ticket_gratis" type="checkbox" value="1"  >
								<span>Grátis</span>
							</div>
							<div class="end">
								<label>Quantidade *</label>
								<input name="quantidade"  id="ticket_quantidade" type="text" style="direction:rtl" >
							</div>
							<div class="twelve columns">
								<label>Descrição</label>
								<textarea name="descricao" id="ticket_descricao"></textarea>
							</div>
							<div class="four columns">
								<label>Início das Vendas</label>
								<input name="inicio_vendas" id="ticket_inicio_vendas" type="text" class="dataMinima" rel="ticket" />
							</div>
							<div class="four columns end">
								<label>Término das Vendas</label>
								<input name="termino_vendas" id="ticket_termino_vendas" type="text" class="dataMaxima" rel="ticket" />
							</div>
							<div class="four columns end">
								<input name="restrito" id="ticket_restrito" type="checkbox" value="1" >
    							Ingresso restrito a convidados
    						</div>
						</div>
						<div class="twelve columns">
							<input type="button" onclick="addTicket()"  value="Criar ingressos" class="button">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="categoria">Categoria</label>
						<div class="controls">
							<select name="Event[categoria]">
								<option value="1">Seminários, Palestras, Cursos e Workshops</option>
							    <option value="2">Conferências, Congressos e Convenções</option>
							    <option value="3">Exposições, Mostras e Feiras</option>
							    <option value="4">Evento Corporativo</option>
							    <option value="5">Evento de Teste</option>
							    <option value="6">Shows, Festas e Festivais</option>
							    <option value="7">Encontros e Networking</option>
							    <option value="8">Teatro, Dança e Artes</option>
							    <option value="9">Religioso</option>
							    <option value="10">Esportes</option>
							    <option value="11">Turismo</option>
							    <option value="12">Outros</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="descricao">Programação</label>
				      	<div class="controls">
				      		<textarea class="span4" name="Event[programacao]" id="programacao" rows="4" ></textarea>
				        </div>
				    </div>
				    <div class="control-group">
						<label class="control-label" for="local" >Local</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[local]" id="local" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="cep" >CEP</label>
						<div class="controls">
							<input type="text" class="input-large cep" name="Event[cep]" id="cep" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="endereco" >Avenida / Rua</label>
						<div class="controls">
							<input type="text" class="input-xlarge" name="Event[endereco]" id="endereco" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="numero" >Número</label>
						<div class="controls">
							<input type="text" class="input-mini" name="Event[numero]" id="numero" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="complemento" >Complemento</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[complemento]" id="complemento" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="bairro" >Bairro</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[bairro]" id="bairro" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="cidade" >Cidade</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[cidade]" id="cidade" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="estado">Estado</label>
						<div class="controls">
							<select name="Event[estado]">
								<option value="AC">Acre</option>
								<option value="AL">Alagoas</option>
								<option value="AP">Amapá</option>
								<option value="AM">Amazonas</option>
								<option value="BA">Bahia</option>
								<option value="CE">Ceará</option>
								<option value="DF">Distrito Federal</option>
								<option value="ES">Espírito Santo</option>
								<option value="GO">Goiás</option>
								<option value="MA">Maranhão</option>
								<option value="MT">Mato Grosso</option>
								<option value="MS">Mato Grosso do Sul</option>
								<option value="MG">Minas Gerais</option>
								<option value="PA">Pará</option>
								<option value="PB">Paraíba</option>
								<option value="PR">Paraná</option>
								<option value="PE">Pernambuco</option>
								<option value="PI">Piauí</option>
								<option value="RJ">Rio de Janeiro</option>
								<option value="RN">Rio Grande do Norte</option>
								<option value="RS">Rio Grande do Sul</option>
								<option value="RO">Rondônia</option>
								<option value="RR">Roraima</option>
								<option value="SC">Santa Catarina</option>
								<option value="SP">São Paulo</option>
								<option value="SE">Sergipe</option>
								<option value="TO">Tocantins</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<h4>Organizador (anfitrião)</h4>
						<div class="twelve columns">
							<table border="1" width="100%">
								<thead>
									<th>Nome</th>
									<th>Descricao</th>
							    </thead>
							    <tbody id="host_table" >
								    <tr> 
								    	<td colspan="7"></td>
								    </tr>
							    </tbody>
							</table>
						</div>                  
						<div id="host_form" >
							<div class="four columns">
								<label>Nome *</label>
								<input name="nome"  id="host_nome" type="text">
							</div>
							<div class="twelve columns end" id="campoPreco">
								<label>Descrição *</label>
								<textarea class="descricao" name="descricao" id="host_descricao" ></textarea>
							</div>
						</div>
						<div class="twelve columns">
							<input type="button" onclick="addHost()"  value="Criar Organizador" class="button">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="privado">Seu evento é público ou privado</label>
						<div class="controls">
							<select name="Event[privado]">
								<option value="0">Público</option>
								<option value="1">Privado</option>
							</select>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'evento/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
