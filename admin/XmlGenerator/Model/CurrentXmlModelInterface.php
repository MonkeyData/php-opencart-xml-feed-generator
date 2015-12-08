<?php
namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model;

/**
 * interface CurrentXmlModel
 *
 * @author MD Developers
 */
interface CurrentXmlModelInterface {
    
    /**
    * The function chooses a list of orders in selected period. The period is defined by parametres date_from and date_to.
     * The condition is met by orders which are created or updated in the selected period.
     * An example of the implementation of this condition: ((created >= '$date_from' AND created <= '$date_to') OR (updated >= '$date_from' AND updated<='$date_to'))
     * It is also important to set a limit. Values for start and step are defined by variables $start and $step ( LIMIT {$start},{$step} ). 
     * These variables are used for import optimalization if it contains large amount of orders.
     * 
     * 
     * f.a.:
     * $result = $this->connection->query("
     *     SELECT id, shop_name, shop_id, ... 
     *     FROM your_orders_table
     *     WHERE ((date_created >= '{$date_from}' AND date_created <= '{$date_to}') 
     *     OR (date_updated >= '{$date_from}' AND date_updated<='{$date_to}')) 
     *     LIMIT {$start},{$step}
     *     ");
     * 
     * @param string $date_from
     * @param string $date_to
     * @param int $start
     * @param int $step
     * @return array
     */
    function getOrdersItems($date_from, $date_to, $start, $step);

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
     * f.a.:
     * $result = $this->connection->query("
     *  SELECT id, payment_name, payment_price, payment_price_without_vat 
     *  FROM your_payment_catalog_table
     *  WHERE id IN ('". implode("', '", $paymentIds)."') 
     *  ");
     * 
     * @param array $paymentIds
     * @return array
     */
    function getPaymentsItems($paymentIds);

    /**
     * This function prepares the list of shipping with information about a name, a price and a price ex. VAT.
     * 
     * id - shipping id
     * shipping_name - shipping name
     * shipping_price - shipping price incl. VAT
     * shipping_price_without_vat - shipping price ex. VAT
     * 
     *
     * The list can be implemented under a condition from actually used orders Shipping IDs, this list is available as a $shipppingIds field.
     * If you decide not to use the list of ids of shipping found in orders, the export can be slower and more data-demanding, in case of larger amount of shipping types.
     * 
     * for example.:
     * $result = $this->connection->query("
     *     SELECT id, shipping_name, shipping_price, shipping_price_without_vat 
     *     FROM your_shipping_catalog_table
     *     WHERE id IN ('". implode("', '", $shipppingIds)."') 
     *     ");
     * 
     * @param array $shipppingIds
     * @return array
     */
    function getShippingsItems($shipppingIds);

    /**
     * This function prepares the list of products with information about a name, a price and a price ex. VAT.
     * 
     * id - product id
     * order_id - id of order in which the product is saved
     * product_name - product name
     * product_count - number of products in an order
     * product_price - product price incl. VAT at the time of order completion
     * product_price_without_vat - product price ex. VAT at the time of order completion
     * product_purchase_price - product purchase price ex. VAT at the time of order completion
     * category_id - id of a category in which the product is placed.
     * 
     * The list can be implemented under a condition from actually used orders Order IDs, this list is available as a $orderIds field.
     * If you decide not to use the list of ids of orders found in orders, the export can be slower and more data-demanding, in case of larger amount of orders.
     * 
     * for example:
     * $result = $this->connection->query("
     *  SELECT p.id, op.order_id, p.product_name, op.product_count, op.product_price, op.product_price_without_vat, op.product_purchase_price, p.category_id
     *  FROM your_products_table as p
     *  JOIN yout_order_products_table as op ON (p.id = op.product_id)
     *  WHERE op.order_id IN ('". implode("', '", $orderIds)."')
     *  ");
     * 
     * @param array $orderIds
     * @return array
     */
    function getProductsItems($orderIds);

    
    
    /**
     *  This function prepares the list of orders statuses as key-value pairs, named ids and order_status_name,
     *  then the name is searched by an id.
     * 
     * 
     *  The list can be implemented under a condition from actually used orders OrderStatus IDs, this list is available as a $orderStatusesIds field.
     *  If you decide not to use the list of ids of orders statuses found in orders, the export can be slower and more data-demanding.
     *
     *  for example:
     * $result = $this->connection->query("
     *    SELECT id, order_status_name
     *    FROM your_order_status_catalog_table 
     *    WHERE id IN ('". implode("', '", $orderStatusesIds)."') 
     *    ");
     * 
     * @param array $orderStatusesIds
     * @return array
     */
    function getOrderStatusesItems($orderStatusesIds);
    
    
    /**
     * 
     * This function prepares the list of customers with information about:
     * 
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
     * 
     *
     * The list can be implemented under a condition from actually used orders Customer IDs, this list is available as a $customerIds field.
     *  If you decide not to use the list of ids of customers found in orders, the export can be slower and more data-demanding, in case of larger amount of customers.
     * 
     * for example:
     * $result = $this->connection->query("
     *    SELECT id, customer_email, customer_city, ...
     *    FROM your_customer_table
     *    WHERE id IN ('".  implode("', '", $customerIds)."')
     *    ");
     * 
     * @param array $customerIds
     * @return array
     */
    function getCustomersItems($customerIds);
        
    
    
    
    /**
     * this function prepares the list of categories with information about:
     * id - category ID
     * category_name - category name
     * parent_id - ID  of a parent category
     *
     * for example: 
     * $result = $this->connection->query("SELECT id, category_name, parent_id FROM categories");
     * 
     * @return array
     */
    function getCategoriesItems();
}
