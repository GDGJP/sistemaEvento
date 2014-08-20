
//utilizado no formEditar PJ(Módulo de contas a Receber) para identificar os planos de contribuinte
/*$(function () {
	function removeCampo() {
		$(".removerCampo").unbind("click");
		$(".removerCampo").bind("click", function () {
			i=0;
			$(".representantes p.campoRepresentantes").each(function () {
				i++;
			});
			if (i>1) {
				$(this).parent().remove();
			}
		});
	}
	removeCampo();
	$("#adicionarCampo").click(function () {
		novoCampo = $(".representantes p.campoRepresentantes:first").clone();
		novoCampo.find("input").val("");
		novoCampo.insertAfter(".representantes p.campoRepresentantes:last");
		removeCampo();
	});
});*/
	
//utilizado no formEditar PJ(Módulo de contas a Receber) para identificar os planos de mantenedor
$(function () {
	function removeCampo2() {
		$(".removerCampo2").unbind("click");
		$(".removerCampo2").bind("click", function () {
			i=0;
			$(".servicos2 p.campoServicos2").each(function () {
				i++;
			});
			if (i>1) {
				$(this).parent().remove();
			}
		});
	}
	removeCampo2();
	$(".adicionarCampo2").click(function () {
		novoCampo = $(".servicos2 p.campoServicos2:first").clone();
		novoCampo.find("input").val("");
		novoCampo.insertAfter(".servicos2 p.campoServicos2:last");
		removeCampo2();
	});
});

//utilizado pelo formInscrição do módulo de eventos
$(function () {
	function removeCampo3() {
		$(".removerCampo3").unbind("click");
		$(".removerCampo3").bind("click", function () {
			i=0;
			$("div.servicos3 p.campoServicos3").each(function () {
				i++;
			});
			if (i>1) {
				$(this).parent().remove();
			}
		});
	}
	removeCampo3();
	$(".adicionarCampo3").click(function () {
		novoCampo = $("div.servicos3 p.campoServicos3:first").clone();
		novoCampo.find("input").val("");
		novoCampo.insertAfter("div.servicos3 p.campoServicos3:last");
		removeCampo3();
	});
});

	