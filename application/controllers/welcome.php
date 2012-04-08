<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library("xmloperator");
        $this->load->library('parser');
    }

    public function index() {

        $array["blog_entries"] = $this->xmloperator->read("blog_entries.xml", "blogentry", array("id", "title", "body", "date", "sender_id"));
        foreach ($array["blog_entries"] as $key => $value) {
            $array["blog_entries"][$key]["body"] = str_replace(array("[", "]"), array("<", ">"), $array["blog_entries"][$key]["body"]);
        }
        $this->parser->parse('welcome_message.php', $array);
        //print_r($array);
        //@todo:ekleme ve silme eklenicek.
    }

    public function operations($option = null) {
        switch ($option) {
            case 'add_page_get_contents':
                echo 'Add Page:
					<br/>
					Title:<br/>
					<input id="entry_title" type="text" style="width:95%" />
					<br/>
					Body:<br/>
					<textarea id="entry_body" style="width:95%;height: 300px;"></textarea>
					<br/>
					<input type="button" onclick="javascript:send_article();" id="entry_send" value="Send Article"/>';
                break;
            case 'login_prompt':
                //echo 1;
                $doc = new DOMDocument();
                $doc->load('users.xml');
                $books = $doc->getElementsByTagName("user");
                //print_r($books);
                $array = array();
                $k = 0;
                foreach ($books as $book) {
                    //echo $book->getElementsByTagName( "date" )->item(0)->nodeValue;
                    $array[$k]["id"] = $book->getElementsByTagName("id")->item(0)->nodeValue;
                    $array[$k]["username"] = $book->getElementsByTagName("username")->item(0)->nodeValue;
                    $array[$k]["password"] = $book->getElementsByTagName("password")->item(0)->nodeValue;
                    $array[$k]["level"] = $book->getElementsByTagName("level")->item(0)->nodeValue;
                    //echo $array[$k]["username"] ." ". $array[$k]["password"];
                    if ($_POST['username'] == $array[$k]["username"] && $_POST['password'] == $array[$k]["password"]) {
                        $array = array(
                            'id' => $array[$k]["id"],
                            'username' => $array[$k]["username"],
                            'level' => $array[$k]["level"]
                        );
                        $this->session->set_userdata($array);
                        die("1"); //login correct
                    }
                    $k++;
                }
                echo 0; //login fail
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

        
        $doc = new DOMDocument();
        
        $doc->load('blog_entries.xml');
        $books = $doc->getElementsByTagName("blogentry");
        //print_r($books);
        $array = array();
        $k = 0;

        foreach ($books as $book) {
            //echo $book->getElementsByTagName( "date" )->item(0)->nodeValue;
            $array['blog_entries'][$k]["title"] = $book->getElementsByTagName("title")->item(0)->nodeValue;
            $array['blog_entries'][$k]["body"] = str_replace(array('[', ']'), array('<', '>'), $book->getElementsByTagName("body")->item(0)->nodeValue);
            $array['blog_entries'][$k]["date"] = "(" . $book->getElementsByTagName("date")->item(0)->nodeValue . ")";
            $array['blog_entries'][$k]["date_unicode"] = $book->getElementsByTagName("date_unicode")->item(0)->nodeValue;
            $array['blog_entries'][$k]["sender_id"] = "sended by " . $book->getElementsByTagName("sender_id")->item(0)->nodeValue;
            $array['blog_entries'][$k]["id"] = $book->getElementsByTagName("id")->item(0)->nodeValue;
            if ($array['blog_entries'][$k]["id"] == $id) {
                $this->parser->parse('blogentry.php', $array);
                break;
            }
            //$k++;
        }

        //$this->parser->parse('welcome_message.php',$array);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */