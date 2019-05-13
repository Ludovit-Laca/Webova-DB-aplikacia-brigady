<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 13.5.2019
 * Time: 15:06
 */

class TypBrigady_model extends CI_Model
{
    public function __construct()
    {

    }

    function getRows($id = "")
    {
        if (!empty($id)) {
            $this->db->select('id_typu, nazov');
            $query = $this->db->get_where('typ_brigady', array('id_typu' => $id));
            return $query->row_array();
        } else {
            $query = $this->db->get('typ_brigady');
            return $query->result_array();
        }
    }

    // vlozenie zaznamu
    public function insert($data = array())
    {
        $insert = $this->db->insert('typ_brigady', $data);
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
            $update = $this->db->update('typ_brigady', $data,
                array('id_typu' => $id));
            return $update ? true : false;
        } else {
            return false;
        }
    }

    // odstranenie zaznamu
    public function delete($id)
    {
        $delete = $this->db->delete('typ_brigady', array('id_typu' => $id));
        return $delete ? true : false;
    }
}
?>