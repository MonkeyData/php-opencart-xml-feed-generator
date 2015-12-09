<?php

/*
 * Author: MonkeyData
 * E-mail: info@monkeydata.cz
 * Website: www.monkeydata.cz
 *
 */

class ControllerModulemonkeydata extends Controller {

    private $error = array();

    public function index() {

        $this->load->language('module/monkey_data');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        $this->load->model('design/layout');



        $this->load->model('module/monkey_data');

        $hash = $this->model_module_monkey_data->LoadHash();

        $data = array();
        $data['tr'] = [];
        $data['tr']['module_name'] = $this->language->get('heading_title');
        
        if (version_compare(VERSION, '2.0', '>=')) {
            $this->v2_index($hash, $data);
        } elseif (version_compare(VERSION, '1.5', '>=')) {
            $this->v1_index($hash, $data);
        }
    }

    private function v2_index($hash, $data = array()) {
        $this->template = 'module/monkey_data_2.tpl';
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('Moduly'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/monkey_data', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );


        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $data['hash'] = $hash->row['value'];
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['header'] = $this->load->controller('common/header');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view($this->template, $data));
    }
    
    private function v1_index($hash, $data = array()) {
        $this->template = 'module/monkey_data_1.tpl';
            $this->data['breadcrumbs'] = array();

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => false
            );

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('Moduly'),
                'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
            );

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('module/monkey_data', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
            );


            $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
            $this->children = array(
                'common/header',
                'common/footer',
            );
            $this->data['hash'] = $hash->row['value'];
            $this->response->setOutput($this->render());
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/monkey_data')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function install() {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        for ($i = 0; $i < 32; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $this->load->model('setting/setting');

        if (version_compare(VERSION, '2.0', '>=')) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`code`, `key`, `value`) VALUES ('monkey_data_tmp', 'monkey_data_hash', '" . md5($randomString) . "');");
            $this->model_setting_setting->editSetting('monkey_data', array('monkey_data_status' => 1));
        } elseif (version_compare(VERSION, '1.5', '>=')) {
            $this->model_setting_setting->editSetting('monkey_data', array('monkey_data_status' => 1, 'hash' => md5($randomString)));
        }
    }

    public function uninstall() {

        $this->load->model('setting/setting');

        if (version_compare(VERSION, '2.0', '>=')) {
            $this->db->query("DELETE FROM FROM `" . DB_PREFIX . "setting` WHERE `code` = 'monkey_data_tmp' && `key` = 'monkey_data_hash' LIMIT 1;");
            $this->model_setting_setting->editSetting('monkey_data', array('monkey_data_status' => 0));
        } elseif (version_compare(VERSION, '1.5', '>=')) {
            $this->model_setting_setting->editSetting('monkey_data', array('monkey_data_status' => 0, 'hash' => ''));
        }
    }

}

/*
 * Author: MonkeyData
 * E-mail: info@monkeydata.cz
 * Website: www.monkeydata.cz
 *
 */
?>