<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
interface  xmlfunctions
{
    public function read_with_fields($filename, $table, array $ids, $limit = null);/*asds*/
    public function read_all($filename, $table);
    public function update($filename, $table, array $changes , $where_field , $where_value );
    public function insert($filename, $table, array $values , $ai=null);
    public function delete($filename, $table,$id_field , $id_value);
    public function inner_join($filename1, $table1,$id_field1 , $filename2 , $table2 , $id_field2);
    function array_to_xml($item_name,array $datas);
    
    
}
class xmloperator implements xmlfunctions {
//@todo:ekleme ve silme eklenicek.
    
    public function read_with_fields($filename, $table, array $ids, $limit = null) {
        $doc = new DOMDocument();
        $doc->load($filename);
        $books = $doc->getElementsByTagName($table);
        $k = 0;
        $array = array();
        foreach ($books as $book) {
            $this->element_name=$book->nodeName;
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
        $k = 0;
        $array = array();
        
        foreach ($books as $book) {
            $this->element_name=$book->nodeName;
            foreach ($book->childNodes as $value) {
                if ($value->nextSibling != null) {
                    $s1 = str_replace("#text", "", $value->nextSibling->nodeName);
                    $s2 = $value->nextSibling->textContent;
                    if (strlen($s1) != 0 && strlen($s2) != 0) {
                        $array[$k][$s1] = $s2;
                    }
                }
            }
            $k++;
        }
        return $array;
    }
    public function update($filename, $table, array $changes , $where_field , $where_value ) {
        $array = $this->read_all($filename, $table);
        foreach ($array as $key=>$value) {
                if($value[$where_field] == $where_value)
                {
                    foreach ($changes as $k=>$v) {
                        $array[$key][$k]=$v;
                    }
                }
        }
          file_put_contents($filename, $this->array_to_xml($table, $array));
    }
    public function insert($filename, $table, array $values , $ai=null){
        if($ai==null)
        {
             $array=$this->read_all($filename,$table);
             $array["_add1"]=$values;
             file_put_contents($filename, $this->array_to_xml($table, $array));
        }
        else
        {
             $array=$this->read_all($filename,$table);
             $array["_add1"]=$values;
             $array["_add1"][$ai]=count($this->read_all($filename,$table))+1;
             file_put_contents($filename, $this->array_to_xml($table, $array));
        }
    }
    public function delete($filename, $table, $id_field, $id_value) {
        $read_array=$this->read_all($filename, $table);
        $new_array=array();
        foreach ($read_array as $key=>$value) {
            if($value[$id_field] != $id_value)
            {
                $new_array[$value[$id_field]]=$read_array[$key];
            }
            
        }
        file_put_contents($filename, $this->array_to_xml($table, $new_array));
        //print_r($new_array);
    }
    public function search_equal_field(array $datas , $field , $value)
    {
        $value=(int)$value;
        $array  = array();
        $k=0;
        foreach ($datas as $val) {
            if($val[$field] == $value)
            {
                $array[$k]=$val;
                $k++;
            }
        }
        return $array;
    }
    function array_to_xml($item_name,array $datas){
        $str="";
        $str.="<"."xxx".">".PHP_EOL;
         foreach ($datas as $value) {
             $str.="    <".$item_name.">".PHP_EOL;
             foreach ($value as $key => $val) {
                 $str.="        <".$key.">";
                 $str.=$val;
                 $str.="</".$key.">".PHP_EOL;
             }
             $str.="    </".$item_name.">".PHP_EOL;
         }
        $str.="</"."xxx".">".PHP_EOL;
        return $str;
    }

    public function inner_join($filename1, $table1, $id_field1, $filename2, $table2, $id_field2) {
        
    }

    
}

/* End of class xmloperator.php */