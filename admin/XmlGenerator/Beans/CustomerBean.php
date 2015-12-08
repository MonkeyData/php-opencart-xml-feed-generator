<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;


/**
 * Class CustomerBean
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class CustomerBean extends Beans {

    /**
     * @var string|null
     */
    protected $customer_email = null;

    /**
     * @var string|null
     */
    protected $customer_city = null;

    /**
     * @var string|null
     */
    protected $customer_country = null;

    /**
     * @var string|null
     */
    protected $customer_firstname = null;

    /**
     * @var string|null // TODO: Ask
     */
    protected $customer_registration = null;

    /**
     * @var string|null // TODO: Ask
     */
    protected $customer_zip_code = null;

    /**
     * @var string|null // TODO: Ask
     */
    protected $customer_vat_status = null;

    /**
     * @var string|null // TODO: Ask
     */
        protected $customer_type = null;

    /**
     * @return null|string
     */
    public function getCustomer_email() {
        return $this->customer_email;
    }

    /**
     * @return null|string
     */
    public function getCustomer_city() {
        return $this->customer_city;
    }

    /**
     * @return null|string
     */
    public function getCustomer_country() {
        return $this->customer_country;
    }

    /**
     * @return null|string
     */
    public function getCustomer_firstname() {
        return $this->customer_firstname;
    }

    /**
     * @return null|string
     */
    public function getCustomer_registration() {
        return $this->customer_registration;
    }

    /**
     * @return null|string
     */
    public function getCustomer_zip_code() {
        return $this->customer_zip_code;
    }

    /**
     * @return null|string
     */
    public function getCustomer_vat_status() {
        return $this->customer_vat_status;
    }

    /**
     * @return null|string
     */
    public function getCustomer_type() {
        return $this->customer_type;
    }

    /**
     * @param string $customer_email
     * @return CustomerBean $this
     */
    public function setCustomer_email($customer_email) {
        $this->customer_email = $customer_email;
        return $this;
    }

    /**
     * @param string $customer_city
     * @return CustomerBean $this
     */
    public function setCustomer_city($customer_city) {
        $this->customer_city = $customer_city;
        return $this;
    }

    /**
     * @param string $customer_country
     * @return CustomerBean $this
     */
    public function setCustomer_country($customer_country) {
        $this->customer_country = $customer_country;
        return $this;
    }

    /**
     * @param string $customer_firstname
     * @return CustomerBean $this
     */
    public function setCustomer_firstname($customer_firstname) {
        $this->customer_firstname = $customer_firstname;
        return $this;
    }

    /**
     * @param string $customer_registration // TODO: Zeptat se
     * @return CustomerBean $this
     */
    public function setCustomer_registration($customer_registration) {
        $this->customer_registration = $customer_registration;
        return $this;
    }

    /**
     * @param string $customer_zip_code // TODO: Zeptat se
     * @return CustomerBean $this
     */
    public function setCustomer_zip_code($customer_zip_code) {
        $this->customer_zip_code = $customer_zip_code;
        return $this;
    }

    /**
     * @param string $customer_vat_status // TODO: Zeptat se
     * @return CustomerBean $this
     */
    public function setCustomer_vat_status($customer_vat_status) {
        $this->customer_vat_status = $customer_vat_status;
        return $this;
    }

    /**
     * @param string $customer_type // TODO: Zeptat se
     * @return CustomerBean $this
     */
    public function setCustomer_type($customer_type) {
        $this->customer_type = $customer_type;
        return $this;
    }
}
