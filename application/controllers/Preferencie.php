<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 13.5.2019
 * Time: 18:09
 */

class Preferencie extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Preferencie_model');
        $this->load->model('Home_model');
    }

    public function data() {
        print_r($this->Preferencie_model->record_count_per_user_array()) ;
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
        $data['preferencie'] = $this->Preferencie_model->getRows();
        $data['pocet'] = $this->Preferencie_model->record_count ();
        $data['title'] = 'Preferencie List';
        //nahratie zoznamu preferencií
        $this->load->view('common/header', $data);
        $this->load->view('preferencie/index', $data);
        $this->load->view('common/footer');
    }

    // Zobrazenie detailu o preferenciach
    public function view($id)
    {
        $data = array();
        // kontrola, ci bolo zaslane id riadka
        if (!empty($id)) {
            $data['donut'] = json_encode($this->Home_model->record_count_per_preferencie_array());
            $data['preferencie'] = $this->Preferencie_model->getRows($id);
            $data['title'] = $data['preferencie']['id_preferencie'];
            // nahratie detailu zaznamu
            $this->load->view('common/header', $data);
            $this->load->view('preferencie/view', $data);
            $this->load->view('common/footer');
        } else {
            redirect('/preferencie');

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
            $this->form_validation->set_rules('studenti_id_studenta', 'meno študenta', 'required');
            $this->form_validation->set_rules('typ_brigady_id_typu', 'názov brigády', 'required');
            // priprava dat pre vlozenie
            $postData = array(
                'studenti_id_studenta' => $this->input->post('studenti_id_studenta'),
                'typ_brigady_id_typu' => $this->input->post('typ_brigady_id_typu'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // vlozenie dat
                $insert = $this->Preferencie_model->insert($postData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Preferencia has been added successfully.');
                    redirect('/preferencie');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['donut'] = json_encode($this->Home_model->record_count_per_preferencie_array());
        $data['users'] = $this->Preferencie_model->get_users_dropdown();
        $data['users_selected'] = '';
        $data['brigady'] = $this->Preferencie_model->get_brigady_dropdown();
        $data['brigady_selected'] = '';
        $data['post'] = $postData;
        $data['title'] = 'Create preferencia';
        $data['action'] = 'Nová preferencia študenta';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('preferencie/add-edit', $data);
        $this->load->view('common/footer');
    }

    // aktualizacia dat
    public function edit($id)
    {
        $data = array();
        // ziskanie dat z tabulky
        $postData = $this->Preferencie_model->getRows($id);
        // zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('studenti_id_studenta', 'meno študenta', 'required');
            $this->form_validation->set_rules('typ_brigady_id_typu', 'názov brigády', 'required');
            // priprava dat pre aktualizaciu
            $postData = array(
                'studenti_id_studenta' => $this->input->post('studenti_id_studenta'),
                'typ_brigady_id_typu' => $this->input->post('typ_brigady_id_typu'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // aktualizacia dat
                $update = $this->Preferencie_model->update($postData, $id);
                if ($update) {
                    $this->session->set_userdata('success_msg', 'Preferencia has been updated successfully.');
                    redirect('/preferencie');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['donut'] = json_encode($this->Home_model->record_count_per_preferencie_array());
        $data['users'] = $this->Preferencie_model->get_users_dropdown();
        $data['users_selected'] = $postData['studenti_id_studenta'];
        $data['brigady'] = $this->Preferencie_model->get_brigady_dropdown();
        $data['brigady_selected'] = $postData['typ_brigady_id_typu'];
        $data['post'] = $postData;
        $data['title'] = 'Update preferencia';
        $data['action'] = 'Uprav preferenciu študenta';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('preferencie/add-edit', $data);
        $this->load->view('common/footer');
    }

    // odstranenie dat
    public function delete($id)
    {
        // overenie, ci id nie je prazdne
        if ($id) {
            // odstranenie zaznamu
            $delete = $this->Preferencie_model->delete($id);
            if ($delete) {
                $this->session->set_userdata('success_msg', 'Preferencia has been removed successfully.');
            } else {
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect('/preferencie');
    }
}