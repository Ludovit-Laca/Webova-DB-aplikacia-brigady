<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 15.5.2019
 * Time: 20:29
 */

class Studenti_has_zrucnosti extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Studenti_has_zrucnosti_model');
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
        $data['studenti_has_zrucnosti'] = $this->Studenti_has_zrucnosti_model->getRows();
        $data['title'] = 'Zručnosti študentov List';
        //nahratie zoznamu kriterii
        $this->load->view('common/header', $data);
        $this->load->view('studenti_has_zrucnosti/index', $data);
        $this->load->view('common/footer');
    }

    // Zobrazenie detailu o kriteriach
    public function view($id)
    {
        $data = array();
        // kontrola, ci bolo zaslane id riadka
        if (!empty($id)) {
            $data['studenti_has_zrucnosti'] = $this->Studenti_has_zrucnosti_model->getRows($id);
            $data['title'] = $data['studenti_has_zrucnosti']['id_študenti_has_zručnosti'];
            // nahratie detailu zaznamu
            $this->load->view('common/header', $data);
            $this->load->view('studenti_has_zrucnosti/view', $data);
            $this->load->view('common/footer');
        } else {
            redirect('/studenti_has_zrucnosti');

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
            $this->form_validation->set_rules('zrucnosti_id_zrucnosti', 'názov zručnosti', 'required');
            // priprava dat pre vlozenie
            $postData = array(
                'studenti_id_studenta' => $this->input->post('studenti_id_studenta'),
                'zrucnosti_id_zrucnosti' => $this->input->post('zrucnosti_id_zrucnosti'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // vlozenie dat
                $insert = $this->Studenti_has_zrucnosti_model->insert($postData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Zručnosť študenta has been added successfully.');
                    redirect('/studenti_has_zrucnosti');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['users'] = $this->Studenti_has_zrucnosti_model->get_users_dropdown();
        $data['users_selected'] = '';
        $data['brigady'] = $this->Studenti_has_zrucnosti_model->get_brigady_dropdown();
        $data['brigady_selected'] = '';
        $data['post'] = $postData;
        $data['title'] = 'Create zručnosť študenta';
        $data['action'] = 'Nová zručnosť študenta';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('studenti_has_zrucnosti/add-edit', $data);
        $this->load->view('common/footer');
    }

    // aktualizacia dat
    public function edit($id)
    {
        $data = array();
        // ziskanie dat z tabulky
        $postData = $this->Studenti_has_zrucnosti_model->getRows($id);
        // zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('studenti_id_studenta', 'meno študenta', 'required');
            $this->form_validation->set_rules('zrucnosti_id_zrucnosti', 'názov zručnosti', 'required');
            // priprava dat pre aktualizaciu
            $postData = array(
                'studenti_id_studenta' => $this->input->post('studenti_id_studenta'),
                'zrucnosti_id_zrucnosti' => $this->input->post('zrucnosti_id_zrucnosti'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // aktualizacia dat
                $update = $this->Studenti_has_zrucnosti_model->update($postData, $id);
                if ($update) {
                    $this->session->set_userdata('success_msg', 'Zručnosť študenta has been updated successfully.');
                    redirect('/studenti_has_zrucnosti');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['users'] = $this->Studenti_has_zrucnosti_model->get_users_dropdown();
        $data['users_selected'] = $postData['studenti_id_studenta'];
        $data['brigady'] = $this->Studenti_has_zrucnosti_model->get_brigady_dropdown();
        $data['brigady_selected'] = $postData['zrucnosti_id_zrucnosti'];
        $data['post'] = $postData;
        $data['title'] = 'Update zručnosť študenta';
        $data['action'] = 'Uprav zručnosť študenta';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('studenti_has_zrucnosti/add-edit', $data);
        $this->load->view('common/footer');
    }

    // odstranenie dat
    public function delete($id)
    {
        // overenie, ci id nie je prazdne
        if ($id) {
            // odstranenie zaznamu
            $delete = $this->Studenti_has_zrucnosti_model->delete($id);
            if ($delete) {
                $this->session->set_userdata('success_msg', 'Zručnosť študenta has been removed successfully.');
            } else {
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect('/studenti_has_zrucnosti');
    }
}