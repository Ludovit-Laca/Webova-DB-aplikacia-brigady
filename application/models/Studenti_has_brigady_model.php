<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 15.5.2019
 * Time: 16:13
 */

class Studenti_has_brigady_model extends CI_Model
{
    public function __construct()
    {

    }
    // vrati zoznam brigad Študentov
    function getRows($id= "") {
        if(!empty($id)){
            $this->db->select('id_študenti_has_brigady, odkedy, dokedy, hodinova_sadzba_studenta, odpracovane_hodiny, studenti_id_studenta, CONCAT(meno," ", priezvisko) as fullname, brigady_id_brigady, brigady.nazov as bnazov')
                ->join('študenti','studenti_id_studenta = študenti.id_študenta')
                ->join('brigady',' brigady.id_brigady = študenti_has_brigady.brigady_id_brigady');
            $query = $this->db->get_where('študenti_has_brigady', array('študenti_has_brigady.id_študenti_has_brigady' => $id));
            return $query->row_array();
        }else{
            $this->db->select('id_študenti_has_brigady, odkedy, dokedy, hodinova_sadzba_studenta, odpracovane_hodiny, studenti_id_studenta, CONCAT(meno," ", priezvisko) as fullname, brigady_id_brigady, brigady.nazov as bnazov')
                ->join('študenti','studenti_id_studenta = študenti.id_študenta')
                ->join('brigady',' brigady.id_brigady = študenti_has_brigady.brigady_id_brigady');
            $query = $this->db->get('študenti_has_brigady');
            return $query->result_array();
        }
    }

    // vlozenie zaznamu
    public function insert($data = array()) {
        $insert = $this->db->insert('študenti_has_brigady', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    // aktualizacia zaznamu
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('študenti_has_brigady', $data, array('id_študenti_has_brigady'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

    // odstranenie zaznamu
    public function delete($id){
        $delete = $this->db->delete('študenti_has_brigady',array('id_študenti_has_brigady'=>$id));
        return $delete?true:false;
    }

    //  naplnenie selectu z tabulky študenti
    public function get_users_dropdown($id = ""){
        $this->db->order_by('priezvisko')
            ->select('id_študenta, CONCAT(priezvisko," ",meno) AS fullname')
            ->from('študenti');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown)
            {
                $dropdownlist[$dropdown->id_študenta] = $dropdown->fullname;
            }
            $dropdownlist[''] = 'Vyberte študenta ... ';
            return $dropdownlist;
        }
    }

    //  naplnenie selectu z tabulky typ_brigady
    public function get_brigady_dropdown($id = ""){
        $this->db->order_by('nazov')
            ->select('id_brigady, nazov')
            ->from('brigady');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown)
            {
                $dropdownlist[$dropdown->id_brigady] = $dropdown->nazov;
            }
            $dropdownlist[''] = 'Vyberte brigádu ... ';
            return $dropdownlist;
        }
    }
}
?>