<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model;

use Exception;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\CategoryBean;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\CategoryList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\CustomerBean;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\CustomerList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderBean;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderProductBeans;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderProductsList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderStatusBean;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderStatusList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\PaymentBean;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\PaymentList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\ProductBean;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\ProductCategoriesList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\ProductCategoryBeans;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\ProductsList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\ShippingBean;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\ShippingList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\MonkeyDataDbHelper;


/**
 * Class XmlModel
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model
 * @author MD Developers
 */
abstract class XmlModel implements XmlModelInterface {

    /**
     * For use PDO set $config['database']['use'] = true | Usage: $this->connection->query("SELECT ...");
     *
     * @var array
     */
    protected $config = array(
        'database' => array(
            'use'  => true,
            'host' => "localhost",
            'name' => "db_name",
            'user' => "db_user",
            'pass' => "db_password"
        ),
        'security' => array(
            'hash' => "",
            'login' => "",
            'pass' => ""
        )
    );
    
    /**
     *
     * @var MonkeyDataDbHelper 
     */
    protected $connection;

    /**
     * @var array
     */
    private $orderIds = array();

    /**
     * @var array
     */
    private $paymentIds = array();

    /**
     * @var array
     */
    private $shippingIds = array();

    /**
     * @var array
     */
    private $customerIds = array();

    /**
     * @var array
     */
    private $orderStatusesIds = array();
    
    /**
     *
     * @var OrderList 
     */
    private $orders;
    
    /**
     *
     * @var OrderProductsList 
     */
    private $list_of_product_list;

    /**
     * @var int
     */
    protected $start = 0;

    /**
     * @var int
     */
    protected $step = 1000;

    /**
     * @var string
     */
    protected $eshopName = "My Eshop";

    /**
     * @var string
     */
    protected $eshopId = "1";

    public function __construct() {
        $this->checkConfig();
        if ($this->config['database']['use']) {
            $this->connection = MonkeyDataDbHelper::getInstance($this->config['database']);
        }
        $this->orders = new OrderList();
        $this->list_of_product_list = new OrderProductsList();
    }

    

    /**
     * @param string $date_from
     * @param string $date_to
     * @param int $start
     * @param int $step
     * @return OrderList
     */
    public function selectOrders($date_from, $date_to, $start, $step) {
        $result = $this->getOrdersItems($date_from, $date_to, $start, $step);
        $orders = new OrderList();
        foreach ($result as $row) {
            $orders->addBean(new OrderBean($row));
        }
        return $orders;
    }

    /**
     * this function prepares list of orders with information about:
     * 
     * id - playment id
     * payment_name - payment name
     * payment_price - payment price incl. VAT
     * payment_price_without_vat - payment price ex. VAT
     * 
     * The list can be implemented under a condition from actually used orders Payment IDs, this list is available as a $paymentIds field.
     * If you decide not to use the list of ids of payments found in orders, the export can be slower and more data-demanding, in case of larger amount of payments.
     *
     * @param array $paymentIds
     * @return PaymentList
     */
    public function getPayments($paymentIds) {
        $result = $this->getPaymentsItems($paymentIds);
        $data = new PaymentList();
        foreach ($result as $item) {
            $data->addBean(new PaymentBean($item));
        }
        return $data;
    }

    /**
     * This function prepares the list of shipping with information about a name, a price and a price ex. VAT.
     *
     * The list can be implemented under a condition from actually used orders Shipping IDs, this list is available as a $shipppingIds field.
     * If you decide not to use the list of ids of shipping found in orders, the export can be slower and more data-demanding, in case of larger amount of shipping types.
     * 
     * @param array $shipppingIds
     * @return ShippingList
     */
    public function getShippings($shipppingIds) {
        $result = $this->getShippingsItems($shipppingIds);
        $data = new ShippingList();
        foreach ($result as $item) {
            $data->addBean(new ShippingBean($item));
        }
        return $data;
    }

