<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'employee' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Employee',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),    
    'manager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Manager',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),    
    'accountant' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Accountant',
        'children' => array(
            'manager', 
        ),
        'bizRule' => null,
        'data' => null
    ),    
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            'manager',        // позволим админу всё, что позволено модератору
        ),
        'bizRule' => null,
        'data' => null
    ),
    
);