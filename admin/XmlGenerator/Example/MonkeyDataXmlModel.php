<?php

namespace MonkeyDataExample;

use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model\XmlModel;


/**
 * Class MonkeyDataXmlModel
 *
 * Example class
 *
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Example
 * @author MD Developers
 */
class MonkeyDataXmlModel extends XmlModel {

    /**
     * For use PDO set $config['database']['use'] = true | Usage: $this->connection->query("SELECT ...");
     *
     * @var array
     */
    protected $config = array(
        'database' => array(
            'use'  => false,
            'host' => "localhost",
            'name' => "db_name",
            'user' => "db_user",
            'pass' => "db_pass"
        ),
        'security' => array(
            'hash' => "123456",
            'login' => "john",
            'pass' => "dow"
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

    public function __construct() {
        parent::__construct();
    }

    /**
     * Fce vybere seznam objednavek v zadaném období. Období je definováno pomocí parametrů date_from a date_to. 
     * Podmínce vyhoví objednávky které jsou v zadaném období vytvořené(created), a nebo ty které jsou v tomto období upraveny (updated).
     * Příklad implementace této podmínky: ((created >= '$date_from' AND created <= '$date_to') OR (updated >= '$date_from' AND updated<='$date_to'))
     * Dále je velmi důležité implementovat do dotazu nastavení limitu. Hodnoty pro start a step jsou v proměnnych $start a $step ( LIMIT {$start},{$step} ). 
     * Tyto slouží k optimalizaci běhu importu v případě že obsahuje velké množství objednávek.
     * 
     * @param string $date_from
     * @param string $date_to
     * @param int $start
     * @param int $step
     * @return array
     */
    protected function getOrdersItems($date_from, $date_to, $start, $step) {
        // $result = $this->connection->query("
        // SELECT id, shop_name, shop_id, ... 
        // FROM your_orders_table
        // WHERE ((created >= '$date_from' AND created <= '$date_to') 
        // OR (updated >= '$date_from' AND updated<='$date_to')) 
        // LIMIT {$start},{$step}
        // ");
        
        $result = array(
            array(
                'id' => "1",
                'shop_name' => "Můj E-Shop",
                'shop_id' => "Můj E-Shop",
                'date_created' => "2015-10-10 10:10:10",
                'date_updated' => "2015-10-10 10:10:10",
                'price' => 1000.0,
                'price_without_vat' => 200.0,
                'order_status_id' => "1",
                'payment_id' => "1",
                'shipping_id' => "1",
                'customer_id' => "1",
                'note' => "Example note",
                'currency' => "CZK",
                'currency_id' => "1"
            )
        );
        return $result;
    }

    /**
     * tato funce pripravuje seznam plateb s informacemi:
     * 
     * id - id platby
     * payment_name - název platby
     * payment_price - cena platby s DPH
     * payment_price_without_vat - cena platby bez DPH
     * 
     * Seznam by může bý implementován na základě podmínky z realně použitých Payment ID z objednávek, tento seznam id je dostupný jako pole $paymentIds. 
     * Pokud se rozhodnete nepoužít seznam id plateb nalezených v objednávkách, může být export pomalejší a datově náročnější, v případě většího množství typů plateb.
     *
     * 
     * 
     * @param array $paymentIds
     * @return array
     */
    protected function getPaymentsItems($paymentIds) {
        //$result = $this->connection->query("
        //SELECT id, payment_name, payment_price, payment_price_without_vat 
        //FROM your_payment_catalog_table
        //WHERE id IN ('". implode("', '", $paymentIds)."') 
        //");
        
        $result = array(
            array(
                'id' => "1",
                'payment_name' => "Cash",
                'payment_price' => 0,
                'payment_price_without_vat' => 0
            )
        );
        return $result;
    }

    /**
     * Tato funce pripravuje seznam doprav s informacemi o nazvu, cene, cene bez dph. 
     * 
     * id - id dopravy
     * shippping_name - název dopravy
     * shippping_price - cena dopravy s DPH
     * shippping_price_without_vat - cena dopravy bez DPH
     * 
     * Seznam by může bý implementován na základě podmínky z realně použitých Shipping ID z objednávek, tento seznam id je dostupný jako pole $shipppingIds. 
     * Pokud se rozhodnete nepoužít seznam id doprav nalezených v objednávkách, může být export pomalejší a datově náročnější, v případě většího množství typů doprav.
     * 
     * 
     * @param array $shipppingIds
     * @return array
     */
    protected function getShippingsItems($shipppingIds) {
        //$result = $this->connection->query("
        //SELECT id, shipping_name, shipping_price, shipping_price_without_vat 
        //FROM your_shipping_catalog_table
        //WHERE id IN ('". implode("', '", $shipppingIds)."') 
        //");
        
        $result = array(
            array(
                'id' => "1",
                'shipping_name' => "Cash",
                'shipping_price' => 0,
                'shipping_price_without_vat' => 0
            )
        );
        return $result;
    }

    /**
     * Tato funce pripravuje seznam produktů s informacemi o nazvu, cene, cene bez dph. 
     * 
     * id - id produktu
     * order_id - od objednavky ve ktere je produkt ulozen
     * product_name - náyev produktu
     * product_count - pocet produktů v objednávkce
     * product_price - cena produktu s DPH v době dokončení obejdnávky
     * product_price_without_vat - cena produktu bez DPH v době dokončení obejdnávky
     * product_purchase_price - nákupní cena produktu bez DPH v době dokončení obejdnávky
     * category_id - id kategorie ve které je produkt v eshopu umístěn.
     * 
     * Seznam by může bý implementován na základě podmínky z realně použitých Order ID z objednávek, tento seznam id je dostupný jako pole $orderIds. 
     * Pokud se rozhodnete nepoužít seznam id objednávek nalezených v objednávkách, může být export pomalejší a datově náročnější, v případě většího množství objednávek.
     * 
     * 
     * @param array $orderIds
     * @return array
     */
    protected function getProductsItems($orderIds) {
        // OR $result = $this->connection->query("
        // SELECT p.id, op.order_id, p.product_name, op.product_count, op.product_price, op.product_price_without_vat, op.product_purchase_price, p.category_id
        // FROM your_products_table as p
        // JOIN yout_order_products_table as op ON (p.id = op.product_id)
        // WHERE op.order_id IN ('". implode("', '", $orderIds)."')
        // ");
        
        $result = array(
            array(
                'id' => "1",
                'order_id' => "1",
                'product_name' => "Example product name",
                'product_count' => 2,
                'product_price' => 500.0,
                'product_price_without_vat' => 400.0,
                'product_purchase_price' => 500.0,
                'category_id' => "2"
            )
        );
        return $result;
    }

    /**
     *  priprav seznam stavu objednavek jako key-value pary, pojmenovane id a order_status_name, 
     *  podle id se nasledne vyhledava nazev.
     * 
     *  Seznam by může bý implementován na základě podmínky z realně použitých OrderStatus ID z objednávek, tento seznam id je dostupný jako pole $orderStatusesIds. 
     *  Pokud se rozhodnete nepoužít seznam id stavů objednávek nalezených v objednávkách, může být export pomalejší a datově náročnější.
     * 
     * @param array $orderStatusesIds
     * @return array
     */
    protected function getOrderStatusesItems($orderStatusesIds) {
        //$result = $this->connection->query("
        //SELECT id, order_status_name
        //FROM your_order_status_catalog_table 
        //WHERE id IN ('". implode("', '", $orderStatusesIds)."') 
        //");
        
        $result = array(
            array('id' => '1', 'order_status_name' => 'pending')
        );
        return $result;
    }

    /**
     * 
     * tato funce pripravuje seznam zákazníků s informacemi:
     * id - ID uživatele
     * customer_firstname - uživatelovo křestní jméne
     * customer_country - země podle adresy
     * customer_city - město podle adresy
     * customer_zip_code - poštovní směrovací číslo podle adresy
     * customer_email
     * customer_registration - zda se jedná o nákup registrovaného zákazníka ( 0 ), nebo si zvolil nákup bez registrace( 1 ),(INT 0 nebo 1)
     * customer_type - zda je to koncový zákazník ( 0 ) nebo firma ( 1 )(INT 0 nebo 1)
     * customer_vat_status - udává, zda se jedná o plátce DPH (1) či nikoliv (0). (INT 0 nebo 1)
     * 
     * Seznam by může bý implementován na základě podmínky z realně použitých Customer ID z objednávek, tento seznam id je dostupný jako pole $customerIds. 
     * Pokud se rozhodnete nepoužít seznam id uživatelů nalezených v objednávkách, může být export pomalejší a datově náročnější, v případě většího množství uživatelů.
     * 
     * 
     * @param array $customerIds
     * @return array
     */
    protected function getCustomersItems($customerIds) {
        //$result = $this->connection->query("
        //SELECT id, customer_email, customer_city, ...
        //FROM your_customer_table
        //WHERE id IN ('".  implode("', '", $customerIds)."')
        //");
        
        
        $result =  array(
            array(
                'id' => "1",
                'customer_email' => "mail@example.com",
                'customer_city' => "Example city",
                'customer_country' => "Example country",
                'customer_firstname' => "Example firstname",
                'customer_registration' => true,
                'customer_zip_code' => "777 77",
                'customer_vat_status' => false,
                'customer_type' => "customer"
            )
        );
        return $result;
    }

    /**
     * tato funkce připravuje seznam kategorii s informacemi:
     * id - ID kategorie
     * category_name - Název kategorie
     * parent_id - ID rodičovské kategorie (nadřazené kategorie)
     *
     * @return array
     */
    public function getCategoriesItems() {
        // OR $result = $this->connection->query("SELECT id, category_name, parent_id, ...");
        $result = array(
            array(
                'id' => "1",
                'category_name' => "Example category",
                'parent_id' => null
            ),
            array(
                'id' => "2",
                'category_name' => "Example category 2",
                'parent_id' => "1"
            )
        );
        return $result;
    }
}