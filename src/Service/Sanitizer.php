<?php
/**
 * Created by PhpStorm.
 * User: mghinassi
 * Date: 30/03/18
 * Time: 15.46
 */

namespace App\Service;


class Sanitizer
{

    /**
     * pulisce il testo inserito rendendolo leggibile
     *
     * @param string $text
     * @return string
     */
    public static function sanitizeText(string $text) : string
    {
        $sanitizedText= str_replace('&Egrave;', 'è', $text);
        return $sanitizedText;
    }



}