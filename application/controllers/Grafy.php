<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 18.5.2019
 * Time: 15:14
 */

class Grafy extends CI_Controller
{
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
        $data['donut2'] = json_encode($this->Home_model->record_count_per_user_array_donut());
        $data['linechart'] = json_encode($this->Home_model->record_count_per_plat_array());
        $data['barzamestnavatelia'] = json_encode($this->Home_model->record_count_per_zamestnavatel_array());
        $this->load->view('common/header');
        $this->load->view('grafy/index', $data);
        $this->load->view('common/footer', $data);
    }


}