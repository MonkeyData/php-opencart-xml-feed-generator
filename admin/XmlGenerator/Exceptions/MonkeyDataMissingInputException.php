<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions;

use Exception;


/**
 * Class MonkeyDataMissingInputException
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions
 * @author MD Developers
 */
class MonkeyDataMissingInputException extends Exception {

    /**
     * @param string $message
     */
    public function __construct($message) {
        $message = "Input {$message} is required from your model";
        parent::__construct($message);
    }
}
