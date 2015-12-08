<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers;


/**
 * Class MDHelper
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers
 * @author MD Developers
 */
class MDHelper {
    
    public static function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}