$(document).ready(() => {
	
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
			},
			error: erro => {console.log(erro)}
		})

		//método, url, dados, sucesso, erro
	})
})