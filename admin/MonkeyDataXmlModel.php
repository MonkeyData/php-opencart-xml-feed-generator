<?php

use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model\CurrentXmlModelInterface;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model\XmlModel;

/**
 * Class MonkeyDataXmlModel
 *
 * Example class
 *
 * @author MD Developers
 */
class MonkeyDataXmlModel extends XmlModel implements CurrentXmlModelInterface {
    /**
     * Preparing orders is called 'per partes' in recursive function. In each call is start shifted by the length of step.
     * Default value of step is 1000.
     * If you mean that default value is inaccurate, you can change value: 
     * 
     * protected $step = 100;
     * 
     */

    /**
     * For use PDO set $config['database']['use'] = true | Usage: $this->connection->query("SELECT ...");
     *
     * @var array
     */
    protected $config = array(
        'database' => array(
            'use' => true,
            'host' => DB_HOSTNAME,
            'name' => DB_DATABASE,
            'user' => DB_USERNAME,
            'pass' => DB_PASSWORD,
            'prefix' => DB_PREFIX
        ),
        'security' => array(
            'hash' => "",
            'login' => "",
            'pass' => ""
        )
    );

    /**
     * @var string
     */
    protected $eshopName = "MyEshop";

    /**
     * @var string
     */
    protected $eshopId = "1";

    public function authenticateHash($hash) {
        if (version_compare(VERSION, '2.0', '>=')) {
            $hash_real = $this->connection->query("SELECT `value` FROM {$this->getTableName('setting')} WHERE `code` = 'monkey_data_tmp' && `key` = 'monkey_data_hash' LIMIT 0,1;")->fetchObject();
        } elseif (version_compare(VERSION, '1.5', '>=')) {
            $hash_real = $this->connection->query("SELECT `value` FROM {$this->getTableName('setting')} WHERE `group` = 'monkey_data' && `key` = 'hash' LIMIT 0,1;")->fetchObject();
        }
        $this->config['security']['hash'] = $hash_real->value;
        return parent::authenticateHash($hash);
    }

