<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {


	//VISUALIZAÇÃO DOS DADOS
	public function index()
	{
		//carrega a validação do usuário.
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();
		
			//se o acesso está concedido continua o processo
			if($acesso) {

				$this->load->model('Clientes_model');
				$dados['informacoes'] = $this->Clientes_model->buscaDadosCpfAtivo();

				$this->load->view('perfil', $dados);
				
		} else {
			
			$dados['retorno'] = 7;
			$this->load->view('login', $dados);

		}
	}

	//PROCESSAMENTO DAS INFORMAÇÕES
	//Atualiza o cadastro do usuário
	public function atualizarCadastro()
	{
		//carrega a validação do usuário.
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();	
		
			//se o acesso está concedido continua o processo
			if($acesso){

				//Carrega a biblioteca responsável pela validação do formulário
				$this->load->library('form_validation');
				//verifica os campos necessários para o processamento
				$this->form_validation->set_rules('nome', 'Nome', 'required|min_length[5]|max_length[250]');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

				//pega os valores do formulário e gera um array, para o processamento
				if ($this->form_validation->run() == TRUE) {

					//define alguns valores para string
					$this->load->helper('acentos');

					$nome = $this->input->post('nome');
					$email = $this->input->post('email');
					$formsms = $this->input->post('smsconfirmado');
					$ibge_cidade = $this->input->post('ibge_cidade');

					//busca no campo CEP os dois primeiros digitos, os resnponsáveis por determinar o estado da cidade no codigo campo do IBGE
					$ibge_uf = substr($ibge_cidade, 0, 2);

					$cpf = $this->session->userdata('cpf');

					$a = substr($cpf, 2, 2);
					$b = substr($cpf, 3, 1);
					$c = substr($cpf, 10, 11);
					$d = date('hd');
					$e = substr($d, 1, 2);

					$senhasmssd = $a . $e . $c . $b;

						if($formsms ==	$senhasmssd)
						{

							//carrega o helper que auxilia na remoção dos acentos dos termos passados pelo usuário
							$this->load->helper('acentos');

							$data = array(
								'nome'	 	  => removerAcentos($this->input->post('nome')),
								'cep'	 	  => removerPontos($this->input->post('cep')),
								'uf' 	      => $this->input->post('uf'),
								'rua'	 	  => removerAcentos($this->input->post('rua')),
								'numero'  	  => $this->input->post('numero'),
								'complemento' => removerAcentos($this->input->post('complemento')),
								'cdloja'	  => '0',
								'bairro'	  => removerAcentos($this->input->post('bairro')),
								'cidade' 	  => removerAcentos($this->input->post('cidade')),
								'sexo' 	  	  => $this->input->post('sexo'),
								'ibge_cidade' => $ibge_cidade,
								'ibge_uf' 	  => $ibge_uf,
								'dtnascimento'=> $this->input->post('dtnascimento'),
								'fone' 		  => removerPontos($this->input->post('telefone')),
								'email' 	  => removerAcentos($this->input->post('email'))
								);

								$this->load->model('Clientes_model');
								$cadastro = $this->Clientes_model->atualizaCadastro($data);

									if($cadastro == TRUE)
									{
										$this->load->model('Logs_model');
										$this->Logs_model->adicionaOperacao('alterar_perfil-01',  $this->session->userdata('cpf'));

												redirect('inicio/retornos/1/');


									} else {
										$this->load->model('Logs_model');
										
										$this->Logs_model->adicionaOperacao('alterar_perfil-02',  $this->session->userdata('cpf'));
										

												redirect('usuario/cadastroErroProcessos/');


									}

						} else {
							redirect('perfil');

						}


					} else {

						redirect('usuario/cadastroErroProcessos/');
					}

				} else {
					$dados['retorno'] = 7;
					$this->load->view('login', $dados);
	
				}
	}

	//Envia SMS para confirmar o número do telefone
	public function smsconfirmado()
	{
		//carrega a validação do usuário.
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();
		
			//se o acesso está concedido continua o processo
			if($acesso) {

				$cpf = $this->session->userdata('cpf');
				$telefone = $this->session->userdata('telefone');
				$nome = $this->session->userdata('nome');

				$a = substr($cpf, 2, 2);
				$b = substr($cpf, 3, 1);
				$c = substr($cpf, 10, 11);
				$d = date('hd');
				$e = substr($d, 1, 2);
				
				$senha = $a . $e . $c . $b;

				$mensagem = urlencode($nome . ', Use a seguinte senha para confirmar seu número de telefone: ' . $senha);
				$envioSms = 'https://www.facilitamovel.com.br/api/simpleSend.ft?user=maxxi&password=ujbg45k2!&destinatario=' . $telefone . '&msg=' . $mensagem;
				$retonroSmS = file_get_contents($envioSms);
				$retornoF = substr($retonroSmS, 0, 1);

			if($retornoF == 6)
			{

				echo 'SMS enviado com sucesso!';

				return true;
				
				
			} else {
				
				echo 'Erro ao enviar o sms. Verifique seu número';

				return true;

			}
		} else {
			
			$dados['retorno'] = 7;
			$this->load->view('login', $dados);

		}

	}

	//envia os dados e reseta adiciona a nova senha ao CPF do usuário.
	public function alterarSenhaUsuario()
	{
		//carrega a validação do usuário.
		$this->load->model('Validasessao_model');
	//	$acesso = $this->Validasessao_model->verificaPermissao();	
		
			//se o acesso está concedido continua o processo
		//	if($acesso) {
				
				//valida o formulário recebido
				$this->load->library('form_validation');
				$this->form_validation->set_rules('novaSenhaUsuario', 'novaSenhaUsuario', 'required|numeric');
				
				//se o formulário estiver OK, processa as informações.
				if ($this->form_validation->run() == TRUE)
				{
					//declarando as variáveis
					$novaSenha = $this->input->post('novaSenhaUsuario');
					$senha = md5($novaSenha);

					$this->load->model('Clientes_model');
					$result = $this->Clientes_model->novaSenhaUsuario($senha);
						if($result){

							//carrega o model responsável por registrar log da operação na base de dados.
							$this->load->model('Logs_model');
							//os parametros passados nesta funcação é o CPF e o número unico da sessão
							$this->Logs_model->adicionaOperacao('alterar_senha-01', $this->session->userdata('cpf'));
							
								//se for possivel salvar o log, redireciona o usuário

									//redireciona o usuário para a página de alteração de senha
									// $dados['retorno'] = 8;
									// $this->load->view('login', $dados);
									redirect('inicio/retornos/2');



							
						} else {
							//caso algo tenha dado errado, remove o usuário e o retira do sistema
							redirect('usuario/sair/');
						};

				}  else {
					//caso algo tenha dado errado, remove o usuário e o retira do sistema
					redirect('usuario/sair/');
				};
			
	}

	//Confirma no banco de dados que o celular foi verificado
	public function confirmarTelefone()
	{

		//carrega a validação do usuário.
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();
		
			//se o acesso está concedido continua o processo
			if($acesso)
			{

				//valida o formulário recebido
				$this->load->library('form_validation');
				$this->form_validation->set_rules('smsconfirmado', 'smsconfirmado', 'required|numeric');
				
				//se o formulário estiver OK, processa as informações.
				if ($this->form_validation->run() == TRUE)
					
				{
					//declarando as variáveis
					$formsms = $this->input->post('smsconfirmado');
					$cpf = $this->session->userdata('cpf');

					$a = substr($cpf, 2, 2);
					$b = substr($cpf, 3, 1);
					$c = substr($cpf, 10, 11);
					$d = date('hd');
					$e = substr($d, 1, 2);
					
					$smssenha = $a . $e . $c . $b;

						if($formsms ==	 $smssenha)
					{

						$data = array(
							'smsconfirmado'	=> '1'
						);	
			
				
						$this->load->model('clientes_model');
						$result = $this->clientes_model->atualizaCadastro($data);
						
							if($result){
								//carrega o model responsável por registrar log da operação na base de dados.
								$this->load->model('Logs_model');
								//os parametros passados nesta funcação é o CPF e o número unico da sessão
								$this->Logs_model->adicionaOperacao('perfil_celconf-01', $cpf);
								
									//se for possivel salvar o log, redireciona o usuário

										//redireciona o usuário para a página de alteração de senha
										redirect('inicio');



								
							} else {

								redirect('inicio/erroConfirmarSmS');
								
							};
						} else {

							redirect('inicio/erroConfirmarSmS');

						}

				}  else {

					redirect('inicio/erroConfirmarSmS');

				}
			} else {
				$dados['retorno'] = 7;
				$this->load->view('login', $dados);

			}
	}

	//Confirma no banco de dados que o celular foi verificado
	public function alterarSenhaTelefone()
	{
		//carrega a validação do usuário.
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();		
			
		//se o acesso está concedido continua o processo
			if($acesso) {
				
				//valida o formulário recebido
				$this->load->library('form_validation');
				$this->form_validation->set_rules('smsconfirmado', 'smsconfirmado', 'required|numeric');
				$this->form_validation->set_rules('senha', 'senha', 'required|numeric');
				
				//se o formulário estiver OK, processa as informações.
				if ($this->form_validation->run() == TRUE)
				{
					//declarando as variáveis
					$formsms = $this->input->post('smsconfirmado');
					$novasenhausuario = $this->input->post('senha');
					$cpf = $this->session->userdata('cpf');

					$a = substr($cpf, 2, 2);
					$b = substr($cpf, 3, 1);
					$c = substr($cpf, 10, 11);
					$d = date('hd');
					$e = substr($d, 1, 2);
					
					$smssenha = $a . $e . $c . $b;

					if($formsms ==	$smssenha)
					{

						$data = array(
							'senha'	=> md5($novasenhausuario)
						);	
			

						$this->load->model('clientes_model');
						$result = $this->clientes_model->atualizaCadastro($data);
						
							if($result){

								//carrega o model responsável por registrar log da operação na base de dados.
								$this->load->model('Logs_model');
								//os parametros passados nesta funcação é o CPF e o número unico da sessão
								$this->Logs_model->adicionaOperacao('alterar_senha-01', $cpf);
								
									//se for possivel salvar o log, redireciona o usuário

										// echo 'feitoooo!!';
										//redireciona o usuário para a página de retorno da alteração da senha
										redirect('inicio/retornos/2');



								
							} else {

								redirect('inicio/erroConfirmarSmS');
								
							};
						} else {

							redirect('inicio/erroConfirmarSmS');

						}

				}  else {

					redirect('inicio/erroConfirmarSmS');

				}
			} else {
				$dados['retorno'] = 7;
				$this->load->view('login', $dados);

			}
	}
	
	public function alterarSenhaTelefoneSMSEnvio()
	{
		//carrega a validação do usuário.
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();
		
			//se o acesso está concedido continua o processo
			if($acesso) {
				
				$cpf = $this->session->userdata('cpf');
				$telefone = $this->session->userdata('telefone');
				$nome = $this->session->userdata('nome');

				$a = substr($cpf, 2, 2);
				$b = substr($cpf, 3, 1);
				$c = substr($cpf, 10, 11);
				$d = date('hd');
				$e = substr($d, 1, 2);
				
				$senha = $a . $e . $c . $b;



				$mensagem = urlencode($nome . ', para alterar suas informações, use o seguinte código de autenticação: ' . $senha);
				$envioSms = 'https://www.facilitamovel.com.br/api/simpleSend.ft?user=maxxi&password=ujbg45k2!&destinatario=' . $telefone . '&msg=' . $mensagem;
				$retonroSmS = file_get_contents($envioSms);
				$retornoF = substr($retonroSmS, 0, 1);



				if($retornoF == 6)
				{

					echo 'Código de autenticação enviada para seu celular.';

					return true;
					
					
				} else {
					echo 'Erro ao enviar o código de autenticação por SMS. Verifique seu número.';

					return false;

				}
			} else {
				$dados['retorno'] = 7;
				$this->load->view('login', $dados);

			}
	}
}