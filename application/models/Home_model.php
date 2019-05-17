<?php
/**
 * Created by PhpStorm.
 * User: lacal
 * Date: 16.5.2019
 * Time: 23:19
 */

class Home_model extends CI_Model
{
    public function __construct()
    {

    }

    // pocet vsetky zaznamov pre preferencie
    public function record_count (){
        return $this->db->count_all("preferencie");
    }

    // pocet vsetky zaznamov pre študentov
    public function record_count_studenti (){
        return $this->db->count_all("študenti");
    }

    // pocet vsetky zaznamov pre brigády
    public function record_count_brigady (){
        return $this->db->count_all("brigady");
    }

    // pocet vsetky zaznamov pre zamestnávateľov
    public function record_count_zamestnavatelia (){
        return $this->db->count_all("zamestnavatelia");
    }

    // pocet vsetky zaznamov pre typ_brigady
    public function record_count_typ_brigady (){
        return $this->db->count_all("typ_brigady");
    }

    //ukazka group_by pre tabulku a graf, vystup je pole
    public function record_count_per_user_array() {
        $this->db->select('MONTHNAME(datum) as datum, COUNT(datum) AS counts');
        $this->db->from('brigady');
        $this->db->group_by('MONTH(datum)');
        $query = $this->db->get();
        return $query->result_array();
    }
}