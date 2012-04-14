<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class xmloperator {
    
    private function read($filename, $table,array $ids, $limit = null) {
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
    public function read_all($filename, $table) {
        
        $dom = new DOMDocument;
        $dom->load($filename);
        $books = $dom->getElementsByTagName($table);
        $k=0;
        $array=array();
        foreach ($books as $book) {
            foreach ($book->childNodes as  $value) {
                if($value->nextSibling!=null)
                {
                    $s1=str_replace ("#text", "", $value->nextSibling->nodeName);
                    $s2=$value->nextSibling->textContent;
                    //if(strlen($value->nextSibling->nodeName) !=0 && strlen($value->nextSibling->textContent) != 0)
                    if(strlen($s1)!=0 && strlen($s2)!=0)
                    {
                        //echo str_replace ("#text", "", $value->nextSibling->nodeName).",";
                        $array[$k][$s1]=$s2;
                        //$a2[$k][$l]= $value->nextSibling->textContent;
                        //echo str_replace ("#text", "", $value->nextSibling->nodeName)."|".  $value->nextSibling->textContent;
                    }
                }
            }
            $k++;
}
return $array;
    }
    
    
//    public function update($filename, $table,array $ids, $limit = null) {
//        
//    }
    public function xml_sql($filename,$table,$string)
    {
        
        $str=explode(' ', $string);
        if( strtolower($str[0])=="select" )
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