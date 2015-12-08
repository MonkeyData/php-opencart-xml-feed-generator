<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model;

use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\CategoryList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderProductsList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\OrderStatusList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\PaymentList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\ProductCategoriesList;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans\ShippingList;


/**
 * Interface XmlModel
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model
 * @author MD Developers
 */
interface XmlModelInterface {

    public function __construct();

    /**
     * @return array
     */
    public function getCategoriesItems();

    /**
     * @param array $categoriesList
     * @param string $categoryId
     * @param string $productId
     * @return CategoryList
     */
    public function getCategories($categoriesList, $categoryId, $productId);

    /**
     * @param $row
     * @param ProductCategoriesList $categoriesList
     * @param string $productId
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function setCategory($row, $categoriesList, $productId);

    /**
     * @param string $date_from
     * @param string $date_to
     * @param int $start
     * @param int $step
     * @return OrderList
     */
    public function selectOrders($date_from, $date_to, $start, $step);

    /**
     * @param array $paymentIds
     * @return PaymentList
     */
    public function getPayments($paymentIds);

    /**
     * @param array $shipppingIds
     * @return ShippingList
     */
    public function getShippings($shipppingIds);

    /**
     * @param array $customerIds
     * @return ShippingList
     */
    public function getCustomers($customerIds);

    // TODO: Implement
    public function selectProducts();

    /**
     * @param array $getOrderStatusesIds
     * @return OrderStatusList
     */
    public function getOrderStatuses($getOrderStatusesIds);

    /**
     * @param array $orderIds
     * @return OrderProductsList
     */
    public function getProducts($orderIds);

    /**
     * @param array $row
     * @param OrderProductsList $list_of_product_list
     * @return OrderProductsList
     * @throws \MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException
     */
    public function setProductList($row, $list_of_product_list);

    /**
     * @return OrderList
     */
    public function getOrders();

    /**
     * @param string $date_from
     * @param string $date_to
     */
    public function prepareOrders($date_from, $date_to);

    /**
     * @param string $hash
     * @return bool
     */
    public function authenticateHash($hash);

    public function authenticateLogin($login, $password);

    /**
     * @param int $step
     */
    public function setStep($step = 1000);

    /**
     * @param int $start
     */
    public function setStart($start = 0);

    /**
     * @return string
     */
    public function getEshopId();

    /**
     * @return string
     */
    public function getEshopName();

    /**
     * @return array
     */
    public function getOrderIds();

    /**
     * @return array
     */
    public function getPaymentIds();

    /**
     * @return array
     */
    public function getShipppingIds();

    /**
     * @return array
     */
    public function getCustomerIds();

    /**
     * @return array
     */
    public function getOrderStatusesIds();
}