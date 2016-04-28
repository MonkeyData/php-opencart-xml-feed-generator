<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions;

use Exception;


/**
 * Class MonkeyDataEmptyValueException
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions
 * @author MD Developers
 */
class MonkeyDataEmptyHashException extends Exception {

    public function __construct($message = '') {
        parent::__construct('Hash is empty. '.$message, null, null);
    }
}