    /**
     * This function prepares the list of customers with information about:
     *
     * id - user ID
     * customer_firstname - customer's first name
     * customer_country - country according to customer's address
     * customer_city - country according to customer's address
     * customer_zip_code - ZIP code according to customer's address
     * customer_email - customer's email
     * customer_registration - indicates if it is a registered customer ( 0 ), or he chose the purchase without registration ( 1 ), (INT 0 or 1)
     * customer_type - indicates if it is an end customer ( 0 ) or a company ( 1 ), (INT 0 or 1)
     * customer_vat_status - indicates  it is a VAT payer (1) or not (0), (INT 0 or 1)
     * The list can be implemented under a condition from actually used orders Shipping IDs, this list is available as a $this->getShippingsIds() list.
     *  If you decide not to use the list of ids of customers found in orders, the export can be slower and more data-demanding, in case of larger amount of orders.
     *
     * @param array $customerIds
     * @return ShippingList
     */
    public function getCustomers($customerIds) {
        $result = $this->getCustomersItems($customerIds);
        $data = new CustomerList();
        foreach ($result as $row) {
            $data->addBean(new CustomerBean($row));
        }
        return $data;
    }

    
    /**
     *  This function prepares the list of orders statuses as key-value pairs, named ids and order_status_name,
     *  then the name is searched by an id.
     *
     *  After inserting the order into the OrderStatusList a valiation has to be made on two levels:
     * 1. check all required collumns are filled in
     * 2. check data types and the value of the column
     *
     * @param array $getOrderStatusesIds
     * @return OrderStatusList
     */
    public function getOrderStatuses($getOrderStatusesIds) {
        $result = $this->getOrderStatusesItems($getOrderStatusesIds);
        $orderStatusList = new OrderStatusList();
        foreach ($result as $item) {
            $orderStatusList->addBean(new OrderStatusBean($item));
        }
        return $orderStatusList;
    }

    /**
     * This function prepares the list of products for every order. Informtion about the product:
     *
     * id - product id
     * product_name - product name
     * product_count - number of units of the product in the order
     * product_price - product price inc. VAT
     * product_price_without_vat - product price ex. VAT
     * product_purchase_price - product purchase price ex. VAT
     * category_id - category id
     *
     *
     *
     * Saving this list of lists is a bit more difficult, Data is saved info the structure
     *
     * list($list_of_product_list) - bean($product_list_bean) - list($product_list) - bean($product_bean)
     *
     * to understand saving, let's begin from the end.
     *  - The last element is Bean object - data-based representation of a single product (consists all atributes mentioned above) ($product_bean).
     *  - All products are being saved into the object List = the list. One lost represents a list of products from one order ($product_list).
     *  - Every List is saved into its own Bean, plus the information of which order this list of products belongs to ($product_list_bean).
     *  - In the end, there is this bean, consisting of a list of products for one order and order id into the object List, where the list of product lists is creted ($list_of_product_list)
     *
     * @param array $orderIds
     * @return OrderProductsList
     */
    public function getProducts($orderIds) {
        $result = $this->getProductsItems($orderIds);
        $list_of_product_list = new OrderProductsList();
        foreach ($result as $row) {
            $this->setProductList($row, $list_of_product_list);
        }
        return $list_of_product_list;
    }

    /**
     * @param array $row
     * @param OrderProductsList $list_of_product_list
     * @return OrderProductsList
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function setProductList($row, $list_of_product_list) {
        $order_id = $row['order_id'];
        unset($row['order_id']);
        $product_bean = new ProductBean($row);
        $product_bean->validate();
        if ($product_list_bean = $list_of_product_list->getBeanById($order_id)) {
            $product_list_bean->getProduct_list()->addBean($product_bean);
            $list_of_product_list->addBean($product_list_bean);
        } else {
            $product_list = new ProductsList();
            $product_list->addBean($product_bean);
            $product_list_bean = new OrderProductBeans(array("id" => $order_id, "product_list" => $product_list));
            $list_of_product_list->addBean($product_list_bean);
        }
        return $list_of_product_list;
    }

    /**
     * @param array $categoriesList
     * @param string $categoryId
     * @return ProductCategoriesList
     */
    public function getCategories($categoriesList, $categoryId, $productId) {
        $result = $this->getCategoryTree($categoriesList, $categoryId);
        $productCategoriesList = new ProductCategoriesList();
        foreach ($result as $row) {
            $this->setCategory($row, $productCategoriesList, $productId);
        }
        return $productCategoriesList;
    }

