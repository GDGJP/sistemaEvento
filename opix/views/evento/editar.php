<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite o evento</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-evento" class="form-horizontal eventoForm" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[nome]" id="nome" value="<?php echo $evento->nome; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">Imagem</label>
						<div class="controls">
							<input type="file" class="input-large" name="Event[imagem]" id="imagem" />
							<?php if(!empty($evento->imagem)) : ?>
								<input type="hidden" name="Event[imagem_antiga]" value="<?php echo $evento->imagem;  ?>" />
								<img alt="<?php echo $evento->nome; ?>" src="<?php echo Configuracao::$baseUrl.'imagens_evento/'.$evento->imagem; ?>" style="max-width:700px;" />
							<?php endif; ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="dataInicio" >Data de Início</label>
						<div class="controls">
							<input type="text" class="input-large dataMinima" name="Event[dataInicio]" id="dataInicio" rel="evento" value="<?php echo $evento->dataInicio; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="dataFim" >Data de Término</label>
						<div class="controls">
							<input type="text" class="input-large dataMaxima" name="Event[dataFim]" id="dataFim" rel="evento" value="<?php echo $evento->dataFim; ?>" />
						</div>
					</div>
					<div class="control-group">
						<h4>Ingressos
							<small>(Pelo menos um tipo de ingresso deve ser criado para que seu evento possa ser publicado)</small>
						</h4>
						<div class="control-group">
							<table border="1" width="100%">
								<thead>
									<th width="30%">Tipo de ingresso</th>
									<th width="10%">Valor</th>
									<th width="10%">Quantidade</th>
									<th width="20%">Descri&ccedil;&atilde;o</th>
									<th width="15%">In&iacute;cio</th>
									<th width="15%">T&eacute;rmino</th>
								</thead>
								<tbody id="ticket_table" >
									<tr><td colspan="7"></td></tr>
									<?php
								    	foreach( $ingressos as $ingresso ) {
								    ?>
										    <tr id="editarIngresso_<?php echo $ingresso->id; ?>" style="cursor: pointer;" >
										    	<td><?php echo $ingresso->tipoIngresso; ?></td>
										    	<td><?php echo $ingresso->preco; ?></td>
										    	<td><?php echo $ingresso->quantidade; ?></td>
										    	<td><?php echo $ingresso->descricao; ?></td>
										    	<td><?php echo $ingresso->dataInicio; ?></td>
										    	<td><?php echo $ingresso->dataFim; ?></td>
										    	<td><input type="button" onclick="excluirIngresso(this);" id="exclusaoIngresso_<?php echo $ingresso->id; ?>" value="X" /></td>
										    	<input type="hidden" name="edit_restrito" value="<?php echo $ingresso->restrito; ?>" />
										    </tr>
									<?php 
										}
									?>
								</tbody>
							</table>
						</div>                  
						<div id="ticket_form" class="control-group" >
							<input name="id_ingresso" type="hidden" value="" />
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
							<input type="button" id="botaoNewEditTicket" onclick="newEditTicket(<?php echo $evento->id; ?>);"  value="Adicionar Ingresso" class="button">
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
				      		<textarea class="span4" name="Event[programacao]" id="programacao" rows="4" ><?php echo $evento->programacao; ?></textarea>
				        </div>
				    </div>
				    <div class="control-group">
						<label class="control-label" for="local" >Local</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[local]" id="local" value="<?php echo $evento->local; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="cep" >CEP</label>
						<div class="controls">
							<input type="text" class="input-large cep" name="Event[cep]" id="cep" value="<?php echo $evento->cep; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="endereco" >Avenida / Rua</label>
						<div class="controls">
							<input type="text" class="input-xlarge" name="Event[endereco]" id="endereco" value="<?php echo $evento->endereco; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="numero" >Número</label>
						<div class="controls">
							<input type="text" class="input-mini" name="Event[numero]" id="numero" value="<?php echo $evento->numero; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="complemento" >Complemento</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[complemento]" id="complemento" value="<?php echo $evento->complemento; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="bairro" >Bairro</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[bairro]" id="bairro" value="<?php echo $evento->bairro; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="cidade" >Cidade</label>
						<div class="controls">
							<input type="text" class="input-large" name="Event[cidade]" id="cidade" value="<?php echo $evento->cidade; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="estado">Estado</label>
						<div class="controls">
							<select name="Event[estado]">
								<option <?php echo $evento->estado == 'AC' ? 'selected="selected"' : ''; ?> value="AC">Acre</option>
								<option <?php echo $evento->estado == 'AL' ? 'selected="selected"' : ''; ?> value="AL">Alagoas</option>
								<option <?php echo $evento->estado == 'AP' ? 'selected="selected"' : ''; ?> value="AP">Amapá</option>
								<option <?php echo $evento->estado == 'AM' ? 'selected="selected"' : ''; ?> value="AM">Amazonas</option>
								<option <?php echo $evento->estado == 'BA' ? 'selected="selected"' : ''; ?> value="BA">Bahia</option>
								<option <?php echo $evento->estado == 'CE' ? 'selected="selected"' : ''; ?> value="CE">Ceará</option>
								<option <?php echo $evento->estado == 'DF' ? 'selected="selected"' : ''; ?> value="DF">Distrito Federal</option>
								<option <?php echo $evento->estado == 'ES' ? 'selected="selected"' : ''; ?> value="ES">Espírito Santo</option>
								<option <?php echo $evento->estado == 'GO' ? 'selected="selected"' : ''; ?> value="GO">Goiás</option>
								<option <?php echo $evento->estado == 'MA' ? 'selected="selected"' : ''; ?> value="MA">Maranhão</option>
								<option <?php echo $evento->estado == 'MT' ? 'selected="selected"' : ''; ?> value="MT">Mato Grosso</option>
								<option <?php echo $evento->estado == 'MS' ? 'selected="selected"' : ''; ?> value="MS">Mato Grosso do Sul</option>
								<option <?php echo $evento->estado == 'MG' ? 'selected="selected"' : ''; ?> value="MG">Minas Gerais</option>
								<option <?php echo $evento->estado == 'PA' ? 'selected="selected"' : ''; ?> value="PA">Pará</option>
								<option <?php echo $evento->estado == 'PB' ? 'selected="selected"' : ''; ?> value="PB">Paraíba</option>
								<option <?php echo $evento->estado == 'PR' ? 'selected="selected"' : ''; ?> value="PR">Paraná</option>
								<option <?php echo $evento->estado == 'PE' ? 'selected="selected"' : ''; ?> value="PE">Pernambuco</option>
								<option <?php echo $evento->estado == 'PI' ? 'selected="selected"' : ''; ?> value="PI">Piauí</option>
								<option <?php echo $evento->estado == 'RJ' ? 'selected="selected"' : ''; ?> value="RJ">Rio de Janeiro</option>
								<option <?php echo $evento->estado == 'RN' ? 'selected="selected"' : ''; ?> value="RN">Rio Grande do Norte</option>
								<option <?php echo $evento->estado == 'RS' ? 'selected="selected"' : ''; ?> value="RS">Rio Grande do Sul</option>
								<option <?php echo $evento->estado == 'RO' ? 'selected="selected"' : ''; ?> value="RO">Rondônia</option>
								<option <?php echo $evento->estado == 'RR' ? 'selected="selected"' : ''; ?> value="RR">Roraima</option>
								<option <?php echo $evento->estado == 'SC' ? 'selected="selected"' : ''; ?> value="SC">Santa Catarina</option>
								<option <?php echo $evento->estado == 'SP' ? 'selected="selected"' : ''; ?> value="SP">São Paulo</option>
								<option <?php echo $evento->estado == 'SE' ? 'selected="selected"' : ''; ?> value="SE">Sergipe</option>
								<option <?php echo $evento->estado == 'TO' ? 'selected="selected"' : ''; ?> value="TO">Tocantins</option>
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
								    <tr><td colspan="7"></td></tr>
								    <?php 
								    	foreach( $organizadores as $organizador ) :
								    ?>
										    <tr id="editarHost_<?php echo $organizador->id; ?>" style="cursor: pointer;" >
										    	<td><?php echo $organizador->nome; ?></td>
										    	<td><?php echo $organizador->descricao; ?></td>
										    	<td><input type="button" onclick="excluirHost(this);" id="exclusaoHost_<?php echo $organizador->id; ?>" value="X" /></td>
										    </tr>
									<?php 
										endforeach;
									?>
							    </tbody>
							</table>
						</div>                  
						<div id="host_form" >
							<input name="id_host" type="hidden" value="" />
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
							<input type="button" id="botaoNewEditHost" onclick="newEditHost(<?php echo $evento->id; ?>);"  value="Adicionar Organizador" class="button">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="privado">Seu evento é público ou privado</label>
						<div class="controls">
							<select name="Event[privado]">
								<option <?php echo $evento->privado == 0 ? 'selected="selected"' : ''; ?> value="0">Público</option>
								<option <?php echo $evento->privado == 1 ? 'selected="selected"' : ''; ?> value="1">Privado</option>
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
