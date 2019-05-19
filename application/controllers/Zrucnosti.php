<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 15.5.2019
 * Time: 17:35
 */

class Zrucnosti extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Zrucnosti_model');
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
        $data['zrucnosti'] = $this->Zrucnosti_model->getRows();
        $data['title'] = 'Zrucnosti List';
        //nahratie zoznamu zamestnancov
        $this->load->view('common/header', $data);
        $this->load->view('zrucnosti/index', $data);
        $this->load->view('common/footer');
    }

    // Zobrazenie detailu o zručnostiach
    public function view($id)
    {
        if ($this->session->userdata('username') != '') {
        } else {
            redirect(base_url() . 'index.php/home/login');
        }
        $data = array();
        // kontrola, ci bolo zaslane id riadka
        if (!empty($id)) {
            $data['zrucnosti'] = $this->Zrucnosti_model->getRows($id);
            $data['title'] = $data['zrucnosti']['nazov'];
            // nahratie detailu zaznamu
            $this->load->view('common/header', $data);
            $this->load->view('zrucnosti/view', $data);
            $this->load->view('common/footer');
        } else {
            redirect('/zrucnosti');

        }
    }

    // pridanie zaznamu
    public function add()
    {
        if ($this->session->userdata('username') != '') {
        } else {
            redirect(base_url() . 'index.php/home/login');
        }
        $data = array();
        $postData = array();
        //zistenie, ci bola zaslana poziadavka na pridanie zaznamu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('nazov', 'nazov zrucnosti', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('popis', 'popis zrucnosti', '');
            // priprava dat pre vlozenie
            $postData = array(
                'nazov' => $this->input->post('nazov'),
                'popis' => $this->input->post('popis'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // vlozenie dat
                $insert = $this->Zrucnosti_model->insert($postData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Zrucnosti has been added successfully.');
                    redirect('/zrucnosti');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['post'] = $postData;
        $data['title'] = 'Create Zručnosť';
        $data['action'] = 'Nová zručnosť';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('zrucnosti/add-edit', $data);
        $this->load->view('common/footer');
    }

    // aktualizacia dat
    public function edit($id)
    {
        if ($this->session->userdata('username') != '') {
        } else {
            redirect(base_url() . 'index.php/home/login');
        }
        $data = array();
        // ziskanie dat z tabulky
        $postData = $this->Zrucnosti_model->getRows($id);
        // zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('nazov', 'nazov zrucnosti', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('popis', 'popis zrucnosti', '');
            // priprava dat pre aktualizaciu
            $postData = array(
                'nazov' => $this->input->post('nazov'),
                'popis' => $this->input->post('popis'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // aktualizacia dat
                $update = $this->Zrucnosti_model->update($postData, $id);
                if ($update) {
                    $this->session->set_userdata('success_msg', 'Zručnosť has been updated successfully.');
                    redirect('/zrucnosti');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['post'] = $postData;
        $data['title'] = 'Update Zručnosť';
        $data['action'] = 'Uprav zručnosť';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('zrucnosti/add-edit', $data);
        $this->load->view('common/footer');
    }

    // odstranenie dat
    public function delete($id)
    {
        if ($this->session->userdata('username') != '') {
        } else {
            redirect(base_url() . 'index.php/home/login');
        }
        // overenie, ci id nie je prazdne
        if ($id) {
            // odstranenie zaznamu
            $delete = $this->Zrucnosti_model->delete($id);
            if ($delete) {
                $this->session->set_userdata('success_msg', 'Zručnosť has been removed successfully.');
            } else {
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect('/zrucnosti');
    }
}