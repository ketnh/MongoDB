<?php

    class Kate extends CI_Controller{
        function index(){
            $temp = $this->mongomodel->kate();
            $data['mongo'] = $this->table->generate($temp);
            $this->load->view('mongo',$data);
        }
    }
?>