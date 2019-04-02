<?php

namespace App\Shared\Services\Utils;

/**
 * Class Util
 * Classe qui contient les fonctions spécifiques nécéssaires.
 */
class Util
{
    /**
     * Génération slug.
     *
     * @param string $_string
     * @param string $_separator
     *
     * @return string
     */
    public static function slug($_string, $_separator = '-')
    {
        $_accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $_special_cases = array('&' => 'and', "'" => '');

        $_string = mb_strtolower(trim($_string), 'UTF-8');
        $_string = str_replace(array_keys($_special_cases), array_values($_special_cases), $_string);
        $_string = preg_replace($_accents_regex, '$1', htmlentities($_string, ENT_QUOTES, 'UTF-8'));
        $_string = preg_replace('/[^a-z0-9]/u', "$_separator", $_string);
        $_string = preg_replace("/[$_separator]+/u", "$_separator", $_string);

        return $_string;
    }
}
