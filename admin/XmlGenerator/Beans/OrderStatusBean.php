<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class OrderStatusBean
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class OrderStatusBean extends Beans {

    /**
     * @var string|null
     */
    protected $order_status_name = null;

    /**
     * @return null|string
     */
    public function getOrder_status_name() {
        return $this->order_status_name;
    }

    /**
     * @param $order_status_name
     * @return OrderStatusBean $this
     */
    public function setOrder_status_name($order_status_name) {
        $this->order_status_name = $order_status_name;
        return $this;
    }
}
