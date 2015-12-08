<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers;

use Exception;


/**
 * Class InputHelper
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers
 * @author MD Developers
 */
class InputHelper {
    
    /**
     * handle all type inputs, GET, POST, fron linux console short and long version.
     * from get: $_GET['my_param_name'] - handleInput("my_param_name");
     * from post: $_POST['my_param_name'] - handleInput("my_param_name");
     * from console short version: script.php -r=1236  - handleInput("r");
     * from console long version: script.php --res=1236  - handleInput("res");
     * 
     * @param string $inputName
     * @param mixed $default
     * @return mixate
     * @throws Exception
     */
    public static function handleInput($inputName, $default = null){
        $firstLetter = substr($inputName, 0, 1);
        $consoleParamLength = strlen($inputName);
        $longOpt = array();
        if($consoleParamLength > 1){
            $longOpt[] = $inputName.":";
        }
        
        $input = getopt($firstLetter.':',$longOpt);
        if($consoleParamLength == 1 AND isset($input[$firstLetter]) AND !empty($input[$firstLetter])){
            $inputValue = $input[$firstLetter];
        }elseif($consoleParamLength > 1 AND isset($input[$inputName]) AND !empty($input[$inputName])){
            $inputValue = $input[$inputName];
        }elseif(isset($_GET[$inputName])) {
            $inputValue = $_GET[$inputName];
        }elseif(isset($_POST[$inputName])){
            $inputValue = $_POST[$inputName];
        }elseif(!is_null($default)){
            return $default;
        }else{
            throw new Exception("Input with name {$inputName} is not set.");
        }
        return $inputValue;
    }
}