    /**
     * @param $row
     * @param ProductCategoriesList $categoriesList
     * @param string $productId
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function setCategory($row, $categoriesList, $productId) {
        $categoryBean = new CategoryBean($row);
        $categoryBean->validate();
        if ($categoriesListBean = $categoriesList->getBeanById($productId)) {
            $categoriesListBean->getCategoryList()->addBean($categoryBean);
            $categoriesList->addBean($categoriesListBean);
        } else {
            $categoryList = new CategoryList();
            $categoryList->addBean($categoryBean);
            $categoriesListBean = new ProductCategoryBeans(array('id' => $productId, 'category_list' => $categoryList));
            $categoriesList->addBean($categoriesListBean);
        }
    }

    /**
     * @return OrderList
     */
    public function getOrders() {
        return $this->orders;
    }

    /**
     * @param string $date_from
     * @param string $date_to
     */
    public function prepareOrders($date_from, $date_to) {
        $this->orders = $this->selectOrders($date_from, $date_to, $this->start, $this->step);
        $this->orderIds = $this->orders->getIds();
        foreach ($this->orders as $order) {
            $this->paymentIds[$order->payment_id] = $order->payment_id;
            $this->shippingIds[$order->shipping_id] = $order->shipping_id;
            $this->customerIds[$order->customer_id] = $order->customer_id;
            $this->orderStatusesIds[$order->order_status_id] = $order->order_status_id;
        }
        $this->start += $this->step;
    }

    /**
     * @param string $hash
     * @return bool
     */
    public function authenticateHash($hash) {
        return $this->config['security']['hash'] === $hash;
    }

    public function authenticateLogin($login, $password) {
        return $this->config['security']['login'] === $login AND $this->config['security']['pass'] === $password;
    }

    /**
     * @param int $step
     */
    public function setStep($step = 1000) {
        $this->step = $step;
    }
    
    public function getStep(){
        return $this->step;
    }

    /**
     * @param int $start
     */
    public function setStart($start = 0) {
        $this->start = $start;
    }
    
    /**
     * @param int $start
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * @return string
     */
    public function getEshopId() {
        return $this->eshopId;
    }

    /**
     * @return string
     */
    public function getEshopName() {
        return $this->eshopName;
    }

    /**
     * @return array
     */
    public function getOrderIds() {
        return $this->orderIds;
    }

    /**
     * @return array
     */
    public function getPaymentIds() {
        return $this->paymentIds;
    }

    /**
     * @return array
     */
    public function getShipppingIds() {
        return $this->shippingIds;
    }

    /**
     * @return array
     */
    public function getCustomerIds() {
        return $this->customerIds;
    }

    /**
     * @return array
     */
    public function getOrderStatusesIds() {
        return $this->orderStatusesIds;
    }

    /**
     * @param array $categoryList
     * @param string $categoryId
     * @param $usageCategoriesList
     * @return array
     */
    private function getCategoryTree($categoryList, $categoryId, $usageCategoriesList = array()) {
        $result = array();
        
        $categoryListIds = array();
        foreach($categoryList as $i => $value){
            $categoryListIds[$i] = $value['id'];
        }
        $index = array_search($categoryId, $categoryListIds);
        
        if ($index !== false) {
            $category = $categoryList[$index];
            if (!is_null($category['parent_id'])) {
                $usageCategoriesList[] = $category;
                unset($categoryList[$index]);
                $result = $this->getCategoryTree($categoryList, $category['parent_id'], $usageCategoriesList);
            } else {
                $usageCategoriesList[] = $category;
                $categoryLevel = 0;
                for ($i = count($usageCategoriesList) - 1; $i >= 0; $i--) {
                    $category = $usageCategoriesList[$i];
                    $result[] = array(
                        'id' => $category['id'],
                        'category_name' => $category['category_name'],
                        'category_level' => $categoryLevel++,
                        'parent_id' => $category['parent_id']
                    );
                }
            }
        }
        return $result;
    }

    private function checkConfig() {
        try {
            if (!isset($this->config['database'])) {
                throw new Exception("Config: Database is required");
            }
            if (!isset($this->config['security'])) {
                throw new Exception("Config: Security is required");
            }
            if (!isset($this->config['database']['use'])) {
                throw new Exception("Config -> Database: Use is required");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }
}
