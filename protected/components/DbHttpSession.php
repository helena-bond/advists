<?php

class DbHttpSession extends CDbHttpSession{

    public function init()
    {
        $settings = array(
            'httponly' => true
        );
        $this->setCookieParams($settings);
        parent::init();
    }

}
