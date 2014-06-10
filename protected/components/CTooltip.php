<?php

class CTooltip {

    public static function getScript() {
        return "
            jQuery(document).ready(function($) {
              $('.toltipp').each(function() {
                Tipped.create(this, {
                  skin: 'white',
                  maxWidth: 600,
                  minWidth: 400,
                  ajax: { data: $(this).data('querystring') },
                  hook: {
                      tooltip: 'bottommiddle',
                      target: 'topmiddle'
                  }
                });
              });
            })";
    }

    public static function getJS($name) {
        Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $name, CTooltip::getScript() . ';');
    }

    public static function getTipped($link, $model, $name, $url = null) {
        if($url === null) $url = Yii::app()->createUrl($link, array("id" => $model->id));
        return '<span class="toltipp" data-tipped="' .
                Yii::app()->createUrl($link, array("id" => $model->id)) .
                '" data-querystring="">' .
                '<a href="#"
                    style="color:black; text-decoration: none !important;">'
                . $name . '</a></span>';
    }

}

?>
