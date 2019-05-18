<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 13.5.2019
 * Time: 15:04
 */

class Typ_brigady extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('TypBrigady_model');
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
        $data['typ_brigady'] = $this->TypBrigady_model->getRows();
        $data['title'] = 'typ_brigady List';
        //nahratie zoznamu typBrigady
        $this->load->view('common/header', $data);
        $this->load->view('typ_brigady/index', $data);
        $this->load->view('common/footer');
    }

    // Zobrazenie detailu o type brigady
    public function view($id)
    {
        $data = array();
        // kontrola, ci bolo zaslane id riadka
        if (!empty($id)) {
            $data['typ_brigady'] = $this->TypBrigady_model->getRows($id);
            $data['title'] = $data['typ_brigady']['nazov'];
            // nahratie detailu zaznamu
            $this->load->view('common/header', $data);
            $this->load->view('typ_brigady/view', $data);
            $this->load->view('common/footer');
        } else {
            redirect('/typ_brigady');

        }
    }

    // pridanie zaznamu
    public function add()
    {
        $data = array();
        $postData = array();
        //zistenie, ci bola zaslana poziadavka na pridanie zaznamu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('nazov', 'Typ brigády', 'trim|required|min_length[3]|max_length[30]');
            // priprava dat pre vlozenie
            $postData = array(
                'nazov' => $this->input->post('nazov'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // vlozenie dat
                $insert = $this->TypBrigady_model->insert($postData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Typ brigády has been added successfully.');
                    redirect('/typ_brigady');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['post'] = $postData;
        $data['title'] = 'Create typ brigády';
        $data['action'] = 'Nový typ brigády';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('typ_brigady/add-edit', $data);
        $this->load->view('common/footer');
    }

    // aktualizacia dat
    public function edit($id)
    {
        $data = array();
        // ziskanie dat z tabulky
        $postData = $this->TypBrigady_model->getRows($id);
        // zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('nazov', 'Typ brigády', 'trim|required|min_length[3]|max_length[30]');
            // priprava dat pre aktualizaciu
            $postData = array(
                'nazov' => $this->input->post('nazov'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // aktualizacia dat
                $update = $this->TypBrigady_model->update($postData, $id);
                if ($update) {
                    $this->session->set_userdata('success_msg', 'Typ brigády has been updated successfully.');
                    redirect('/typ_brigady');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['post'] = $postData;
        $data['title'] = 'Update typ brigády';
        $data['action'] = 'Uprav typ brigády';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('typ_brigady/add-edit', $data);
        $this->load->view('common/footer');
    }

    // odstranenie dat
    public function delete($id)
    {
        // overenie, ci id nie je prazdne
        if ($id) {
            // odstranenie zaznamu
            $delete = $this->TypBrigady_model->delete($id);
            if ($delete) {
                $this->session->set_userdata('success_msg', 'Typ brigády has been removed successfully.');
            } else {
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect('/typ_brigady');
    }
}