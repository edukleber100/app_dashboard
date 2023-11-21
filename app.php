<?php

	class Dashboard {

		public $data_inicio;
		public $data_fim;
		public $numeroVendas;
		public $totalVendas;
		public $clientesAtivos;
		public $clientesInativos;
		public $reclamacoes;
		public $elogios;
		public $sugestao;
		public $despesas;

		public function __get($atributo) {
			return $this->$atributo;
		}

		public function __set($atributo, $valor){
			$this->$atributo = $valor;
			return $this;
		}
	}


	class Conexao {
		private $host = 'localhost';
		private $dbname = 'dashboard';
		private $user = 'root';
		private $pass = '';

		public function conectar() {
			try{

				$conexao = new PDO(
					"mysql:host=$this->host;dbname=$this->dbname",
					"$this->user",
					"$this->pass"
				);

				$conexao->exec('set charset utf8');

				return $conexao;

			} catch (PDOException $e) {
				echo '<p>'. $e->getMessage().'</p>';
			};
		}
	}


	class Bd {
		private $conexao;
		private $dashboard;

		public function __construct(Conexao $conexao, Dashboard $dashboard) {
			$this->conexao = $conexao->conectar();
			$this->dashboard = $dashboard;
		}

		public function getNumeroVendas() {
			$query = 'select count(*) as numero_vendas from tb_vendas where data_venda between :data_inicio and :data_fim';

			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
			$stmt->bindValue(':data_fim', $this->dashboard->__get('data_fim'));
			$stmt->execute();


			return $stmt->fetch(PDO::FETCH_OBJ)->numero_vendas;
		}

		public function getTotalVendas() {
			$query = 'select SUM(total) as total_vendas from tb_vendas where data_venda between :data_inicio and :data_fim';

			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
			$stmt->bindValue(':data_fim', $this->dashboard->__get('data_fim'));
			$stmt->execute();


			return $stmt->fetch(PDO::FETCH_OBJ)->total_vendas;
		}

		public function getClientesAtivos() {
	        $query = 'SELECT COUNT(*) as cliente_ativo FROM tb_clientes WHERE cliente_ativo = 1';
	        $stmt = $this->conexao->prepare($query);
	        $stmt->execute();

	        return $stmt->fetch(PDO::FETCH_OBJ)->cliente_ativo;
    	}

	    public function getClientesInativos() {
	        $query = 'SELECT COUNT(*) as cliente_ativo FROM tb_clientes WHERE cliente_ativo = 0';
	        $stmt = $this->conexao->prepare($query);
	        $stmt->execute();

	        return $stmt->fetch(PDO::FETCH_OBJ)->cliente_ativo;
	    }

	    public function getReclamacoes() {
	        $query = 'SELECT COUNT(*) as total_reclamacoes FROM tb_reclamacoes';
	        $stmt = $this->conexao->prepare($query);
	        $stmt->execute();

	        return $stmt->fetch(PDO::FETCH_OBJ)->total_reclamacoes;
	    }

	    public function getElogios() {
	        $query = 'SELECT COUNT(*) as total_elogios FROM tb_elogios';
	        $stmt = $this->conexao->prepare($query);
	        $stmt->execute();

	        return $stmt->fetch(PDO::FETCH_OBJ)->total_elogios;
	    }

	    public function getSugestoes() {
	        $query = 'SELECT COUNT(*) as total_sugestoes FROM tb_sugestao';
	        $stmt = $this->conexao->prepare($query);
	        $stmt->execute();

	        return $stmt->fetch(PDO::FETCH_OBJ)->total_sugestoes;
	    }

	    public function getDespesas() {
	        $query = 'SELECT SUM(valor) as total_despesas FROM tb_despesas';
	        $stmt = $this->conexao->prepare($query);
	        $stmt->execute();

	        return $stmt->fetch(PDO::FETCH_OBJ)->total_despesas;
	    }
	}
	

	//logica do script

	$dashboard = new Dashboard();

	$conexao = new Conexao();

	$competencia = explode('-', $_GET['competencia']);
	$ano = $competencia[0];
	$mes = $competencia[1];

	$dias_do_mes= cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

	$dashboard->__set('data_inicio', $ano.'/'.$mes.'-1');
	$dashboard->__set('data_fim', $ano.'/'.$mes.'/'.$dias_do_mes);

	$bd = new Bd($conexao, $dashboard);

	$dashboard->__set('numeroVendas', $bd->getNumeroVendas());
	$dashboard->__set('totalVendas', $bd->getTotalVendas());
	$dashboard->__set('clientesAtivos', $bd->getClientesAtivos());
	$dashboard->__set('clientesInativos', $bd->getClientesInativos());

	echo json_encode($dashboard);
	

?>