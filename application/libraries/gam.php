<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***
EM PRODUÇÃO


Procede o envio das informações para a base de dados da GAM.

class gam {

		//define os paramêtros globais para o envio das informações
		private $endereco = '/';
		private $token = '/';
		private $metodo = 'POST';
	
		//Envia os dados do clientes, para cadastro
        public function enviarCliente($dadosGam)
        {
				//coloca os parametros recebidos no formato JSON
				$data_string = json_encode($dadosGam);                                                                                   

				//Inicia a CURL URL e seta os valores padrões para o POST em JSON
				$gam = curl_init($this->urlbase . $this->token);

				//Define o método de envio do arquivo
				curl_setopt($gam, CURLOPT_CUSTOMREQUEST, $this->metodo);

				//coloca os valores nos campos de entrada do json
				curl_setopt($gam, CURLOPT_POSTFIELDS, $data_string);

				//solicita o retorno do processo de envio
				curl_setopt($gam, CURLOPT_RETURNTRANSFER, true);

				//carrega os cabeçalhos padrões para o procedimentos
				curl_setopt($gam, CURLOPT_HTTPHEADER,
					array(
						'Content-Type: application/json',
						'Content-Length: ' . strlen($data_string))
					);                                                                                                                   

				//Procede com o envio dos dados
				$result = curl_exec($gam);

				//Verifica se ocorreu retorno positivo da GAM
				if($result)
					{
						//retorno positivo
						return true;
					
					} else {
						//retorno falso
						return false;
					
					}  
        }
}


?>