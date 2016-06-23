

<?php

class Welcome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('MCsv');
        $this->load->library('csvimport');
    }

    function index()
    {
        $data['addressbook'] = $this->MCsv->get_addressbook();
        $this->load->view('welcome_message', $data);
    }

    function importcsv()
    {
        $data['addressbook'] = $this->MCsv->get_addressbook();
        $data['error'] = '';    //initialize image upload error array to empty

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();

            $this->load->view('welcome_message', $data);
        }
        else
        {
            $file_data = $this->upload->data();
            $file_path = './uploads/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path))
            {
                $csv_array = $this->csvimport->get_array($file_path);
                
                foreach ($csv_array as $row)
                {
                    $insert_data = array(
                        'firstname' => $row['firstname'],
                        'lastname' => $row['lastname'],
                        'phone' => $row['phone'],
                        'email' => $row['email']
                    );
                    $this->MCsv->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect(base_url() . 'welcome');
            }
            else
                $data['error'] = "Error occured";
            
            $this->load->view('welcome_message', $data);
        }
    }

}

