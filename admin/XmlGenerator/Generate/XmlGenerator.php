<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Generate;

use Exception;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\CustomerList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderBean;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderProductsList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderStatusList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\PaymentList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\ShippingList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Config;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CategoryEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CategoryIdEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CategoryLevelEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CategoryNameEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CategoryTreeEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CurrencyEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CurrencyIdEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerCityEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerCountryEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerEmailEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerFirstnameEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerIdEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerRegistrationEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerTypeEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerVatStatusEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\CustomerZipCodeEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\DateCreatedEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\DateUpdatedEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ErrorEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\EshopEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\IdOrderEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\MemoryUsageEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\NoteEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\OrderProductsEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\OrderStatusIdEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\OrderStatusNameEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\PaymentIdEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\PaymentNameEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\PaymentPriceEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\PaymentPriceWithoutVatEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\PriceEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\PriceWithoutVatEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ProductCountEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ProductEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ProductIdEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ProductNameEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ProductPriceEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ProductPriceWithoutVatEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ProductPurchasePriceEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\RuntimeEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ShippingIdEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ShippingNameEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ShippingPriceEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ShippingPriceWithoutVatEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ShopIdEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ShopNameEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\ShopOrderEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities\VersionEntity;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataInvalidModelException;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\InputHelper;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\MDHelper;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model\XmlModel;


/**
 * Class XmlGenerator
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Generate
 * @author MD Developers
 */
abstract class XmlGenerator {

    /**
     * @var string
     */
    private $date_from;

    /**
     * @var string
     */
    private $date_to;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string|null
     */
    private $secureAsHash = null;

    /**
     * @var string
     */
    private $language = "cs";
    
    /**
     *
     * @var XmlModel
     */
    private $model;

    /**
     * @var OrderStatusList
     */
    private $orderStatusBean;

    /**
     * @var PaymentList
     */
    private $payment;

    /**
     * @var ShippingList
     */
    private $shipping;

    /**
     * @var CustomerList
     */
    private $customerBean;

    /**
     * @var array
     */
    private $categoriesList;

    /**
     * @var OrderProductsList
     */
    private $orderProductBean;
    
    /**
     *
     * @var Config
     */
    public static $debug = false;
    
    private $config = null;

    public function __construct(Config $config = null) {
        if($config !== null){
            $this->setConfig($config);
        }
        $this->model = $this->getXmlModel();
        if( InputHelper::handleInput("debug", false) !== false ){
            static::$debug = true;
        }
    }

    /**
     * @return XmlModel
     */
    abstract function getModel();
    
    /**
     * 
     * @return XmlModel
     * @throws MonkeyDataInvalidModelException
     */
    protected final function getXmlModel() {
        $model = $this->getModel();
        if( !($model instanceof XmlModel) ){
            throw new MonkeyDataInvalidModelException();
        }
        if($this->getConfig() !== null){
            $model->setConfig($this->getConfig());
        }
        return $model;
    }

    public function run() {
        if( !XmlGenerator::isNotDebug() ){
            error_reporting(E_ALL);
            echo "<pre>";
        }
        $time_start = MDHelper::microtime_float();
        $this->handleParams();
        $this->authenticate();
        $this->categoriesList = $this->getXmlModel()->getCategoriesItems();
        if( XmlGenerator::isNotDebug() ){
            $this->showXmlHeader();
            
        }
        $eshopEntity = new EshopEntity();
        echo $eshopEntity->getStartTag();
        echo new VersionEntity();
        $this->generate();
        $time_end = MDHelper::microtime_float();
        $time = $time_end - $time_start;
        echo new RuntimeEntity($time." s");
        echo new MemoryUsageEntity((memory_get_peak_usage(true) / 1024)." kB");
        echo $eshopEntity->getEndTag();
    }

    /**
     * zpracovani povinnych a nepovinnych parametru
     */
    private function handleParams(){
        $this->handleDates();
        $this->handleAuthorization();
        $this->handleLanguage();
    }

