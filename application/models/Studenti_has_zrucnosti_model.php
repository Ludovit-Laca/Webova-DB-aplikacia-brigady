<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 15.5.2019
 * Time: 20:03
 */

class Studenti_has_zrucnosti_model extends CI_Model
{
    public function __construct()
    {

    }
    // vrati zoznam zručnosti študentov
    function getRows($id= "") {
        if(!empty($id)){
            $this->db->select('id_študenti_has_zručnosti, studenti_id_studenta, CONCAT(meno," ", priezvisko) as fullname, zrucnosti_id_zrucnosti, zručnosti.nazov as zrNazov ')
                ->join('študenti','studenti_id_studenta = študenti.id_študenta')
                ->join('zručnosti','zrucnosti_id_zrucnosti = zručnosti.id_zrucnosti');
            $query = $this->db->get_where('študenti_has_zručnosti', array('id_študenti_has_zručnosti' => $id));
            return $query->row_array();
        }else{
            $this->db->select('id_študenti_has_zručnosti, studenti_id_studenta, CONCAT(meno," ", priezvisko) as fullname, zrucnosti_id_zrucnosti, zručnosti.nazov  as zrNazov')
                ->join('študenti','studenti_id_studenta = študenti.id_študenta')
                ->join('zručnosti','zrucnosti_id_zrucnosti = zručnosti.id_zrucnosti');
            $query = $this->db->get('študenti_has_zručnosti');
            return $query->result_array();
        }
    }

    // vlozenie zaznamu
    public function insert($data = array()) {
        $insert = $this->db->insert('študenti_has_zručnosti', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    // aktualizacia zaznamu
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('študenti_has_zručnosti', $data, array('id_študenti_has_zručnosti'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

    // odstranenie zaznamu
    public function delete($id){
        $delete = $this->db->delete('študenti_has_zručnosti',array('id_študenti_has_zručnosti'=>$id));
        return $delete?true:false;
    }

    //  naplnenie selectu z tabulky študentov
    public function get_users_dropdown($id = ""){
        $this->db->order_by('priezvisko')
            ->select('id_študenta, CONCAT(meno," ", priezvisko) as fullname')
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

    //  naplnenie selectu z tabulky zručnosti
    public function get_brigady_dropdown($id = ""){
        $this->db->order_by('nazov')
            ->select('id_zrucnosti, nazov')
            ->from('zručnosti');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown)
            {
                $dropdownlist[$dropdown->id_zrucnosti] = $dropdown->nazov;
            }
            $dropdownlist[''] = 'Vyberte zručnosť ... ';
            return $dropdownlist;
        }
    }
}