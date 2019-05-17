<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 15.5.2019
 * Time: 18:04
 */

class Kriteria_model extends CI_Model
{
    public function __construct()
    {

    }
    // vrati zoznam kriterii
    function getRows($id= "") {
        if(!empty($id)){
            $this->db->select('id_kriteria, brigady_id_brigady, brigady.nazov as brNazov, zručnosti_id_zručnosti, zručnosti.nazov as zrNazov')
                ->join('brigady','brigady.id_brigady = kriteria.brigady_id_brigady')
                ->join('zručnosti','id_zrucnosti = kriteria.zručnosti_id_zručnosti');
            $query = $this->db->get_where('kriteria', array('kriteria.id_kriteria' => $id));
            return $query->row_array();
        }else{
            $this->db->select('id_kriteria, brigady_id_brigady, brigady.nazov as brNazov, zručnosti_id_zručnosti, zručnosti.nazov as zrNazov')
                ->join('brigady','brigady.id_brigady = kriteria.brigady_id_brigady')
                ->join('zručnosti','id_zrucnosti = kriteria.zručnosti_id_zručnosti');
            $query = $this->db->get('kriteria');
            return $query->result_array();
        }
    }

    // vlozenie zaznamu
    public function insert($data = array()) {
        $insert = $this->db->insert('kriteria', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    // aktualizacia zaznamu
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('kriteria', $data, array('id_kriteria'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

    // odstranenie zaznamu
    public function delete($id){
        $delete = $this->db->delete('kriteria',array('id_kriteria'=>$id));
        return $delete?true:false;
    }

    //  naplnenie selectu z tabulky brigady
    public function get_users_dropdown($id = ""){
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
            $dropdownlist[''] = 'Vyberte brigadu ... ';
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