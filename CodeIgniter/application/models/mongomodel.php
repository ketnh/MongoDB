<?php
    class MongoModel extends CI_Model{
        function kate(){
            return $this->mongo_db->select(null,array('_id'))->get('canbo');
        }
    }
?>