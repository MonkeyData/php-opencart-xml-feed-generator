<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions;

use Exception;


/**
 * Class MonkeyDataEmptyValueException
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions
 * @author MD Developers
 */
class MonkeyDataEmptyValueException extends Exception {

    public function __construct() {
        $message = " Empty value ";
        parent::__construct($message, 1, null);
    }
}
