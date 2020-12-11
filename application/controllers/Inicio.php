<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();		
			//se o acesso está concedido continua o processo
			if($acesso){

				//carrega os pontos do cliente
				$this->load->model('Historicopontos_model');
				$dados['pontos'] = $this->Historicopontos_model->totalPontos($this->session->userdata('cpf'));

				//Soma e carrega a somatória dos valores da loja
				$this->load->model('Historicoclientes_model');
				$dados['compras'] = $this->Historicoclientes_model->totalCompras($this->session->userdata('cpf'));



				//carrega os dados do processamento
				$this->load->view('inicio', $dados);

			} else {
				
				$dados['retorno'] = 7;
				$this->load->view('login', $dados);
	
			}

	}	

	//igual ao controlador index
	//a unica diferenca esta que a variável $dados['retornos'], pega os valores passados pela URL.
	public function retornos($retorno)
	{
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();	
		
			//se o acesso está concedido continua o processo
			if($acesso) {


				//carrega os pontos do cliente
				$this->load->model('Historicopontos_model');
				$dados['pontos'] = $this->Historicopontos_model->totalPontos($this->session->userdata('cpf'));

				//Soma e carrega a somatória dos valores da loja
				$this->load->model('Historicoclientes_model');
				$dados['compras'] = $this->Historicoclientes_model->totalCompras($this->session->userdata('cpf'));
				
				//a un
				$dados['retorno'] = $retorno;

				//carrega os dados do processamento
				$this->load->view('inicio', $dados);

			} else {
				
				$dados['retorno'] = 7;
				$this->load->view('login', $dados);
	
			}
	}		

	//função alterar senha
	public function alterarsenha()
	{
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();		
		
			//se o acesso está concedido continua o processo
			if($acesso) {

				//carrega os pontos do cliente
				$this->load->model('Historicopontos_model');
				$dados['pontos'] = $this->Historicopontos_model->totalPontos($this->session->userdata('cpf'));

				//Soma e carrega a somatória dos valores da loja
				$this->load->model('Historicoclientes_model');
				$dados['compras'] = $this->Historicoclientes_model->totalCompras($this->session->userdata('cpf'));
				
				$dados['retorno'] = '4';

				//carrega os dados do processamento
				$this->load->view('inicio', $dados);

		} else {
			
			$dados['retorno'] = 7;
			$this->load->view('login', $dados);

		}
	}

	public function erroConfirmarSmS()
	{
			//processa a página inicial e
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();		
			//se o acesso está concedido continua o processo
			if($acesso) {
				//carrega os pontos do cliente
				$this->load->model('Historicopontos_model');
				$dados['pontos'] = $this->Historicopontos_model->totalPontos($this->session->userdata('cpf'));

				//Soma e carrega a somatória dos valores da loja
				$this->load->model('Historicoclientes_model');
				$dados['compras'] = $this->Historicoclientes_model->totalCompras($this->session->userdata('cpf'));

				//passa a informação que o usuário não confirmou o celular
				$dados['retorno'] = '2';
				$dados['erro'] = '1';

				//carrega os dados do processamento
				$this->load->view('inicio', $dados);

		} else {
			$dados['retorno'] = 7;
			$this->load->view('login', $dados);

		}
	}	
	
	public function cadastroNovaSenha()
	{
		$this->load->model('Validasessao_model');
		$acesso = $this->Validasessao_model->verificaPermissao();		
			//se o acesso está concedido continua o processo
			
		if($acesso) {

				//carrega os dados do processamento
				$this->load->view('cadastro_nova_senha');

		} else {
			
			$dados['retorno'] = 7;
			$this->load->view('login', $dados);

		}
	}

}
