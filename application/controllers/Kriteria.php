<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 15.5.2019
 * Time: 18:16
 */

class Kriteria extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Kriteria_model');
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
        $data['kriteria'] = $this->Kriteria_model->getRows();
        $data['title'] = 'Kriteria List';
        //nahratie zoznamu kriterii
        $this->load->view('common/header', $data);
        $this->load->view('kriteria/index', $data);
        $this->load->view('common/footer');
    }

    // Zobrazenie detailu o kriteriach
    public function view($id)
    {
        $data = array();
        // kontrola, ci bolo zaslane id riadka
        if (!empty($id)) {
            $data['kriteria'] = $this->Kriteria_model->getRows($id);
            $data['title'] = $data['kriteria']['id_kriteria'];
            // nahratie detailu zaznamu
            $this->load->view('common/header', $data);
            $this->load->view('kriteria/view', $data);
            $this->load->view('common/footer');
        } else {
            redirect('/kriteria');

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
            $this->form_validation->set_rules('brigady_id_brigady', 'názov brigády', 'required');
            $this->form_validation->set_rules('zručnosti_id_zručnosti', 'názov zručnosti', 'required');
            // priprava dat pre vlozenie
            $postData = array(
                'brigady_id_brigady' => $this->input->post('brigady_id_brigady'),
                'zručnosti_id_zručnosti' => $this->input->post('zručnosti_id_zručnosti'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // vlozenie dat
                $insert = $this->Kriteria_model->insert($postData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Kritérium has been added successfully.');
                    redirect('/kriteria');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['users'] = $this->Kriteria_model->get_users_dropdown();
        $data['users_selected'] = '';
        $data['brigady'] = $this->Kriteria_model->get_brigady_dropdown();
        $data['brigady_selected'] = '';
        $data['post'] = $postData;
        $data['title'] = 'Create zručnosť';
        $data['action'] = 'Add';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('kriteria/add-edit', $data);
        $this->load->view('common/footer');
    }

    // aktualizacia dat
    public function edit($id)
    {
        $data = array();
        // ziskanie dat z tabulky
        $postData = $this->Kriteria_model->getRows($id);
        // zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('brigady_id_brigady', 'názov brigády', 'required');
            $this->form_validation->set_rules('zručnosti_id_zručnosti', 'názov zručnosti', 'required');
            // priprava dat pre aktualizaciu
            $postData = array(
                'brigady_id_brigady' => $this->input->post('brigady_id_brigady'),
                'zručnosti_id_zručnosti' => $this->input->post('zručnosti_id_zručnosti'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // aktualizacia dat
                $update = $this->Kriteria_model->update($postData, $id);
                if ($update) {
                    $this->session->set_userdata('success_msg', 'Kritérium has been updated successfully.');
                    redirect('/kriteria');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['users'] = $this->Kriteria_model->get_users_dropdown();
        $data['users_selected'] = $postData['brigady_id_brigady'];
        $data['brigady'] = $this->Kriteria_model->get_brigady_dropdown();
        $data['brigady_selected'] = $postData['zručnosti_id_zručnosti'];
        $data['post'] = $postData;
        $data['title'] = 'Update kritérium';
        $data['action'] = 'Edit';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('kriteria/add-edit', $data);
        $this->load->view('common/footer');
    }

    // odstranenie dat
    public function delete($id)
    {
        // overenie, ci id nie je prazdne
        if ($id) {
            // odstranenie zaznamu
            $delete = $this->Kriteria_model->delete($id);
            if ($delete) {
                $this->session->set_userdata('success_msg', 'Kritérium has been removed successfully.');
            } else {
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect('/kriteria');
    }
}