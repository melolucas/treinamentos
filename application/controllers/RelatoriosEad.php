<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class RelatoriosEad extends MS_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('log')) {
            redirect(base_url());
        }
    }

    public function index() {
        $data = array();

        /* Cursos */
        $this->load->model('Relatorios_ead_model'); 
        $data['cursos'] = $this->Relatorios_ead_model->cursos();
        $data['cargos'] = $this->Relatorios_ead_model->cargos();

        /* Template */
        $data['class'] = 11; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', $data, TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);      
        $data['content'] = $this->load->view('relatorios/index', $data); //View
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function regiaoUm() {
        $curso = $this->input->POST('curso');
        $cargo = $this->input->POST('cargo');
        $regiao = $this->input->POST('regiao');
        
        $data = array();        
        
        /* Sql */
        $this->load->model('Relatorios_ead_model');        
        $data['countAvaliados'] = $this->Relatorios_ead_model->countAvaliados($curso, $cargo, $regiao);
        $data['countAprovados'] = $this->Relatorios_ead_model->countAprovados($curso, $cargo, $regiao);
        $data['countReprovados'] = $this->Relatorios_ead_model->countReprovados($curso, $cargo, $regiao);
        $data['naoFizeram'] = $this->Relatorios_ead_model->naoFizeram($curso, $cargo, $regiao);

        /* Tabelas */
        $data['relTotal'] = $this->Relatorios_ead_model->relTotal($curso, $cargo, $regiao);      
        
        /* Modal */
        $data['modalNaoFizeram'] = $this->Relatorios_ead_model->modalNaoFizeram($curso, $cargo, $regiao);
        $data['modalReprovados'] = $this->Relatorios_ead_model->modalReprovados($curso, $cargo, $regiao);
        $data['modalAprovados'] = $this->Relatorios_ead_model->modalAprovados($curso, $cargo, $regiao);

        /* Template */
        $data['class'] = 11; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', $data, TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);      
        $data['content'] = $this->load->view('relatorios/regiaoum', $data); //View
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data); 

    }    
}
