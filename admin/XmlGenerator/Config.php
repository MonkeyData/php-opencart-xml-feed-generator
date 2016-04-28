<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator;

use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataEmptyHashException;

/**
 * Description of Config
 *
 * @author Tomas
 */
class Config {

    const HASH_CONFIG_FILE = "config.hash";
    const DEFAULT_HASH_VALUE = "my-secret-hash";

    private $configFileName = "";
    
    private $hash = false;

    public function __construct($hash = false) {
        $this->setConfigFileName(__DIR__ . DIRECTORY_SEPARATOR . Config::HASH_CONFIG_FILE);
        $this->setHash($hash);
    }

    private function getHashFromHashFile() {
        $hash = '';
        if (file_exists($this->getConfigFileName())) {
            $hash = trim( file_get_contents($this->getConfigFileName()) );
            if(empty($hash)){
                throw new MonkeyDataEmptyHashException('config.hash does not contain hash');
            }
            if($hash == Config::DEFAULT_HASH_VALUE){
                $hash = md5(time());
                file_put_contents($this->getConfigFileName(), $hash);
            }
            return $hash;
        }
        $hash = md5(time());
        file_put_contents($this->getConfigFileName(), $hash);
        return $hash;
    }
    
    

    public function getConfigFileName() {
        return $this->configFileName;
    }

    public function setConfigFileName($configFileName) {
        $this->configFileName = $configFileName;
    }
    
    public function getHash() {
        if($this->hash === false){
            $this->setHash($this->getHashFromHashFile());
        }
        return $this->hash;
    }

    public function setHash($hash) {
        $this->hash = $hash;
    }


}