    private function generate() {
        //reset XMLmodel and all his variables for each iteration run this function
        $start = $this->model->getStart();
        $this->model = $this->getXmlModel();
        $this->model->setStart($start);
        
        //fill data from DB to local variables
        $this->model->prepareOrders($this->date_from, $this->date_to);

        $orders = $this->model->getOrders();
        if (count($orders) == 0) {
            return; //end of calling this recursive function
        }
        
        
        $this->orderStatusBean = $this->model->getOrderStatuses($this->model->getOrderStatusesIds());
        $this->payment = $this->model->getPayments($this->model->getPaymentIds());
        $this->shipping = $this->model->getShippings($this->model->getShipppingIds());
        $this->customerBean = $this->model->getCustomers($this->model->getCustomerIds());
        $this->orderProductBean = $this->model->getProducts($this->model->getOrderIds());

        
        foreach ($orders as $order) {
            $this->showShopOrder($order);
        }
        
        if (count($orders) < $this->model->getStep()) {
            return;
        }
        if(XmlGenerator::isNotDebug())$this->generate();
    }
    
    /**
     * 
     * @param OrderBean $order
     */
    private function showShopOrder($order) {
        $shopOrder = new ShopOrderEntity();
        
        // basic order section
        $shopOrder->addItem(new ShopIdEntity($this->model->getEshopId()));
        $shopOrder->addItem(new ShopNameEntity($this->model->getEshopName()));
        $shopOrder->addItem(new IdOrderEntity($order->id));
        $shopOrder->addItem(new DateCreatedEntity($order->date_created));
        $shopOrder->addItem(new DateUpdatedEntity($order->date_updated));
        $shopOrder->addItem(new CurrencyIdEntity($order->currency_id));
        $shopOrder->addItem(new CurrencyEntity($order->currency));
        $shopOrder->addItem(new PriceEntity($order->price));
        $shopOrder->addItem(new PriceWithoutVatEntity($order->price_without_vat));
        
        // order status section
        $orderStatusBean = $this->orderStatusBean->getBeanById($order->order_status_id);
        $shopOrder->addItem(new OrderStatusIdEntity($order->order_status_id));
        $shopOrder->addItem(new OrderStatusNameEntity($orderStatusBean->order_status_name));
        
        // payment section
        $payment = $this->payment->getBeanById($order->payment_id);
        $shopOrder->addItem(new PaymentIdEntity($order->payment_id));
        $shopOrder->addItem(new PaymentNameEntity($payment->payment_name));
        $shopOrder->addItem(new PaymentPriceEntity($payment->payment_price));
        $shopOrder->addItem(new PaymentPriceWithoutVatEntity($payment->payment_price_without_vat));
        
        // shipping section
        if ($shipping = $this->shipping->getBeanById($order->shipping_id)) {
            $shopOrder->addItem(new ShippingIdEntity($order->shipping_id));
            $shopOrder->addItem(new ShippingNameEntity($shipping->shipping_name));
            $shopOrder->addItem(new ShippingPriceEntity($shipping->shipping_price));
            $shopOrder->addItem(new ShippingPriceWithoutVatEntity($shipping->shipping_price_without_vat));
            $shopOrder->addItem(new NoteEntity($order->note));
        }
        
        // customer section
        if ($customerBean = $this->customerBean->getBeanById($order->customer_id)) {
            $customer = new CustomerEntity();
            $customer->addItem(new CustomerCityEntity($customerBean->customer_city));
            $customer->addItem(new CustomerCountryEntity($customerBean->customer_country));
            $customer->addItem(new CustomerZipCodeEntity($customerBean->customer_zip_code));
            $customer->addItem(new CustomerEmailEntity($customerBean->customer_email));
            $customer->addItem(new CustomerFirstnameEntity($customerBean->customer_firstname));
            $customer->addItem(new CustomerRegistrationEntity($customerBean->customer_registration));
            $customer->addItem(new CustomerTypeEntity($customerBean->customer_type));
            $customer->addItem(new CustomerVatStatusEntity($customerBean->customer_vat_status));
            $customer->addItem(new CustomerIdEntity($customerBean->id));
            $shopOrder->addItem($customer);
        }
        
        // product section
        if ($orderProductBean = $this->orderProductBean->getBeanById($order->id)) {
            $orderProducts = new OrderProductsEntity();
            $productList = $orderProductBean->getProduct_list();
            foreach ($productList as $productBean) {
                $product = new ProductEntity();
                $product->addItem(new ProductIdEntity($productBean->id));
                $product->addItem(new ProductNameEntity($productBean->product_name));
                $product->addItem(new ProductPriceEntity($productBean->product_price));
                $product->addItem(new ProductPriceWithoutVatEntity($productBean->product_price_without_vat));
                $product->addItem(new ProductPurchasePriceEntity($productBean->product_purchase_price));
                $product->addItem(new ProductCountEntity($productBean->product_count));
                $orderProducts->addItem($product);

                // categories section
                if ($productCategoryBean = $this->model->getCategories($this->categoriesList, $productBean->category_id, $productBean->id)->getBeanById($productBean->id)) {
                    $productCategories = new CategoryTreeEntity();
                    $categoriesList = $productCategoryBean->getCategoryList();
                    foreach ($categoriesList as $categoryBean) {
                        $category = new CategoryEntity();
                        $category->addItem(new CategoryIdEntity($categoryBean->id));
                        $category->addItem(new CategoryNameEntity($categoryBean->category_name));
                        $category->addItem(new CategoryLevelEntity($categoryBean->category_level));
                        $productCategories->addItem($category);
                    }
                    $product->addItem($productCategories);
                }
            }
            $shopOrder->addItem($orderProducts);
        }

        echo $shopOrder;
    }

