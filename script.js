$(document).ready(() => {

	$('#dashboard').on('click', () => {
        $.post('dashboard.html', (data) => {
            $('#pagina').html(data);
        });
    });

	$('#documentacao').on('click', () => {
		//$('#pagina').load('documentacao.html')

		$.post('documentacao.html', data => {
			$('#pagina').html(data)
		})
	})

	$('#suporte').on('click', () => {
		//$('#pagina').load('suporte.html')
		$.post('suporte.html', data => {
			$('#pagina').html(data)
		})
	})


	//ajax
	$('#competencia').on('change', e =>{

		let competencia = $(e.target).val()

		$.ajax({
			type: 'GET',
			url: 'app.php',
			data: `competencia=${competencia}`,
			dataType: 'json',
			success: dados => {
				$('#numeroVendas').html(dados.numeroVendas)
				$('#totalVendas').html(dados.totalVendas)
				$('#clientesAtivos').html(dados.clientesAtivos)
				$('#clientesInativos').html(dados.clientesInativos)
				$('#despesas').html(dados.despesas)
				$('#reclamacoes').html(dados.reclamacoes)
				$('#elogios').html(dados.elogios)
				$('#sugestoes').html(dados.sugestoes)
			},
			error: erro => {console.log(erro)}
		})

		//método, url, dados, sucesso, erro
	})
})