<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class xmloperator {

    public function read($filename,$table,$ids,$limit=null)
    {
            $doc = new DOMDocument();
            $doc->load( $filename );
            $books = $doc->getElementsByTagName( $table );
            $k=0;
            $array=array();
            foreach($books as $book)
            {
                foreach ($ids as $value) 
                {
                    $array[$k][$value]=$book->getElementsByTagName( $value )->item(0)->nodeValue;
                }
                if($k==$limit)
                    break;
                $k++; //heyoo
            }
    }
}

/* End of file Someclass.php */