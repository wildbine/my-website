<?php
require_once 'a_content.php';
require_once 'page.php';
require_once 'DBHelper.php';

class test extends a_content{
    public function __construct(){
        parent::__construct();
        $this->protected_page = false;
        $this->set_title("Задача");
    }
    
    public function save_files(){
        $file = fopen('file.txt', 'a');
        foreach ($_REQUEST as $key => $val)
        {
            fwrite($file, $key . ' => ' . $val . "\n");
        }
        fclose($file);
      }

      public function check_data(){
        $file = fopen("file.txt", "r");
        if ($file) {
            while(!feof($file)) {
                $line = fgets($file);
                print "</br>{$line}";
        }
        fclose($file);
    }
}

    
    public function show_content()
    {
        echo var_dump($_POST);
        echo 'POST<br />';
        foreach($_POST as $key => $val) echo $key,' - ',$val,'<br />';
        print_r($_POST);
        print_r($_FILES);
        $this->save_files();
        $this->check_data();
    }
}

new page(new test());