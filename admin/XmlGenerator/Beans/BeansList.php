<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;

use Countable;
use Iterator;


/**
 * Class BeansList
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
abstract class BeansList implements Iterator, Countable {

    /**
     * @var array
     */
    private $list = array();
    
    /**
     *
     * @var int|null
     */
    private $position = null;
    
    public function __construct() {
        $this->position = null;
    }

    /**
     * @param Beans $item
     */
    abstract public function addBean(Beans $item);

    /**
     * @param Beans $item
     */
    protected function add(Beans $item) {
        $this->list[$item->id] = $item;
        if(is_null($this->position)) {
            $this->position = $item->id;
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function getBeanById($id) {
        if(isset($this->list[$id])) {
            return $this->list[$id];
        }
        return false;
    }

    /**
     * @return array
     */
    public function getIds() {
        return array_keys($this->list);
    }

    /**
     * @return mixed
     */
    public function current() {
        return $this->list[$this->position];
    }

    /**
     * @return int|null
     */
    public function key() {
        return $this->position;
    }

    public function next() {
        next($this->list);
        $this->position = key($this->list);
    }

    public function rewind() {
        reset($this->list);
        $this->position = key($this->list);
    }

    /**
     * @return bool
     */
    public function valid() {
        return isset($this->list[$this->position]);
    }
    
    public function count() 
    { 
        return count($this->list);
    }
}
