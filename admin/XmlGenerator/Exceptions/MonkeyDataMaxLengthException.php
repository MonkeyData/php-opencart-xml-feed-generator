<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions;

use Exception;


/**
 * Class MonkeyDataMaxLengthException
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions
 * @author MD Developers
 */
class MonkeyDataMaxLengthException extends Exception {

    /**
     * @param string $message
     */
    public function __construct($message) {
        $message = "Value must be {$message}";
        parent::__construct($message);
    }
}