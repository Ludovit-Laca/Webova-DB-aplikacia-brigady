<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 13.5.2019
 * Time: 16:57
 */

class Preferencie_model extends CI_Model
{
    public function __construct()
    {

    }

    // vrati zoznam preferencii
    function getRows($id = "")
    {
        if (!empty($id)) {
            $this->db->select('id_preferencie, studenti_id_studenta, CONCAT(meno," ", priezvisko) as fullname, typ_brigady_id_typu, nazov')
                ->join('študenti', 'preferencie.studenti_id_studenta = študenti.id_študenta')
                ->join('typ_brigady', 'preferencie.typ_brigady_id_typu = typ_brigady.id_typu');
            $query = $this->db->get_where('preferencie', array('preferencie.id_preferencie' => $id));
            return $query->row_array();
        } else {
            $this->db->select('id_preferencie, studenti_id_studenta, CONCAT(meno," ", priezvisko) as fullname, typ_brigady_id_typu, nazov')
                ->join('študenti', 'preferencie.studenti_id_studenta = študenti.id_študenta')
                ->join('typ_brigady', 'preferencie.typ_brigady_id_typu = typ_brigady.id_typu');
            $query = $this->db->get('preferencie');
            return $query->result_array();
        }
    }

    // vlozenie zaznamu
    public function insert($data = array())
    {
        $insert = $this->db->insert('preferencie', $data);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    // aktualizacia zaznamu
    public function update($data, $id)
    {
        if (!empty($data) && !empty($id)) {
            $update = $this->db->update('preferencie', $data, array('id_preferencie' => $id));
            return $update ? true : false;
        } else {
            return false;
        }
    }

    // odstranenie zaznamu
    public function delete($id)
    {
        $delete = $this->db->delete('preferencie', array('id_preferencie' => $id));
        return $delete ? true : false;
    }

    //  naplnenie selectu z tabulky študenti
    public function get_users_dropdown($id = "")
    {
        $this->db->order_by('priezvisko')
            ->select('id_študenta, CONCAT(priezvisko," ",meno) AS fullname')
            ->from('študenti');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown) {
                $dropdownlist[$dropdown->id_študenta] = $dropdown->fullname;
            }
            $dropdownlist[''] = 'Vyberte študenta ... ';
            return $dropdownlist;
        }
    }

    //  naplnenie selectu z tabulky typ_brigady
    public function get_brigady_dropdown($id = "")
    {
        $this->db->order_by('nazov')
            ->select('id_typu, nazov')
            ->from('typ_brigady');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown) {
                $dropdownlist[$dropdown->id_typu] = $dropdown->nazov;
            }
            $dropdownlist[''] = 'Vyberte typ brigády ... ';
            return $dropdownlist;
        }
    }

    // pocet vsetky zaznamov pre strankovanie
    public function record_count()
    {
        return $this->db->count_all("preferencie");
    }
}

?>