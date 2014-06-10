<?php
class HTMLPurifier_HTMLModule_TargetBlankAll extends HTMLPurifier_HTMLModule
{

    public $name = 'TargetBlankAll'; // Это имя будет использоваться в конфиге. Не забудьте его поменять

    public function setup($config) {
        $a = $this->addBlankElement('a'); // Указываем, что модуль должен применяться ко всем тегам A
        $a->attr_transform_post[] = new HTMLPurifier_AttrTransform_TargetBlankAll(); // Записываем наш конфиг в массив ПОСТфильтров
        // Так же есть массив ПРЕфильтров $a->attr_transform_pre[]
    }

}