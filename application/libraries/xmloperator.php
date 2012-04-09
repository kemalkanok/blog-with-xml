<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class xmloperator {
    
    private function read($filename, $table, $ids, $limit = null) {
        $doc = new DOMDocument();
        $doc->load($filename);
        $books = $doc->getElementsByTagName($table);
        $k = 0;
        $array = array();
        foreach ($books as $book) {
            foreach ($ids as $value) {
                $array[$k][$value] = $book->getElementsByTagName($value)->item(0)->nodeValue;
            }
            if ($limit != null)
                if ($k == $limit)
                    break;
            $k++;
        }
        return $array;
    }
    public function xml_sql($filename,$table,$string)
    {
        
        $str=explode(' ', $string);
        if( strtolower($str[0])=="select")
        {
            $i=1;
            while($str[$i]=="")
                $i++;
            $str[$i]=  explode(",", $str[$i]);
            return $this->read($filename,$table,$str[$i]);
            
        }
    }
}

/* End of file Someclass.php */