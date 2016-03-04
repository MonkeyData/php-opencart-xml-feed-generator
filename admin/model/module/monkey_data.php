<?php


class ModelModulemonkeydata extends Model
{


    public function LoadHash()
    {
        if (version_compare(VERSION, '2.0.0.0', '=')) {
            return $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `group` = 'monkey_data' && `key` = 'monkey_data_hash' LIMIT 0,1;");
        } elseif (version_compare(VERSION, '2.0.1.0', '>=')) {
            return $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `code` = 'monkey_data_tmp' && `key` = 'monkey_data_hash' LIMIT 0,1;");
        } elseif (version_compare(VERSION, '1.5', '>=')) {
            return $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `group` = 'monkey_data' && `key` = 'hash' LIMIT 0,1;");
        }


    }


}

?>