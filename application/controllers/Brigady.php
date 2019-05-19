<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 14.5.2019
 * Time: 15:33
 */

class Brigady extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Brigady_model');
        $this->load->model('Home_model');
    }

    // zobrazenie hlavnej stránky brigady
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
        $data['brigady'] = $this->Brigady_model->getRows();
        $data['title'] = 'Brigady List';
        //nahratie zoznamu preferencií
        $this->load->view('common/header', $data);
        $this->load->view('brigady/index', $data);
        $this->load->view('common/footer');
    }

    // Zobrazenie detailu o brigadach
    public function view($id)
    {
        if ($this->session->userdata('username') != '') {
        } else {
            redirect(base_url() . 'index.php/home/login');
        }
        $data = array();
        // kontrola, ci bolo zaslane id riadka
        if (!empty($id)) {
            $data['help'] = json_encode($this->Home_model->record_count_per_user_array());
            $data['brigady'] = $this->Brigady_model->getRows($id);
            $data['title'] = $data['brigady']['id_brigady'];
            // nahratie detailu zaznamu
            $this->load->view('common/header', $data);
            $this->load->view('brigady/view', $data);
            $this->load->view('common/footer');
        } else {
            redirect('/brigady');

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
            $this->form_validation->set_rules('datum', 'dátum brigády', 'required');
            $this->form_validation->set_rules('nazov', 'názov brigády', 'trim|required|min_length[3]|max_length[40]');
            $this->form_validation->set_rules('hodinova_sadzba_brigada', 'hodinová sadzba', 'trim|required|min_length[1]|max_length[5]');
            $this->form_validation->set_rules('provizia_agentury', 'provízia agentúry', 'trim|required|min_length[1]|max_length[5]');
            $this->form_validation->set_rules('aktualnost', 'aktualnost', '');
            $this->form_validation->set_rules('popis', 'popis brigády', '');
            $this->form_validation->set_rules('zamestnavatelia_id_zamestnavatela', 'meno zamestnávateľa', 'required');
            $this->form_validation->set_rules('typ_brigady_id_typu', 'názov brigády', 'required');
            // priprava dat pre vlozenie
            $postData = array(
                'datum' => $this->input->post('datum'),
                'nazov' => $this->input->post('nazov'),
                'hodinova_sadzba_brigada' => $this->input->post('hodinova_sadzba_brigada'),
                'provizia_agentury' => $this->input->post('provizia_agentury'),
                'aktualnost' => $this->input->post('aktualnost'),
                'popis' => $this->input->post('popis'),
                'zamestnavatelia_id_zamestnavatela' => $this->input->post('zamestnavatelia_id_zamestnavatela'),
                'typ_brigady_id_typu' => $this->input->post('typ_brigady_id_typu'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // vlozenie dat
                $insert = $this->Brigady_model->insert($postData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Brigada has been added successfully.');
                    redirect('/brigady');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['help'] = json_encode($this->Home_model->record_count_per_user_array());
        $data['users'] = $this->Brigady_model->get_users_dropdown();
        $data['users_selected'] = '';
        $data['brigady'] = $this->Brigady_model->get_brigady_dropdown();
        $data['brigady_selected'] = '';
        $data['post'] = $postData;
        $data['title'] = 'Create brigada';
        $data['action'] = 'Nová brigáda';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('brigady/add-edit', $data);
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
        $postData = $this->Brigady_model->getRows($id);
        // zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            // definicia pravidiel validacie
            $this->form_validation->set_rules('datum', 'dátum brigády', 'required');
            $this->form_validation->set_rules('nazov', 'názov brigády', 'trim|required|min_length[3]|max_length[40]');
            $this->form_validation->set_rules('hodinova_sadzba_brigada', 'hodinová sadzba', 'trim|required|min_length[1]|max_length[5]');
            $this->form_validation->set_rules('provizia_agentury', 'provízia agentúry', 'trim|required|min_length[1]|max_length[5]');
            $this->form_validation->set_rules('aktualnost', 'aktualnost', 'required');
            $this->form_validation->set_rules('popis', 'popis brigády', '');
            $this->form_validation->set_rules('zamestnavatelia_id_zamestnavatela', 'meno zamestnávateľa', 'required');
            $this->form_validation->set_rules('typ_brigady_id_typu', 'názov brigády', 'required');
            // priprava dat pre aktualizaciu
            $postData = array(
                'datum' => $this->input->post('datum'),
                'nazov' => $this->input->post('nazov'),
                'hodinova_sadzba_brigada' => $this->input->post('hodinova_sadzba_brigada'),
                'provizia_agentury' => $this->input->post('provizia_agentury'),
                'aktualnost' => $this->input->post('aktualnost'),
                'popis' => $this->input->post('popis'),
                'zamestnavatelia_id_zamestnavatela' => $this->input->post('zamestnavatelia_id_zamestnavatela'),
                'typ_brigady_id_typu' => $this->input->post('typ_brigady_id_typu'),
            );
            // validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                // aktualizacia dat
                $update = $this->Brigady_model->update($postData, $id);
                if ($update) {
                    $this->session->set_userdata('success_msg', 'Brigada has been updated successfully.');
                    redirect('/brigady');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['help'] = json_encode($this->Home_model->record_count_per_user_array());
        $data['users'] = $this->Brigady_model->get_users_dropdown();
        $data['users_selected'] = $postData['zamestnavatelia_id_zamestnavatela'];
        $data['brigady'] = $this->Brigady_model->get_brigady_dropdown();
        $data['brigady_selected'] = $postData['typ_brigady_id_typu'];
        $data['post'] = $postData;
        $data['title'] = 'Update brigada';
        $data['action'] = 'Uprav brigádu';
        // zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('common/header', $data);
        $this->load->view('brigady/add-edit', $data);
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
            $delete = $this->Brigady_model->delete($id);
            if ($delete) {
                $this->session->set_userdata('success_msg', 'Brigada has been removed successfully.');
            } else {
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }
        redirect('/brigady');
    }
}