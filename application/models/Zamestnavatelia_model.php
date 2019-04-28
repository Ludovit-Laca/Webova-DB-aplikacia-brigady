<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 27.4.2019
 * Time: 18:36
 */

class Zamestnavatelia_model extends CI_Model
{
    public function __construct()
    {

    }

    function getRows($id = "")
    {
        if (!empty($id)) {
           // $this->db->select('id_zamestnavatela, nazov, telefon, email');
            $query = $this->db->get_where('zamestnavatelia', array('id_zamestnavatela' => $id));
            return $query->row_array();
        } else {
            $query = $this->db->get('zamestnavatelia');
            return $query->result_array();
        }
    }

    // vlozenie zaznamu
    public function insert($data = array())
    {
        $insert = $this->db->insert('zamestnavatelia', $data);
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
            $update = $this->db->update('zamestnavatelia', $data,
                array('id_zamestnavatela' => $id));
            return $update ? true : false;
        } else {
            return false;
        }
    }

    // odstranenie zaznamu
    public function delete($id)
    {
        $delete = $this->db->delete('zamestnavatelia', array('id_zamestnavatela' => $id));
        return $delete ? true : false;
    }
}
?>