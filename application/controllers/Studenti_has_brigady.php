<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 15.5.2019
 * Time: 16:28
 */

class Studenti_has_brigady extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Studenti_has_brigady_model');
    }

    public function data() {
        print_r($this->Studenti_has_brigady_model->record_count_per_user_array()) ;
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
        $data['studenti_has_brigady'] = $this->Studenti_has_brigady_model->getRows();
        $data['title'] = 'Brigády študentov List';
        //nahratie zoznamu preferencií
        $this->load->view('common/header', $data);
        $this->load->view('studenti_has_brigady/index', $data);
        $this->load->view('common/footer');
    }

    // Zobrazenie detailu o brigádach študentov
    public function view($id)
    {
        $data = array();
        // kontrola, ci bolo zaslane id riadka
        if (!empty($id)) {
            $data['studenti_has_brigady'] = $this->Studenti_has_brigady_model->getRows($id);
            $data['title'] = $data['studenti_has_brigady']['id_študenti_has_brigady'];
            // nahratie detailu zaznamu
            $this->load->view('common/header', $data);
            $this->load->view('studenti_has_brigady/view', $data);
            $this->load->view('common/footer');
        } else {
            redirect('/studenti_has_brigady');

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
            $this->form_validation->set_rules('odkedy', 'dátum nástupu', 'required');
            $this->form_validation->set_rules('dokedy', 'dátum ukončenia', 'required');
            $this->form_validation->set_rules('hodinova_sadzba_studenta', 'hodinova sadzba studenta', 'required');
            $this->form_validation->set_rules('odpracovane_hodiny', 'odpracované hodiny', 'required');
            $this->form_validation->set_rules('studenti_id_studenta', 'meno študenta', 'required');
            $this->form_validation->set_rules('brigady_id_brigady', 'názov brigády', 'required');
            // priprava dat pre vlozenie
            $postData = array(
                'odkedy' => $this->input->post('odkedy'),
                'dokedy' => $this->input->post('dokedy'),
                'hodinova_sadzba_studenta' => $this->input->post('hodinova_sadzba_studenta'),
                'odpracovane_hodiny' => $this->input->post('odpracovane_hodiny'),
                'studenti_id_studenta' => $this->input->post('studenti_id_studenta'),
                'brigady_id_brigady' => $this->input->post('brigady_id_brigady'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // vlozenie dat
                $insert = $this->Studenti_has_brigady_model->insert($postData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Brigáda študenta has been added successfully.');
                    redirect('/studenti_has_brigady');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['users'] = $this->Studenti_has_brigady_model->get_users_dropdown();
        $data['users_selected'] = '';
        $data['brigady'] = $this->Studenti_has_brigady_model->get_brigady_dropdown();
        $data['brigady_selected'] = '';
        $data['post'] = $postData;
        $data['title'] = 'Create brigáda študenta';
        $data['action'] = 'Nová študentská brigáda';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('studenti_has_brigady/add-edit', $data);
        $this->load->view('common/footer');
    }

    // aktualizacia dat
    public function edit($id)
    {
        $data = array();
        // ziskanie dat z tabulky
        $postData = $this->Studenti_has_brigady_model->getRows($id);
        // zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('odkedy', 'dátum nástupu', 'required');
            $this->form_validation->set_rules('dokedy', 'dátum ukončenia', 'required');
            $this->form_validation->set_rules('hodinova_sadzba_studenta', 'hodinova sadzba studenta', 'required');
            $this->form_validation->set_rules('odpracovane_hodiny', 'odpracované hodiny', 'required');
            $this->form_validation->set_rules('studenti_id_studenta', 'meno študenta', 'required');
            $this->form_validation->set_rules('brigady_id_brigady', 'názov brigády', 'required');
            // priprava dat pre aktualizaciu
            $postData = array(
                'odkedy' => $this->input->post('odkedy'),
                'dokedy' => $this->input->post('dokedy'),
                'hodinova_sadzba_studenta' => $this->input->post('hodinova_sadzba_studenta'),
                'odpracovane_hodiny' => $this->input->post('odpracovane_hodiny'),
                'studenti_id_studenta' => $this->input->post('studenti_id_studenta'),
                'brigady_id_brigady' => $this->input->post('brigady_id_brigady'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // aktualizacia dat
                $update = $this->Studenti_has_brigady_model->update($postData, $id);
                if ($update) {
                    $this->session->set_userdata('success_msg', 'Brigáda študenta has been updated successfully.');
                    redirect('/studenti_has_brigady');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['users'] = $this->Studenti_has_brigady_model->get_users_dropdown();
        $data['users_selected'] = $postData['studenti_id_studenta'];
        $data['brigady'] = $this->Studenti_has_brigady_model->get_brigady_dropdown();
        $data['brigady_selected'] = $postData['brigady_id_brigady'];
        $data['post'] = $postData;
        $data['title'] = 'Update brigáda študeta';
        $data['action'] = 'Uprav študentskú brigádu';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('studenti_has_brigady/add-edit', $data);
        $this->load->view('common/footer');
    }

    // odstranenie dat
    public function delete($id)
    {
        // overenie, ci id nie je prazdne
        if ($id) {
            // odstranenie zaznamu
            $delete = $this->Studenti_has_brigady_model->delete($id);
            if ($delete) {
                $this->session->set_userdata('success_msg', 'Brigáda študenta has been removed successfully.');
            } else {
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect('/studenti_has_brigady');
    }
}