    private function authenticate() {
        if ($this->secureAsHash) {
            if (strlen($this->hash) == 0) {
                $this->exitWithError("EMPTY HASH");
            }
            if (!$this->model->authenticateHash($this->hash)) {
                $this->exitWithError("WRONG HASH");
            }
        } else {
            if (!$this->model->authenticateLogin($this->login, $this->password)) {
                $this->exitWithError("NOT USER FOUND");
            }
        }
    }

    /**
     * @throws Exception
     */
    private function handleAuthorization() {
        $this->hash = InputHelper::handleInput("hash",false);
        if ($this->hash === false) {
            $this->login = InputHelper::handleInput("login",false);
            $this->password = InputHelper::handleInput("password",false);
            if ($this->login === false OR $this->password === false) {
                $this->exitWithError("Params 'login' or 'password' or 'hash' is not set.");
            } else {
                $this->secureAsHash = false;
            }
        } else {
            $this->secureAsHash = true;
        }
    }

    /**
     * @throws Exception
     */
    private function handleLanguage() {
        $language = InputHelper::handleInput("lang",false);
        if ($language !== false) {
            $this->language = $language;
        }
    }

    /**
     * @throws Exception
     */
    private function handleDates() {
        $this->date_from = InputHelper::handleInput("datum_od",false);
        if ($this->date_from === false) {
            $this->date_from = InputHelper::handleInput("date_from",false);
        }
        $this->date_to = InputHelper::handleInput("datum_do",false);
        if ($this->date_to === false) {
            $this->date_to = InputHelper::handleInput("date_to",false);
        }
        if ($this->date_from === false AND $this->date_to === false) {
           $this->date_from = date("Y-m-d",  strtotime("-7 DAY"));
           $this->date_to = date("Y-m-d");
        }
        if ($this->date_from === false) {
            $this->exitWithError("Param 'date_from' is not set.");
        }
        if ($this->date_to === false) {
            $this->exitWithError("Param 'date_to' is not set.");
        }
    }

    /**
     * @param string $message
     */
    private function exitWithError($message) {
        $this->showXmlHeader();
        echo new ErrorEntity($message);
        exit;
    }

    private function showXmlHeader() {
        header('Content-Type: application/xml; charset=utf-8');
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
    }
    
    public static function isNotDebug() {
        return !static::$debug;
    }
    
    /**
     * 
     * @return Config
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * 
     * @param Config $config
     */
    public function setConfig(Config $config) {
        $this->config = $config;
    }


}
