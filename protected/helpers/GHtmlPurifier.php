<?php

class GHtmlPurifier extends CHtmlPurifier 
{
    private $_purifier;
    
    protected function createNewHtmlPurifierInstance()
    {
        $this->_purifier=new HTMLPurifier($this->getOptions());
        //$this->_purifier->config->set('Cache.SerializerPath',Yii::app()->getRuntimePath());
        return $this->_purifier;
    }
}