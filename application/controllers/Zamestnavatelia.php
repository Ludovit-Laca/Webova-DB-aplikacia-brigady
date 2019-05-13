<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 27.4.2019
 * Time: 18:43
 */

class Zamestnavatelia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Zamestnavatelia_model');
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
        $data['zamestnavatelia'] = $this->Zamestnavatelia_model->getRows();
        $data['title'] = 'Zamestnavatelia List';
        //nahratie zoznamu zamestnancov
         $this->load->view('common/header', $data);
        $this->load->view('zamestnavatelia/index', $data);
         $this->load->view('common/footer');
    }

    // Zobrazenie detailu o zamestnavatelovi
    public function view($id)
    {
        $data = array();
        // kontrola, ci bolo zaslane id riadka
        if (!empty($id)) {
            $data['zamestnavatelia'] = $this->Zamestnavatelia_model->getRows($id);
            $data['title'] = $data['zamestnavatelia']['nazov'];
            // nahratie detailu zaznamu
            $this->load->view('common/header', $data);
            $this->load->view('zamestnavatelia/view', $data);
            $this->load->view('common/footer');
        } else {
            redirect('/zamestnavatelia');

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


            $this->form_validation->set_rules('nazov', 'nazov zamestnavatela', 'trim|required|min_length[4]|max_length[12]');
            $this->form_validation->set_rules('telefon', 'telefon zamestnavatela', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('email', 'email zamestnavatela', 'required');
            // priprava dat pre vlozenie
            $postData = array(
                'nazov' => $this->input->post('nazov'),
                'telefon' => $this->input->post('telefon'),
                'email' => $this->input->post('email'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // vlozenie dat
                $insert = $this->Zamestnavatelia_model->insert($postData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Zamestnavatel has been added successfully.');
                    redirect('/zamestnavatelia');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['post'] = $postData;
        $data['title'] = 'Create Zamestnavatel';
        $data['action'] = 'Add';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('zamestnavatelia/add-edit', $data);
        $this->load->view('common/footer');
    }

    // aktualizacia dat
    public function edit($id)
    {
        $data = array();
        // ziskanie dat z tabulky
        $postData = $this->Zamestnavatelia_model->getRows($id);
        // zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('nazov', 'nazov zamestnavatela', 'trim|required|min_length[4]|max_length[12]');
            $this->form_validation->set_rules('telefon', 'telefon zamestnavatela', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('email', 'email zamestnavatela', 'required');
            // priprava dat pre aktualizaciu
            $postData = array(
                'nazov' => $this->input->post('nazov'),
                'telefon' => $this->input->post('telefon'),
                'email' => $this->input->post('email'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // aktualizacia dat
                $update = $this->Zamestnavatelia_model->update($postData, $id);
                if ($update) {
                    $this->session->set_userdata('success_msg', 'Zamestnavatel has been updated successfully.');
                    redirect('/zamestnavatelia');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['post'] = $postData;
        $data['title'] = 'Update Zamestnavatel';
        $data['action'] = 'Edit';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('zamestnavatelia/add-edit', $data);
        $this->load->view('common/footer');
    }

    // odstranenie dat
    public function delete($id)
    {
        // overenie, ci id nie je prazdne
        if ($id) {
            // odstranenie zaznamu
            $delete = $this->Zamestnavatelia_model->delete($id);
            if ($delete) {
                $this->session->set_userdata('success_msg', 'Zamestnavatel has been removed successfully.');
            } else {
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect('/zamestnavatelia');
    }
}