    /**
     * The function chooses a list of orders in selected period. The period is defined by parametres date_from and date_to.
     * The condition is met by orders which are created or updated in the selected period.
     * An example of the implementation of this condition: ((created >= '$date_from' AND created <= '$date_to') OR (updated >= '$date_from' AND updated<='$date_to'))
     * It is also important to set a limit. Values for start and step are defined by variables $start and $step ( LIMIT {$start},{$step} ). 
     * These variables are used for import optimalization if it contains large amount of orders.
     * @param string $date_from
     * @param string $date_to
     * @param int $start
     * @param int $step
     * @return array
     */
    public function getOrdersItems($date_from, $date_to, $start, $step) {
        $results = $this->connection->query(
                        "SELECT "
                        . "`o`.order_id, store_id, store_name, "
                        . "date_added, date_modified, order_status_id, "
                        . "`ot`.`value` as PriceWithoutVat, "
                        . "customer_id, comment, `o`.`total`, "
                        . "currency_id, currency_code "
                        . "FROM {$this->getTableName('order')} as o "
                        . "INNER JOIN {$this->getTableName('order_total')} as ot ON "
                        . "`o`.`order_id` = `ot`.`order_id` "
                        . "WHERE ((`o`.`date_added` >= '{$date_from} 00:00:00' "
                        . "AND `o`.`date_added` <= '{$date_to} 23:59:59')"
                        . "OR (`o`.`date_modified` >= '{$date_from} 00:00:00'"
                        . "AND `o`.`date_modified` <= '{$date_to} 23:59:59')) "
                        . "AND `ot`.`code` = 'sub_total' "
                        . "LIMIT {$start}, {$step}"
                )->fetchAll();



        $output = array();

        foreach ($results as $result) {
            $output[] = array(
                'id' => $result["order_id"],
                'shop_name' => $result["store_name"],
                'shop_id' => $result["store_id"],
                'date_created' => $result["date_added"],
                'date_updated' => $result["date_modified"],
                'price' => $result["total"],
                'price_without_vat' => $result["PriceWithoutVat"],
                'order_status_id' => $result["order_status_id"],
                'payment_id' => $result["order_id"],
                'shipping_id' => $result["order_id"],
                'customer_id' => $result["customer_id"],
                'note' => $result["comment"],
                'currency' => $result["currency_code"],
                'currency_id' => $result["currency_id"]
            );
        }

        return $output;
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
     * 
     * @param array $paymentIds
     * @return array
     */
    public function getPaymentsItems($paymentIds) {
        $results = $this->connection->query(
                        "SELECT "
                        . "`o`.`order_id`, payment_method "
                        . "FROM {$this->getTableName('order')} as `o` "
                        . "WHERE `o`.`order_id` "
                        . "IN ('" . implode("', '", $paymentIds) . "') "
                )->fetchAll();

        $output = array();

        foreach ($results as $result) {

            $payment = $this->connection->query(
                            "SELECT value "
                            . "FROM {$this->getTableName('order_total')} as `ot` "
                            . "WHERE order_id = {$result["order_id"]} "
                            . "AND code = 'payment' "
                    )->fetch();

            $payment = isset($payment['value']) ? $payment['value'] : 0;

            $output[] = array(
                'id' => $result["order_id"],
                'payment_name' => $result["payment_method"],
                'payment_price' => $payment,
                'payment_price_without_vat' => $payment
            );
        }

        return $output;
    }

    /**
     * This function prepares the list of shipping with information about a name, a price and a price ex. VAT.
     * 
     * id - shipping id
     * shippping_name - shipping name
     * shippping_price - shipping price incl. VAT
     * shippping_price_without_vat - shipping price ex. VAT
     * 
     *
     * The list can be implemented under a condition from actually used orders Shipping IDs, this list is available as a $shipppingIds field.
     * If you decide not to use the list of ids of shipping found in orders, the export can be slower and more data-demanding, in case of larger amount of shipping types.

     * 
     * @param array $shipppingIds
     * @return array
     */
    public function getShippingsItems($shipppingIds) {

        $results = $this->connection->query(
                        "SELECT "
                        . "`o`.`order_id`, shipping_method, value "
                        . "FROM {$this->getTableName('order')} as `o` "
                        . "INNER JOIN {$this->getTableName('order_total')} as `ot` ON "
                        . "`o`.`order_id` = `ot`.`order_id` "
                        . "WHERE `o`.`order_id` "
                        . "IN ('" . implode("', '", $shipppingIds) . "') "
                        . "AND (code = 'shipping') "
                )->fetchAll();

        $output = array();

        foreach ($results as $result) {
            $output[] = array(
                'id' => $result["order_id"],
                'shipping_name' => $result["shipping_method"],
                'shipping_price' => $result["value"],
                'shipping_price_without_vat' => $result["value"]
            );
        }

        return $output;
    }

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
     * 
     * @param array $orderIds
     * @return array
     */
    public function getProductsItems($orderIds) {
        $results = $this->connection->query(
                        "SELECT "
                        . "`op`.`product_id`, order_id, price, tax, "
                        . "total, name, quantity, category_id "
                        . "FROM {$this->getTableName('order_product')} as `op` "
                        . "INNER JOIN {$this->getTableName('product_to_category')} as `pc` ON "
                        . "`op`.`product_id` = `pc`.`product_id` "
                        . "WHERE order_id "
                        . "IN ('" . implode("', '", $orderIds) . "')"
                )->fetchAll();

        $output = array();

        foreach ($results as $result) {
            $tax = (empty($result["tax"])) ? 0 : $result["tax"];

            $output[] = array(
                'id' => $result["product_id"],
                'order_id' => $result["order_id"],
                'product_name' => $result["name"],
                'product_count' => $result["quantity"],
                'product_price' => $result["price"] + $tax,
                'product_price_without_vat' => $result["price"],
                'product_purchase_price' => $result["price"],
                'category_id' => $result["category_id"]
            );
        }
        return $output;
    }

    /**
     *  This function prepares the list of orders statuses as key-value pairs, named ids and order_status_name,
     *  then the name is searched by an id.
     * 
     * 
     *  The list can be implemented under a condition from actually used orders OrderStatus IDs, this list is available as a $orderStatusesIds field.
     *  If you decide not to use the list of ids of orders statuses found in orders, the export can be slower and more data-demanding.
     *
     * 
     * @param array $orderStatusesIds
     * @return array
     */
    public function getOrderStatusesItems($orderStatusesIds) {
        $results = $this->connection->query(
                        "SELECT "
                        . " order_status_id, name "
                        . "FROM {$this->getTableName('order_status')} "
                        . "WHERE order_status_id "
                        . "IN ('" . implode("', '", $orderStatusesIds) . "')"
                )->fetchAll();

        $output = array();

        foreach ($results as $result) {
            $output[] = array(
                'id' => $result["order_status_id"],
                'order_status_name' => $result["name"]
            );
        }
        return $output;
    }

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
     * @param array $customerIds
     * @return array
     */
    public function getCustomersItems($customerIds) {
        $results = $this->connection->query(
                        "SELECT "
                        . "customer_id, email, payment_city, payment_country, "
                        . "payment_firstname, payment_postcode, payment_company "
                        . "FROM {$this->getTableName('order')} "
                        . "WHERE customer_id "
                        . "IN ('" . implode("', '", $customerIds) . "') "
                )->fetchAll();

        $output = array();

        foreach ($results as $result) {

            $registration = $result["customer_id"] == 0 ? false : $result["customer_id"];
            $customerType = $result["payment_company"] == null ? 0 : 1;

            $output[] = array(
                'id' => $result["customer_id"],
                'customer_email' => $result["email"],
                'customer_city' => $result["payment_city"],
                'customer_country' => $result["payment_country"],
                'customer_firstname' => $result["payment_firstname"],
                'customer_registration' => $registration,
                'customer_zip_code' => $result["payment_postcode"],
                'customer_vat_status' => 1,
                'customer_type' => $customerType
            );
        }
        return $output;
    }

    /**
     * this function prepares the list of categories with information about:
     * id - category ID
     * category_name - category name
     * parent_id - ID  of a parent category

     * @return array
     */
    public function getCategoriesItems() {

        $results = $this->connection->query(
                        "SELECT "
                        . "`c`.`category_id`, parent_id, name "
                        . "FROM {$this->getTableName('category')} as `c`"
                        . "INNER JOIN {$this->getTableName('category_description')} as `cd` ON "
                        . " `cd`.`category_id` = `c`.`category_id` "
                )->fetchAll();

        $output = array();

        foreach ($results as $result) {
            $output[] = array(
                'id' => $result["category_id"],
                'category_name' => $result["name"],
                'parent_id' => $result["parent_id"]
            );
        }
        return $output;
    }

    private function getTableName($tableName) {
        return "`" . $this->config['database']['prefix'] . "{$tableName}`";
    }

}
