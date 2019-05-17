<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 15.5.2019
 * Time: 17:32
 */

class Zrucnosti_model extends CI_Model
{
    public function __construct()
    {

    }

    function getRows($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('zručnosti', array('id_zrucnosti' => $id));
            return $query->row_array();
        } else {
            $query = $this->db->get('zručnosti');
            return $query->result_array();
        }
    }

    // vlozenie zaznamu
    public function insert($data = array())
    {
        $insert = $this->db->insert('zručnosti', $data);
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
            $update = $this->db->update('zručnosti', $data,
                array('id_zrucnosti' => $id));
            return $update ? true : false;
        } else {
            return false;
        }
    }

    // odstranenie zaznamu
    public function delete($id)
    {
        $delete = $this->db->delete('zručnosti', array('id_zrucnosti' => $id));
        return $delete ? true : false;
    }
}