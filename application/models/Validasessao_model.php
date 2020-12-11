<?php

class Validasessao_model extends CI_Model {
        
        public function __construct() {
            parent::__construct();
        }

        //verifica as permissões do usuário
        //procura no banco a partir do cpf e da condição de ativo, se positivo, encaminha usuário
        public function verificaPermissao()
        {
                //realiza a verificação do usuário

                //busca para verificar se a sessão está alocada na memória do servidor
                if(!empty($this->session->userdata('sessao'))) {

                        //busca na sessão os valores passados para variáveis
                        $sessao = $this->session->userdata('sessao');
                        $cpf = $this->session->userdata('cpf');
                        $ip = $_SERVER['REMOTE_ADDR'];
                        // $agenteusuario = $_SERVER['HTTP_USER_AGENT'];


                        //define um periodo de tempo especifico para a sessão esta ativa
                        //no vaso agora, 24 horas.
                        $limitetempo = date('Y-m-d H:m:s', strtotime('-1 day'));

                        //realiza a busca
                        $this->db->select('*');
                        $this->db->from('weblogs');

                        //seleciona os acessos do usuário
                        $this->db->where('usuario', $cpf);
                        $this->db->where('sistema', '3');
                        $this->db->where('operacao', 'acesso_sis-01');
                        $this->db->where('sessao', $sessao);
                        $this->db->where('ip', $ip);

                        //limita por período de tempo
                        // $this->db->where('data >', date('Y-m-d H:m:s', strtotime('-1 day')));
                        // $this->db->where('data <', date('Y-m-d H:m:s'));

                        //coloca os valores em um resultado
                        $query = $this->db->get();

                        //verifica o retorno e aprova a continuidade da sessão
                        if($query->result())
                        {
                                return true;

                        } else {

                                return false;
                        }
                   
                } else {

                        return false;

                }
        }
}