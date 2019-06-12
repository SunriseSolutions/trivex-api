<?php

namespace App\Util;

use App\Message\Entity\OrganisationSupportedType;
use Doctrine\ORM\EntityManagerInterface;

class AppUtil extends BaseUtil
{
    const APP_NAME = 'USER';

    public static function getAppName()
    {
        return self::APP_NAME;
    }
}