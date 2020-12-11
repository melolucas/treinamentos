<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class User_control extends MS_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('log')) {
            redirect(base_url());
        }
        $this->load->model('user_model');
        $this->load->model('admin_model');
    }

    public function index($message = '')
    {
        $data = array();
        $data['class'] = 11; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', $data, TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['users'] = $this->user_model->get_all_users();
        $data['user_role'] = $this->admin_model->get_user_role();
        $data['cargo'] = $this->admin_model->get_user_cargo();
       // var_dump($data['cargo']);die;
        $data['content'] = $this->load->view('content/view_all_users', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function view_banned_users($message = '')
    {
        $data = array();
        $data['class'] = 13; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', $data, TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['users'] = $this->user_model->get_benned_users();
        $data['content'] = $this->load->view('content/view_banned_users', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function add_user()
    {
        if (!$this->session->userdata('log') || $this->session->userdata('user_role_id') > 3){
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>You are not allowed to view this page.</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url());
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_name', 'Name', 'required');
            //$this->form_validation->set_rules('user_email', 'Email Address', 'required|valid_email');
            $this->form_validation->set_rules('user_pass', 'Password', 'required|min_length[4]');
            $this->form_validation->set_rules('user_passcf', 'Confirm Password', 'required|min_length[4]|matches[user_pass]');
            $this->form_validation->set_rules('user_role', 'User Type', 'required');
            if ($this->form_validation->run() !== FALSE) {
                date_default_timezone_set($this->session->userdata['time_zone']);
                $this->load->model('login_model');
                $info = array();
                $info['user_name'] = $this->input->post('user_name', TRUE);
                $info['user_email'] = $this->input->post('user_email', TRUE);
                $info['user_phone'] = $this->input->post('user_phone', TRUE);
                $info['cpf'] = $this->input->post('cpf', TRUE);
                $info['user_role_id'] = $this->input->post('user_role', TRUE);
                $info['idCargo'] = $this->input->post('cargo', TRUE);
                $info['regiao'] = $this->input->post('regiao', TRUE);            
                //$info['cargo'] = $this->admin_model->get_user_cargo();
                $info['user_pass'] = md5($this->input->post('user_pass'));
                $info['user_from'] = date('Y-m-d H:i:s');
                $info['active'] = 1;

                if ($info['user_role_id'] <= $this->session->userdata('user_role_id')) {
                    $message = '<div class="alert alert-danger alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . '<br><br>Você não pode criar um usuário de nível superior.</div>';

                    $this->session->set_flashdata('message',$message);
                    redirect(base_url('index.php/user_control/add_user'));
                }

                if ($this->login_model->register($info)) {
                    $from = $this->session->userdata['support_email'];
                    $to = $info['user_email'];
                    $suject = 'You are added with ' . $this->session->userdata['brand_name'];
                    $message_body = 'Initial Login info:</br> User Name: ' . $info['user_email']
                            . '</br>Password: ' . $this->input->post('user_pass') . '</br></br>'
                            . 'Use this link to login: ' . base_url('index.php/login_control') . '</br></br>'
                            . 'Note: Change you password after login.';

                    $this->config->load('mail');
                    $this->load->library('email', $this->config->item('email_config'));
                    $this->email->set_newline("\r\n");
                    $this->email->from($from);
                    $this->email->to($to);
                    $this->email->subject($suject);
                    $this->email->message($message_body);
                    $this->email->send();

                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'Usuario Adicionado com Sucesso!'
                            . '</div>';
                    $this->session->set_flashdata('message',$message);
                    redirect(base_url('index.php/user_control'));
                } else {
                    $message = '<div class="alert alert-danger alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . '"' . $info['user_email'] . '" is already used by another account. Try another email.</div>';
                    $this->session->set_flashdata('message',$message);
                    redirect(base_url('index.php/user_control/add_user'));
                }
            }
        }

        $data = array();
        $data['class'] = 12; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', $data, TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['user_role'] = $this->admin_model->get_user_role();
        $data['cargo'] = $this->admin_model->get_user_cargo();
       // var_dump($data['cargo']);die;
        $data['content'] = $this->load->view('form/user_add_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);

    }

    public function modify_user($id){
        if (!$this->session->userdata('log') || $this->session->userdata('user_role_id') > 3){
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>You are not allowed to view this page.</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url());
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_name', 'Name', 'required');
           // $this->form_validation->set_rules('user_email', 'Email Address', 'required|valid_email');
            $this->form_validation->set_rules('user_role', 'User Type', 'required');
            if ($this->form_validation->run() != FALSE) {
                if ($this->user_model->update_user($id)) {
                    $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Atualizado com Sucesso!'
                        . '</div>';
                } else {
                    $message = '<div class="alert alert-danger alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>Update failed!</div>';
                }
                $this->session->set_flashdata('message', $message);
                redirect(base_url("index.php/user_control"));
            }
        }
        $data = array();
        $data['class'] = 11; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['user'] = $this->user_model->get_user_info($id);
        $data['data_id'] = $id;
        $data['user_role'] = $this->admin_model->get_user_role();
        $data['cargo'] = $this->admin_model->get_user_cargo();
        //$da['regiao'] = $this->admin_model->get_user_cargo();
        $data['content'] = $this->load->view('form/modify_user', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);

    }

    public function update_user_data()
    {
        echo ($this->user_model->update_user_data()) ? 'TRUE' : 'FALSE';
    }

    public function deactivate_user_account($id)
    {
        if ($this->session->userdata('user_role_id') >= $id){
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>You are not allowed to do this.</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url("index.php/user_control"));
        }

        if ($this->user_model->deactivate_user_account($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Desativado com  sucesso!'
                    . '</div>';
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url("index.php/user_control"));
    }

    public function ban_user_account($id)
    {
        if (!is_numeric($id) OR ($this->session->userdata('user_role_id') >= $id)) {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>You are not allowed to do this.</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url("index.php/user_control"));
        }

        if ($this->user_model->ban_user_account($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Esta conta foi Banida!'
                    . '</div>';
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url("index.php/user_control"));
    }

    public function activate_user_account($id)
    {
        if (!is_numeric($id) OR ($this->session->userdata('user_role_id') >= $id)) {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>You are not allowed to do this.</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url("index.php/user_control"));
        }

        if ($this->user_model->activate_user_account($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Ativado com sucesso!'
                    . '</div>';
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url("index.php/user_control/view_banned_users"));
    }

    public function unban_user_account($id)
    {
        if (!is_numeric($id) OR ($this->session->userdata('user_role_id') >= $id)) {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>You are not allowed to do this.</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url("index.php/user_control"));
        }

        if ($this->user_model->unban_user_account($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Unbanned successfully.!'
                    . '</div>';
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url("index.php/user_control/view_banned_users"));
    }

}