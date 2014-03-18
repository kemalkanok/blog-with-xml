<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class blog extends CI_MODEL {
    public function __construct() {
        parent::__construct();
        
    }

    public function get() {
        
        $array = array();
        $array["blog_entries"] = $this->xmloperator->read_all("blog_entries.xml",null,10);
        $array["base"]=$_SERVER['SERVER_NAME'];
        $users=$this->xmloperator->read_all("users.xml","row" );
        foreach ($array["blog_entries"] as $key => $value) {
            $array["blog_entries"][$key]["body"] = str_replace(array("[", "]"), array("<", ">"), $value["body"]);
            $a=$this->xmloperator->search_equal_field($users , "id" , $array["blog_entries"][$key]["sender_id"]);
            $array["blog_entries"][$key]["sender_id"]="sended by ".$a[0]["username"];
        }
        return $array;
    }

    

    public function entry($id) {
        $array['blog_entries']=array();
        $array["base"]=$_SERVER['SERVER_NAME'];
        $a = $this->xmloperator->read_all("blog_entries.xml");
        $array['blog_entries']=$this->xmloperator->search_equal_field($a , "id" , 1);
        $users=$this->xmloperator->read_all("users.xml","row" );
        foreach ($array['blog_entries'] as $key=>$value) {
            $array["blog_entries"][$key]["body"] = str_replace(array("[", "]"), array("<", ">"), $value["body"]);
            $a=$this->xmloperator->search_equal_field($users , "id" , $array["blog_entries"][$key]["sender_id"]);
            $array["blog_entries"][$key]["sender_id"]="sended by ".$a[0]["username"];
        }
            return $array;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */