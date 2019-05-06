<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 6.5.2019
 * Time: 17:48
 */

class Studenti_model extends CI_Model
{
    public function __construct()
    {

    }

    function getRows($id = "")
    {
        if (!empty($id)) {
            $this->db->select('id_študenta, meno, priezvisko, telefon, adresa');
            $query = $this->db->get_where('študenti', array('id_študenta' => $id));
            return $query->row_array();
        } else {
            $query = $this->db->get('študenti');
            return $query->result_array();
        }
    }

    // vlozenie zaznamu
    public function insert($data = array())
    {
        $insert = $this->db->insert('študenti', $data);
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
            $update = $this->db->update('študenti', $data,
                array('id_študenta' => $id));
            return $update ? true : false;
        } else {
            return false;
        }
    }

    // odstranenie zaznamu
    public function delete($id)
    {
        $delete = $this->db->delete('študenti', array('id_študenta' => $id));
        return $delete ? true : false;
    }
}
?>