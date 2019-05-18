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

    // pole pre naplnenie grafu - Počet brigád
    public function record_count_per_user_array() {
        $this->db->select('MONTHNAME(datum) as datum, COUNT(datum) AS counts');
        $this->db->from('brigady');
        $this->db->group_by('MONTH(datum)');
        $query = $this->db->get();
        return $query->result_array();
    }

    // pole pre naplnenie grafu - Študenti najviac hľadajú
    public function record_count_per_preferencie_array() {
        $this->db->select('nazov label, COUNT(*) value');
        $this->db->from('typ_brigady');
        $this->db->join('preferencie','preferencie.typ_brigady_id_typu = typ_brigady.id_typu');
        $this->db->group_by('nazov');
        $query = $this->db->get();
        return $query->result_array();
    }

    // pole pre naplnenie grafu - Priemerná hodinová sadzba pre rôzne typy brigád
    public function record_count_per_plat_array() {
        $this->db->select('YEAR(brigady.datum) AS Rok, AVG(študenti_has_brigady.hodinova_sadzba_studenta * študenti_has_brigady.odpracovane_hodiny ) AS plat1');
        $this->db->from('brigady');
        $this->db->join('študenti_has_brigady','brigady_id_brigady = brigady.id_brigady');
        $this->db->group_by('Rok');
        $query = $this->db->get();
        return $query->result_array();
    }
}