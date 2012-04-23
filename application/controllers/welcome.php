<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("xmloperator");
        $this->load->library('parser');
    }

    public function index() {
        $array = array();
        $array["blog_entries"] = $this->xmloperator->read_all("blog_entries.xml", "blogentry");
        $users=$this->xmloperator->read_all("users.xml", "user");
        //$a= $this->xmloperator->search_equal_field($users , "id" , (int) );//$array["blog_entries"][2]["sender_id"]);
        //echo $a["username"];
        //print_r($users);
        //echo $this->xmloperator->search_equal_field($users,"")
        foreach ($array["blog_entries"] as $key => $value) {
            //echo $array["blog_entries"][$key]["sender_id"];
            $array["blog_entries"][$key]["body"] = str_replace(array("[", "]"), array("<", ">"), $value["body"]);
            
            $a=$this->xmloperator->search_equal_field($users , "id" , (int)$array["blog_entries"][$key]["sender_id"]);
            $array["blog_entries"][$key]["sender_id"]=$a["username"];
                
            
        }
        $this->parser->parse('welcome_message.php', $array);
        
    }

    public function operations($option = null) {
        switch ($option) {
            case 'add_page_get_contents':
                echo '
                    Add Page:
                    <br/>
                    Title:<br/>
                    <input id="entry_title" type="text" style="width:95%" />
                    <br/>
                    Body:<br/>
                    <textarea id="entry_body" style="width:95%;height: 300px;"></textarea>
                    <br/>
                    <input type="button" onclick="javascript:send_article();" id="entry_send" value="Send Article"/>
                    ';
                break;
            case 'login_prompt':
                //echo 1;
                $array = $this->xmloperator->read_all("users.xml", "user");
                foreach ($array as $value) {
                    if ($_POST['username'] == $value["username"] && $_POST['password'] == $value["password"]) {
                        $array = array(
                            'id' => $value["id"],
                            'username' => $value["username"],
                            'level' => $value["level"]
                        );
                        $this->session->set_userdata($array);
                        die("1"); //login correct
                    }
                }
                die("0"); //login fail
                break;
            case 'log_check':
                if ($this->session->userdata('id') != "")
                    echo 1;
                else
                    echo 0;
                break;
        }
    }

    public function blogentry($id) {

        $array['blog_entries'][0]=array();
        $a = $this->xmloperator->read_all("blog_entries.xml", "blogentry");
        $array['blog_entries'][0]=$this->xmloperator->search_equal_field($a , "id" , $id);
//        foreach ($a as $key => $value) {
//            $a[$key]["body"] = str_replace(array("[", "]"), array("<", ">"), $value["body"]);
//            if ($a[$key]["id"] == $id) {
//                $array['blog_entries'][0] = $a[$key];
//                break;
//            }
//        }
        if($array['blog_entries'][0]!=null)
        $this->parser->parse('welcome_message.php', $array);
        else
            echo "Not Found";
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */