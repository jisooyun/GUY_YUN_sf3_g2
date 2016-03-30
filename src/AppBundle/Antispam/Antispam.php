<?php

/**
 * Created by PhpStorm.
 * User: Jisoo
 * Date: 30/03/2016
 * Time: 17:04
 */

namespace AppBundle\Antispam;


class Antispam
{
    public function isSpam($text)
    {
        return strlen($text) > 50;
    }
}