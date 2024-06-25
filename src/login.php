<?php
require_once 'a_content.php';
require_once 'page.php';
require_once 'DBHelper.php';

class login extends a_content
{
    private $log_ok = true;
    private string $users_filename = "users.dat";

    public function __construct(){
        parent::__construct();
        $this->protected_page = false;
        $this->set_title("Авторизация");
        if ($this->exiting()){
            unset($_SESSION['auth']);
            session_destroy();
        } else {
            $this->login();
        }
    }

    private function exiting() : bool{
        return (isset($_GET['exit']) && $_GET['exit']==1);
    }

    private function login(){
        if (!isset($_POST['login']) &&
            !isset($_POST['psw'])) return;
        if (!isset($_POST['login']) ||
            !isset($_POST['psw']) ||
            mb_strlen($_POST['login']) < 1 ||
            mb_strlen($_POST['psw']) < 6 ||
            !$this->is_authorized($_POST['login'], md5($_POST['psw']."3grevtg45efr"))
        ) {
            $this->log_ok = false;
        }
        else{
            $_SESSION['auth'] = 1;
            $_SESSION['login'] = $_POST['login'];
        }
    }

    public static function get_auth_purchase($id){
        if (!isset($_POST['login']) &&
            !isset($_POST['psw'])) return;
        if (!isset($_POST['login']) ||
            !isset($_POST['psw']) ||
            mb_strlen($_POST['login']) < 1 ||
            mb_strlen($_POST['psw']) < 6 
        ) {
            return;
        }
        else{
            $_SESSION['auth'] = 1;
            $_SESSION['login'] = $_POST['login'];
        }
        if (isset($_SESSION['auth']))
        {
            $dbh = DBHelper::getInstance("root", "root");
            $dbh->add_purchase($id, $_SESSION['login']);
        }
    }

    private function is_authorized($login, $psw) : bool{
        return DBHelper::getInstance("root", "root")->is_authorized($login, $psw);
        /*$us = file_get_contents($this->users_filename);
        if ($us !== false){
            $usrs = mb_split("\r\n", $us);
            foreach ($usrs as $user){
                $us_info = mb_split('\|', $user);
                if (strcmp($us_info[0], $login) === 0){
                    $res = password_verify($psw, $us_info[1]);
                    if ($res) $_SESSION['email'] = $us_info[2];
                    return $res;
                }
            }
        }
        return false;*/
    }

    public function show_content()
    {
        if (!$this->log_ok){
            print '<h5 class="display-10 justify-content-lg-around text-danger text-center">Неверно введен пароль, в случае зарегестрированного пользователя.</h5>';
            unset($_SESSION['auth']);
            session_destroy();
        }
        else if(isset($_SESSION['login'])) {print '<h5 class="display-10 justify-content-lg-around text-success text-center">Авторизация прошла успешно!</h5>';}

        ?>
           <form action="login.php" method="post">
               <div class="form-login">
               <div class="mb-1 row">
                   <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">Логин</label>
                   <div class="col-sm-4 col-form-label">
                       <input type="text" name = "login" class="form-control" placeholder="wildbine">
                       </div>
               </div>
               <div class="mb-1 row">
                   <label for="inputPassword" class="col-sm-4 col-form-label">Пароль</label>
                   <div class="col-sm-4 col-form-label">
                       <input type="password" name="psw" class="form-control" id="inputPassword">
                    </div>
                </div>
                <div class="btn-login">
                    <button class="btn btn-primary" input type="submit" value ="Войти">Войти</button>
                </div>
               </div>
               <!--
                <table style="margin: auto;">
                    <tr>
                        <td>Ваш логин:</td><td><input type="text" name="login" maxlength="30"></td>
                    </tr>
                    <tr>
                        <td>Ваш пароль:</td><td><input type="password" name="psw" maxlength="30"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><input type="submit" value="Войти" style="margin: auto;">
                    </td>
                </tr>
            </table>
                -->
        </form>
        <div class="forest-log">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,224L62.6,96L125.2,64L187.8,256L250.4,96L313,224L375.7,224L438.3,64L500.9,256L563.5,32L626.1,288L688.7,96L751.3,224L813.9,256L876.5,160L939.1,224L1001.7,160L1064.3,96L1127,224L1189.6,256L1252.2,128L1314.8,320L1377.4,32L1440,64L1440,320L1377.4,320L1314.8,320L1252.2,320L1189.6,320L1127,320L1064.3,320L1001.7,320L939.1,320L876.5,320L813.9,320L751.3,320L688.7,320L626.1,320L563.5,320L500.9,320L438.3,320L375.7,320L313,320L250.4,320L187.8,320L125.2,320L62.6,320L0,320Z"></path></svg>
        </div>
        <?php
    }
}

new page(new login());
