<?php

Yii::import('bootstrap.widgets.TbMenu');

class Menu extends TbMenu {
    
    //public $activateItems=false;
    
    protected function normalizeItems($items, $route, &$active)
    {
        foreach($items as $key => $item)
        {
            if(!isset($item['active']))
                $items[$key]['active'] = false;
            
            if($items[$key]['active'] === true)
            {
                $active = true;
            }
        }
        return array_values($items);
    }
}