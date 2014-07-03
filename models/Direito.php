<?php

namespace app\models;

class Direito extends \app\models\DireitoBase {
    
    public function getModule() {
        
        $result = 'basic';
        
        $url = explode('/', $this->url);
        
        if (count($url) === 4) {
            $result = $url[1];
        }
        
        return $result;
    }
    
    public function getController() {
        
        $url = explode('/', $this->url);
        
        $pos = 1;
        if (count($url) === 4) {
            $pos = 2;
        }
        
        return $url[$pos];       
        
    }
    
    public function getAction() {
        
        $url = explode('/', $this->url);
        
        $pos = count($url)-1;
        
        return $url[$pos];
        
    }
    
}
