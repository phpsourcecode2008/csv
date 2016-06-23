<?php

class MChart extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_course()
    {
        $query = $this->db->query('SELECT COUNT(*) as num, course from course group by course');
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    function insert_csv($data)
    {
        $this->db->insert('addressbook', $data);
    }

}
