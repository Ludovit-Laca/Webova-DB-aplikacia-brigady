<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
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

    public function data() {
        echo json_encode($this->Home_model->record_count_per_user_array());
    }
}
