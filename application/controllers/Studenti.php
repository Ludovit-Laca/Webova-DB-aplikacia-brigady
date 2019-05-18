<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 6.5.2019
 * Time: 17:52
 */

class Studenti extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Studenti_model');
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
        $data['studenti'] = $this->Studenti_model->getRows();
        $data['title'] = 'Študenti List';
        //nahratie zoznamu zamestnancov
        $this->load->view('common/header', $data);
        $this->load->view('študenti/index', $data);
        $this->load->view('common/footer');
    }

    // Zobrazenie detailu o študentovi
    public function view($id)
    {
        $data = array();
        // kontrola, ci bolo zaslane id riadka
        if (!empty($id)) {
            $data['studenti'] = $this->Studenti_model->getRows($id);
            $data['title'] = $data['studenti']['meno'];
            // nahratie detailu zaznamu
            $this->load->view('common/header', $data);
            $this->load->view('študenti/view', $data);
            $this->load->view('common/footer');
        } else {
            redirect('/studenti');

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
            $this->form_validation->set_rules('meno', 'meno študenta', 'trim|required|min_length[3]|max_length[12]');
            $this->form_validation->set_rules('priezvisko', 'priezvisko študenta', 'trim|required|min_length[3]|max_length[12]');
            $this->form_validation->set_rules('telefon', 'telefon študenta', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('adresa', 'adresa študenta', 'trim|required|min_length[4]|max_length[50]');
            // priprava dat pre vlozenie
            $postData = array(
                'meno' => $this->input->post('meno'),
                'priezvisko' => $this->input->post('priezvisko'),
                'telefon' => $this->input->post('telefon'),
                'adresa' => $this->input->post('adresa'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // vlozenie dat
                $insert = $this->Studenti_model->insert($postData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Študent has been added successfully.');
                    redirect('/studenti');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['post'] = $postData;
        $data['title'] = 'Create Študent';
        $data['action'] = 'Nový študent';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('študenti/add-edit', $data);
        $this->load->view('common/footer');
    }

    // aktualizacia dat
    public function edit($id)
    {
        $data = array();
        // ziskanie dat z tabulky
        $postData = $this->Studenti_model->getRows($id);
        // zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('meno', 'meno študenta', 'trim|required|min_length[3]|max_length[12]');
            $this->form_validation->set_rules('priezvisko', 'priezvisko študenta', 'trim|required|min_length[3]|max_length[12]');
            $this->form_validation->set_rules('telefon', 'telefon študenta', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('adresa', 'adresa študenta', 'trim|required|min_length[4]|max_length[50]');
            // priprava dat pre aktualizaciu
            $postData = array(
                'meno' => $this->input->post('meno'),
                'priezvisko' => $this->input->post('priezvisko'),
                'telefon' => $this->input->post('telefon'),
                'adresa' => $this->input->post('adresa'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // aktualizacia dat
                $update = $this->Studenti_model->update($postData, $id);
                if ($update) {
                    $this->session->set_userdata('success_msg', 'Študent has been updated successfully.');
                    redirect('/studenti');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['post'] = $postData;
        $data['title'] = 'Update Študent';
        $data['action'] = 'Uprav študenta';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('študenti/add-edit', $data);
        $this->load->view('common/footer');
    }

    // odstranenie dat
    public function delete($id)
    {
        // overenie, ci id nie je prazdne
        if ($id) {
            // odstranenie zaznamu
            $delete = $this->Studenti_model->delete($id);
            if ($delete) {
                $this->session->set_userdata('success_msg', 'Študent has been removed successfully.');
            } else {
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect('/studenti');
    }
}
