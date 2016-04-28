<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions;

use Exception;


/**
 * Class MonkeyDataEmptyValueException
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions
 * @author MD Developers
 */
class MonkeyDataInvalidModelException extends Exception {

    public function __construct() {
        parent::__construct('getModel method give wrong $model instance ');
    }
}
