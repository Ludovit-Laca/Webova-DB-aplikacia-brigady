<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Home_model');

    }


    public function index()
    {
        if ($this->session->userdata('username') != '') {
        } else {
            redirect(base_url() . 'index.php/home/login');
        }
        $data = array();
        //ziskanie sprav zo session
        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        $data['help'] = json_encode($this->Home_model->record_count_per_user_array());
        $data['donut'] = json_encode($this->Home_model->record_count_per_preferencie_array());
        $data['linechart'] = json_encode($this->Home_model->record_count_per_plat_array());
        $data['pocet'] = $this->Home_model->record_count();
        $data['studenti'] = $this->Home_model->record_count_studenti();
        $data['brigady'] = $this->Home_model->record_count_brigady();
        $data['zamestnavatelia'] = $this->Home_model->record_count_zamestnavatelia();
        $data['typ_brigady'] = $this->Home_model->record_count_typ_brigady();
        $this->load->view('common/header');
        $this->load->view('index', $data);
        $this->load->view('common/footer', $data);
    }

    // presmerovanie na prihlasenie
    public function login() {
        $this->load->view("login/index.php");
    }

    // presmerovanie na registraciu
    public function register() {
        $this->load->view("login/register.php");
    }

    // validacia zaslaných udajov pre login
    function login_validation() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            // true
            $username = $this->input->post('username');
            $password = $this->input->post("password");
            // model
            if ($this->Home_model->can_login($username, $password)) {
                $session_data = array(
                    'username' => $username
                );
                $this->session->set_userdata($session_data);
                redirect(base_url() . 'index.php/home/enter');
            } else {
                $this->session->set_flashdata('error', 'Zle použivateľské meno alebo heslo');
                redirect(base_url() . 'index.php/home/login');
            }
        } else {
            // false
            $this->login();
        }
    }

    // validácia zaslaných údajov pre registráciu
    function register_validation() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Password', 'required');
        if ($this->form_validation->run()) {
            // true
            $username = $this->input->post('username');
            $password = $this->input->post("password");
            $password2 = $this->input->post("password2");
            if ($password == $password2) {
                // model
                if ($this->Home_model->can_register($username, $password)) {
                    $this->session->set_flashdata('success','Boli ste zaregistrovaný');
                    redirect(base_url() . 'index.php/home/login');
                } else {
                    $this->session->set_flashdata('error','Použivatelské meno je už registrované!');
                    redirect(base_url() . 'index.php/home/register');
                }
            } else {
                $this->session->set_flashdata('error',"Heslá sa nerovnajú");
                redirect(base_url() . 'index.php/home/register');
            }
        } else {
            // false
            $this->register();
        }
    }

    // zisti či je niečo v session
    function enter() {
        if ($this->session->userdata('username') != '') {
            redirect(base_url() . 'index.php');
        } else {
            redirect(base_url() . 'index.php/home/login');
        }
    }

    // odhlasenie
    function logout() {
        $this->session->unset_userdata('username');
        redirect(base_url() . 'index.php/home/login');
    }
}
