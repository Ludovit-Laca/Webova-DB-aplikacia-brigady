<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 14.5.2019
 * Time: 15:17
 */

class Brigady_model extends CI_Model
{
    public function __construct()
    {

    }
    // vrati zoznam brigad
    function getRows($id= "") {
        if(!empty($id)){
            $this->db->select('id_brigady, datum, brigady.nazov, hodinova_sadzba_brigada, provizia_agentury, CONCAT(aktualnost, " ") AS ak, popis, zamestnavatelia_id_zamestnavatela, zamestnavatelia.nazov AS zmeno, typ_brigady_id_typu,typ_brigady.nazov AS tmeno')
                ->join('zamestnavatelia','brigady.zamestnavatelia_id_zamestnavatela = zamestnavatelia.id_zamestnavatela')
                ->join('typ_brigady',' brigady.typ_brigady_id_typu = typ_brigady.id_typu');
            $query = $this->db->get_where('brigady', array('brigady.id_brigady' => $id));
            return $query->row_array();
        }else{
            $this->db->select('id_brigady, datum, brigady.nazov, hodinova_sadzba_brigada, provizia_agentury, CONCAT(aktualnost, " ") AS ak, popis, zamestnavatelia_id_zamestnavatela, zamestnavatelia.nazov AS zmeno, typ_brigady_id_typu,typ_brigady.nazov AS tmeno')
                ->join('zamestnavatelia','brigady.zamestnavatelia_id_zamestnavatela = zamestnavatelia.id_zamestnavatela')
                ->join('typ_brigady',' brigady.typ_brigady_id_typu = typ_brigady.id_typu');
            $query = $this->db->get('brigady');
            return $query->result_array();
        }
    }

    function findAll() {
        return $this->db->get('brigady')->result();
    }

    // vlozenie zaznamu
    public function insert($data = array()) {
        $insert = $this->db->insert('brigady', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    // aktualizacia zaznamu
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('brigady', $data, array('id_brigady'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

    // odstranenie zaznamu
    public function delete($id){
        $delete = $this->db->delete('brigady',array('id_brigady'=>$id));
        return $delete?true:false;
    }

    //  naplnenie selectu z tabulky
    public function get_users_dropdown($id = ""){
        $this->db->order_by('nazov')
            ->select('id_zamestnavatela, nazov')
            ->from('zamestnavatelia');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown)
            {
                $dropdownlist[$dropdown->id_zamestnavatela] = $dropdown->nazov;
            }
            $dropdownlist[''] = 'Vyberte študenta ... ';
            return $dropdownlist;
        }
    }

    //  naplnenie selectu z tabulky typ_brigady
    public function get_brigady_dropdown($id = ""){
        $this->db->order_by('nazov')
            ->select('id_typu, nazov')
            ->from('typ_brigady');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown)
            {
                $dropdownlist[$dropdown->id_typu] = $dropdown->nazov;
            }
            $dropdownlist[''] = 'Vyberte typ brigády ... ';
            return $dropdownlist;
        }
    }
}
?>