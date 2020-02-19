<?php
namespace bbs;

use bbs\Config\Config;

class Loginout
{
    public function login_page()
    {
        echo '<html>
                    <head>
                      <meta charset="utf-8">
                      <title>掲示板ログイン</title>
                    </head>
    
                    <body>
                        <div>
                          <h2>掲示板ログイン画面</h>
                        </div>
    
                        <div class="form-group">
                          <form action="index.php?action=login" method="post">
    
                          <div class="form-group">
                            <label>ID名</label>
                            <input type="text" name="id">
                          </div>
    
                          <div class="form-group">
                            <label>パスワード</label>
                            <input type="password" name="pass">
                          </div>
    
                          <input type="submit" value="ログイン"></input>
                          </form>
                        </div>
                    </body>
                  </html>';
    }

    public function login()
    {
      $config = new Config();
        if (array_key_exists('id', $_POST) && array_key_exists('pass', $_POST)) {
            if ($_POST['id'] == '' || $_POST['pass'] == '') {
            
                echo '<p>IDかパスワードに記載がありません。</p>';
                echo '<a href = "' . $config->get_url('login_page') . '">ログイン画面へ戻る<a/>';
                exit();
            }
                if ($_POST['id'] == 'user' && $_POST['pass'] == 'password1!') {
                    file_put_contents($config->get_file_directory_login() . "{$_POST['id']}" . ".txt", $_SERVER['REMOTE_ADDR']);
                    echo '<p>ログイン完了</p>';
                    echo '<a href = "' . $config->get_url('input') . '">投稿内容入力はこちら<a/>';
                } else {
                    echo '<p>IDかパスワードが間違っています。</p>';
                    echo '<a href = "' . $config->get_url('login_page') . '">ログイン画面へ戻る<a/>';
                }
        }
    }

    public function logout_page()
    {
      $config = new Config();
    echo '<html>
        <body>';
        unlink($config->get_file_directory_login() . 'user.txt');
    echo '<p>ログアウトしました。</P>
          <a href = "' . $config->get_url('login_page') . '">ログイン画面はこちら<a/>';
    echo '</body>
        </html>';
    }

    public function login_check()
    {
      $config = new Config();
      if ($_GET['action'] != 'login_page' and $_GET['action'] != 'login' and $_GET['action'] != ''){
        if (!( file_exists($config->get_file_directory_login() . 'user.txt'))){
            echo '<p>ログインファイル名が違います。</p>';
            echo '<a href = "' . $config->get_url('login_page') . '">ログイン画面へ戻る<a/>';
            exit();
        }if (!( file_get_contents($config->get_file_directory_login() . 'user.txt') == $_SERVER['REMOTE_ADDR'])){
            echo '<p>IPアドレスが違います。</p>';
            echo '<a href = "' . $config->get_url('login_page') . '">ログイン画面へ戻る<a/>';
            exit();
        }
    }
    }
}