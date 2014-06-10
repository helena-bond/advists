<?php

class Helper
{
    public static function canChangeTime($showOriginalTime = false)
    {
        if($showOriginalTime) return false;
        
        if(Yii::app()->user->role === 'admin')
        {
            return true;
        }
        
        if(Yii::app()->user->role === 'manager')
        {
            return false;
        }
        
        return (Yii::app()->params['report']['userCanSuggest']);
    }
    
    /**
     * Функция для дебага массивов
     * @param type $array
     * @param type $die
     */
    public static function printer($array, $die = true)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        if($die) die;
    }
}