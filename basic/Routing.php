<?php
namespace Basic;
use Basic\Basic;
class Routing extends Basic{
    var $methodCode;
    var $tupleCode;
    var $uriCode;
    function __construct($bool){
        if($bool){
            $this->auto();
        }else{
            $this->manual();
        }
    }
    function auto(){
        //setar o método
        $method=parent::getMethod();
        $methodCode=$this->convertMethodToMethodCode($method);
        $this->setMethodCode($methodCode);
        print $this->getMethodCode().'<br>';
        //setar a uri
        $uri=parent::segment();
        $uriCode=$this->convertUriToUriCode($uri);
        $this->setUriCode($uriCode);
        print $this->getUriCode().'<br>';
        //setar a tupla
        //setar a ação
    }
    function getMethodCode(){
        return $this->methodCode;
    }
    function getTupleCode(){
        return $this->tupleCode;
    }
    function getUriCode(){
        return $this->uriCode;
    }
    function convertMethodToMethodCode($str){
        switch($str){
            case 'GET':
            $methodCode=1;
            break;
            case 'POST':
            $methodCode=2;
            break;
            case 'PUT':
            case 'PATCH':
            $methodCode=3;
            break;
            case 'DELETE':
            $methodCode=4;
            break;
            default:
            $methodCode=0;
        }
        return $methodCode;
    }
    function convertUriToUriCode($arr){
        $count=count($arr);
        if($count==1){
            // 1   simples (ex: /, /photos)
            $uriCode=1;
        }elseif($count==2){
            if(is_numeric($arr[2])){
                // 3   com id (ex:/photos/1)
                $uriCode=3;
            }elseif($arr[2]=='create'){
                // 2   com ação (ex:/photos/create)
                $uriCode=2;
            }else{
                $uriCode=0;
            }
        }elseif($count==3){
            // 4   com id e ação (ex:/photos/1/edit)
            $uriCode=4;
        }else{
            $uriCode=0;
        }
        return $uriCode;
    }
    function manual(){
        print 'roteamento manual<br>';
    }
    function setMethodCode($int){
        $this->methodCode=$int;
    }
    function setTupleCode($int){
        $this->tupleCode=$int;
    }
    function setUriCode($int){
        $this->uriCode=$int;
    }
}
?>
