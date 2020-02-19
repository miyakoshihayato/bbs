<?php
    namespace bbs;

    use bbs\Config\Config;
    

    class Routing
    {
        public function Execute()
        {
            $loginout = new Loginout();
            $input = new Input();
            $display = new Display();
            $delete = new Delete();
            $config = new Config();
            if (array_key_exists('action', $_GET)) {
                if ($_GET['action'] == '') {
                    echo " 'action' の指定がありません。";
                    exit();
                }
            }
        
            if (!(array_key_exists('action', $_GET))) {
                echo " 'action' がありません。";
                exit();
            }
            $loginout->login_check();
            if (array_key_exists('action', $_GET)) {
                if ($_GET['action'] == 'input') {
                    $input->input_page();
                }
                if ($_GET['action'] == 'save') {
                    $input->save_page();
                }
                if ($_GET['action'] == 'list') {
                    $display->list_page();
                }
                if ($_GET['action'] == 'contents') {
                    $display->contents_page();
                }
                if ($_GET['action'] == 'delete') {
                    $delete->delete_page();
                }
                if ($_GET['action'] == 'login_page') {
                    $loginout->login_page();
                }
                if ($_GET['action'] == 'login') {
                    $loginout->login();
                }
                if ($_GET['action'] == 'logout') {
                    $loginout->logout_page();
                }
            } else {
                echo "この配列には 'action' という要素が存在しません。";
            }
        }
    }



