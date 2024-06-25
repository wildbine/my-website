<?php

class DBHelper{

    private $mi;

    private function __construct(string $user, string $psw){
        $this->mi = new mysqli("localhost", $user, $psw);
        $this->create();
    }

    private static ?DBHelper $instance = null;
    public static function getInstance(string $user, string $psw): DBHelper{
        if (self::$instance === null){
            self::$instance = new DBHelper($user, $psw);
        }
        return self::$instance;
    }

    private function create(){
        try {
            $this->mi->begin_transaction();
            $this->mi->query("CREATE DATABASE IF NOT EXISTS `online_store`");
            $q = <<<SOMETHING
CREATE TABLE IF NOT EXISTS `online_store`.`user_data`(
    login varchar(30) not null primary key,
    psw varchar(256) not null,
    email varchar(256)
);

/*CREATE TABLE IF NOT EXISTS `online_store`.`applications`(
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    path VARCHAR(200) NOT NULL,
    name VARCHAR(50) NOT NULL
);*/

SOMETHING;
            $this->mi->query($q);
            $this->mi->commit();
        } catch (Exception $ex){
            $this->mi->rollback();
            print($ex);
        }
    }

    public function add_user($login, $psw, $email){
        $q = <<<STH
        INSERT INTO `online_store`.`user_data` 
        VALUES ('$login', '$psw', '$email');
        STH;
        $this->mi->query($q);
    }

    public function add_purchase($id, $login){
        $q = <<<STH
        INSERT INTO `online_store`.`purchase` 
        VALUES ('$id', '$login');
        STH;
        $this->mi->query($q);
    }

    public function add_app($id, $app){
        $q = <<<STH
        INSERT INTO `online_store`.`applications` 
        VALUES ('$id', '$app');
        STH;
        $this->mi->query($q);
    }

    public function is_purchase_exists($id, $login){
        try{
            $q = "SELECT `id`, `login` FROM `online_store`.`purchase` WHERE `login`='$login' AND `id` = '$id'";
            $res = $this->mi->query($q);
            $a_res = $res->fetch_array();
            if(!empty($a_res)) return true;
        } catch (Exception $ex){
            print ($ex);
        }
        return false;
    }

    public function get_all_purchase_info($login){
        try{
            $q = <<<STH
        SELECT `name`, `img_path`, `path_rar`, `path` FROM `online_store`.`purchase` 
        INNER JOIN `online_store`.`app` ON `purchase`.`id` = `app`.`id` AND `purchase`.`login` = '$login';
        STH;
        $res = $this->mi->query($q);
        return $res;
        }
            catch(Exception $ex) {print($ex);} 
    }

    public function get_purchase_user_count($login){
        try{
            $q = "SELECT COUNT(1) FROM `online_store`.`purchase` WHERE `login` = '$login'";
            $res = $this->mi->query($q);
            $a_res = $res->fetch_array();
            return $a_res[0];
        } catch (Exception $ex){
            print ($ex);
        }
    }
    
    public function get_name_array_purchase($i, $login){
        try{
            $q = <<<STH
        SELECT `name` FROM `online_store`.`purchase` 
        INNER JOIN `online_store`.`app` ON `purchase`.`id` = `app`.`id` AND `purchase`.`login` = '$login';
        STH;
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc();
        return $a_res;
        }
            catch(Exception $ex) {print($ex);} 
    }

    public function get_img_path_purchase($i, $login){
        try{
            $q = <<<STH
        SELECT `img_path` FROM `online_store`.`purchase` 
        INNER JOIN `online_store`.`app` ON `purchase`.`id` = `app`.`id` AND `purchase`.`login` = '$login';
        STH;
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc();
        return $a_res;
        }
            catch(Exception $ex) {print($ex);} 
    }

    public function get_path_rar_purchase($i, $login){
        try{
            $q = <<<STH
        SELECT `path_rar` FROM `online_store`.`purchase` 
        INNER JOIN `online_store`.`app` ON `purchase`.`id` = `app`.`id` AND `purchase`.`login` = '$login';
        STH;
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc();
        return $a_res;
        }
            catch(Exception $ex) {print($ex);} 
    }

    public function get_path_purchase($i, $login){
        try{
            $q = <<<STH
        SELECT `path` FROM `online_store`.`purchase` 
        INNER JOIN `online_store`.`app` ON `purchase`.`id` = `app`.`id` AND `purchase`.`login` = '$login';
        STH;
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc();
        return $a_res;
        }
            catch(Exception $ex) {print($ex);} 
    }

    public function is_user_exists($login): bool
    {
        try{
            $q = "SELECT * FROM `online_store`.`user_data` WHERE `login`='$login'";
            $res = $this->mi->query($q);
            $a_res = $res->fetch_assoc();
            if($a_res) return true;
        } catch (Exception $ex){
            print ($ex);
        }
        return false;
    }

    public function get_page_no_purchase($login, $i){
        try{
            if($this->get_row_count("purchase") > 0){
            $q = <<<STH
        SELECT `page_no` FROM `online_store`.`purchase` WHERE `login` = '$login';
        STH;
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc();
        return $a_res['page_no'];
        }
    }
            catch(Exception $ex) {print($ex);}
    }

    

    public function get_row_count(string $table_name) : int
    {
        try{
            $q = "SELECT COUNT(1) FROM `online_store`.`$table_name`";
            $res = $this->mi->query($q);
            $a_res = $res->fetch_array();
            return $a_res[0];
        } catch (Exception $ex){
            print ($ex);
        }
    }

    public function get_name_array(string $table_name, $i){
        $q = "SELECT `name` FROM `online_store`.`$table_name`";
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc(); 
        return $a_res;
    }

    public function get_img_path(string $table_name, $i){
        $q = "SELECT `img_path` FROM `online_store`.`$table_name`";
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc(); 
        return $a_res;
    }

    public function get_description(string $table_name, $i){
        $q = "SELECT `description` FROM `online_store`.`$table_name`";
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc(); 
        return $a_res;
    }

    public function get_rar_path(string $table_name, $i){
        $q = "SELECT `path_rar` FROM `online_store`.`$table_name`";
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc(); 
        return $a_res;
    }

    public function get_path(string $table_name, $i){
        $q = "SELECT `path` FROM `online_store`.`$table_name`";
        $res = $this->mi->query($q);
        $a_res = $res->fetch_assoc();
        for ($j = 0; $j < $i; ++$j)
            $a_res = $res->fetch_assoc(); 
        return $a_res;
    }

    public function is_authorized(string $login, string $psw) : bool{
        try{
            if(!$this->is_user_exists($login)) return false;
            $q = "SELECT `login`, `psw` FROM `online_store`.`user_data` WHERE `login`='$login' AND `psw`='$psw'";
            $res = $this->mi->query($q);
            $user = $res->fetch_assoc();
            if (!empty($user))
                return true;
            /*$stmt = $this->mi->prepare($q);
            $stmt->bind_param("s", $login);
            $stmt->execute();
            $stmt->bind_result($rl, $rp);
            $stmt->fetch();
            //print("Тестовый результат: ".$rl." ".$rp);
            return password_verify($psw, $rp);
            */
        }
         catch (Exception $ex){
            return false;
         }
         return false;
    }


    public function test(){
        $q = "SELECT login FROM `users`.`user_data`";
        $stmt = $this->mi->prepare($q);
        $stmt->execute();
        $stmt->bind_result($login);
        while ($stmt->fetch()) {
            print("Login: {$login}<br>");
        }

    }
}