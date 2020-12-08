<?php

namespace App\Helper\Format;

class StringFormatHelper
{

    /**
     * @param $string
     * @return mixed
     */
    public function removeAccent($string)
    {
        \Transliterator::create('NFD; [:Nonspacing Mark:] Remove; NFC')
            ->transliterate($string);
        return $string;
    }

}
