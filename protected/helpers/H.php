<?php

class H
{

    /**
     * Проверка принадлежности роли пользователя к роли
     * @param type $roles
     * @return boolean
     */
    public static function role($role)
    {
        if (is_array($role)) {
            foreach ($role as $r) {
                if (self::role($r))
                    return true;
            }
        }
        else {
            return (Yii::app()->user->role === $role);
        }
        return false;
    }

    public static function p($array, $die = true)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        if ($die)
            die();
    }

    public static function t($str)
    {
        $tr = array(
            "Ц" => "ts", "ц" => "ts",
            "Ч" => "ch", "ч" => "ch",
            "Ш" => "sh", "ш" => "sh",
            "Щ" => "sch", "щ" => "sch",
            "Ъ" => "",
            "Ы" => "i", "ы" => "yi",
            "Ь" => "", "ь" => "",
            "Э" => "e", "э" => "e",
            "Ю" => "yu", "ю" => "yu",
            "Я" => "ya", "я" => "ya",
            "ъ" => "",
            "Ё" => "yo", "ё" => "yo",
            "ў" => "u", "Ў" => "u",
            "ғ" => "g", "Ғ" => "g",
            "қ" => "q", "Қ" => "q",
            "ҳ" => "h", "Ҳ" => "h",
            "А" => "a", "а" => "a",
            "Б" => "b", "б" => "b",
            "В" => "v", "в" => "v",
            "Г" => "g", "г" => "g",
            "Д" => "d", "д" => "d",
            "Е" => "ye", "е" => "e",
            "Ж" => "j", "ж" => "j",
            "З" => "z", "з" => "z",
            "И" => "i", "и" => "i",
            "Й" => "y", "й" => "y",
            "К" => "k", "к" => "k",
            "Л" => "l", "л" => "l",
            "М" => "m", "м" => "m",
            "Н" => "n", "н" => "n",
            "О" => "o", "о" => "o",
            "П" => "p", "п" => "p",
            "Р" => "r", "р" => "r",
            "С" => "s", "с" => "s",
            "Т" => "t", "т" => "t",
            "У" => "u", "у" => "u",
            "Ф" => "f", "ф" => "f",
            "Х" => "x", "х" => "x",
            " " => "_", "/" => "_",
            "\\" => "_", "-" => "_",
            "`" => "", "'" => "",
            "—" => "-", "«" => "", "»" => "", "…" => "", "№" => "#"
        );
        return strtr($str, $tr);
    }

    public static function UTF8_substr($str, $from, $len)
    { // (C) SiMM
        return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $from . '}' .
                '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $len . '}).*#s',
                '$1', $str);
    }

}
