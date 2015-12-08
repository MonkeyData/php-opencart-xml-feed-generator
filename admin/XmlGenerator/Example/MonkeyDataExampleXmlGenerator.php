<?php

namespace MonkeyDataExample;

use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Generate\XmlGenerator;


/**
 * Class MonkeyDataExampleXmlGenerator
 *
 * Example class
 *
 * @package MonkeyDataExample
 * @author MD Developers
 */
class MonkeyDataExampleXmlGenerator extends XmlGenerator {

    /**
     * @return MonkeyDataXmlModel
     */
    public function getModel() {
        return new MonkeyDataXmlModel();
    }
}