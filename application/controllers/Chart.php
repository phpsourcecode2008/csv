

<?php

class Chart extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('MChart');
    }

    function index()
    {
        $res = $this->MChart->get_course();
        $array = array(array("Skill", "Total Members"));
        
        foreach($res as $re)
        {
            $q = array($re['course'], $re['num']);
            array_push($array, $q);
        }
        
       $array = json_encode($array);
       
//$array = array(array("Skill", "Total Members"),
//            array("PHP", 10),
//            array("Test", 3),
//            array("Linux", 5));
//
//$array = json_encode($array);

        /** Select count(*), `course` from course group by `course` 
         * [
          ['Opening Move', 'Percentage'],
          ["King's pawn", 44],
          ["Queen's pawn", 31],
          ["Knight to King", 12],
          ["Queen's bishop pawn", 10],
          ]
         */
        $data['graph_points'] = $array;
        $this->load->vars($data);
        $this->load->view('chart');
    }

}

