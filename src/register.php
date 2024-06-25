<?php
require_once 'a_content.php';
require_once 'page.php';
require_once 'DBHelper.php';

class register extends a_content
{
    private $reg_ok = true;
    private $diff_pass = false;
    private $already_exists = false;
    private string $users_filename = "users.dat";

    public function __construct(){
        parent::__construct();
        $this->protected_page = false;
        $this->set_title("Регистрация нового пользователя");
        $this->register();
    }

    private function register(){
        // 1. Проверить логин не пуст и не занят
        // 2. Проверить что пароль по длине >= 6 символам
        // 3. Проверить что пароли совпадают
        // 4. Сохранить пользователя
        if (!isset($_POST['reg'])) return;
        if (
            !isset($_POST['login']) ||
            !isset($_POST['psw']) ||
            !isset($_POST['psw2']) ||
            !isset($_POST['email'])
        ) {
            $this->reg_ok = false;
            return;
        }
        $login = trim($_POST['login']);
        $psw = trim($_POST['psw']);
        $psw2 = trim($_POST['psw2']);
        $email = trim($_POST['email']);
        if (
            mb_strlen($login) == 0 ||
            mb_strlen($psw) < 6
            ) {
                $this->reg_ok = false;
                return;
            }
        else if (strcmp($psw, $psw2) !== 0) {$this->diff_pass = true; return;}
        else if ($this->is_login_exists($login)) {$this->already_exists = true; return;}

        /*$f = fopen($this->users_filename, "a");
        $hpsw = password_hash($psw, PASSWORD_DEFAULT);
        fwrite($f, "$login|$hpsw|$email\r\n");
        fclose($f);*/
        $dbh = DBHelper::getInstance("root","root");
        $psw = md5($psw."3grevtg45efr");
        $dbh->add_user($login, $psw, $email);
    }

    private function is_login_exists($login) : bool{
        $dbh = DBHelper::getInstance("root", "root");
        return $dbh->is_user_exists($login);
       /* $us = file_get_contents($this->users_filename);
            $this->is_login_exists($login) ||
            mb_strlen($psw) < 6 ||
            strcmp($psw, $psw2) !== 0
        ) {
            $this->reg_ok = false;
            return;
        }

        $f = fopen($this->users_filename, "a");
        $hpsw = password_hash($psw, PASSWORD_DEFAULT);
        fwrite($f, "$login|$hpsw|$email\r\n");
        fclose($f);

        $dbh = DBhelper::getInstance("root", "");
    }

    private function is_login_exists($login) : bool{
        $us = file_get_contents($this->users_filename);
        if ($us !== false){
            $usrs = mb_split("\r\n", $us);
            foreach ($usrs as $user){
                $us_info = mb_split('\|', $user, 2);
                if (strcmp($us_info[0], $login) === 0){
                    return true;
                }
            }
        }*/
        
    }

    public function show_content()
    {
        $dbh = DBHelper::getInstance("root", "root");
        if ($this->diff_pass)
            print '<h5 class="display-10 justify-content-lg-around text-danger text-center">Пароли не совпадают.</h5>';
        else if (!$this->reg_ok)
            print '<h5 class="display-10 justify-content-lg-around text-danger text-center">Длина пароля или логина слишком мала.</h5>';
        else if ($this->already_exists)
            print '<h5 class="display-10 justify-content-lg-around text-danger text-center">Такой пользователь уже существует</h5>';
        else if ($this->diff_pass === false and $this->reg_ok ===true and $this->already_exists === false) {print '<h5 class="display-10 justify-content-lg-around text-success text-center">Регистрация прошла успешно!</h5>';
        $this->diff_pass = $this->reg_ok = $this->already_exists = false;}
        ?>
        <form action="register.php" method="post">
            <input type="hidden" name="reg" value="1">
            <div class="form-login">
               <div class="mb-1 row">
                   <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">Логин</label>
                   <div class="col-sm-4 col-form-label">
                       <input type="text" name = "login" maxlength="30" class="form-control" placeholder="wildbine">
                       </div>
               </div>
               <div class="mb-1 row">
                   <label for="inputPassword" class="col-sm-4 col-form-label">Пароль</label>
                   <div class="col-sm-4 col-form-label">
                       <input type="password" name="psw"  maxlength="30" class="form-control" id="inputPassword">
                    </div>
                </div>
                <div class="mb-1 row">
                   <label for="inputPassword" class="col-sm-4 col-form-label">Повторите пароль</label>
                   <div class="col-sm-4 col-form-label">
                       <input type="password" name="psw2" maxlength="30" class="form-control" id="inputPassword2">
                    </div>
                </div>
                <div class="mb-1 row">
                   <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">e-mail</label>
                   <div class="col-sm-4 col-form-label">
                       <input type="email" name = "email" maxlength="100" class="form-control" placeholder="employee@gmail.com">
                       </div>
               </div>
                <div class="btn-login">
                    <button class="btn btn-primary" input type="submit" value ="Войти">Зарегестрироваться</button>
                </div>
               </div>
            <!--
        if (!$this->reg_ok)
            print 'Все плохо!';
        ?>
        <form action="register.php" method="post">
            <input type="hidden" name="reg" value="1">

            <table style="margin: auto;">
                <tr>
                    <td>Ваш логин:</td><td><input type="text" name="login" maxlength="30"></td>
                </tr>
                <tr>
                    <td>Ваш пароль:</td><td><input type="password" name="psw" maxlength="30"></td>
                </tr>
                <tr>
                    <td>Повтор пароля:</td><td><input type="password" name="psw2" maxlength="30"></td>
                </tr>
                <tr>
                    <td>Ваша э-почта:</td><td><input type="email" name="email" maxlength="100"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><input type="submit" value="Зарегистрироваться" style="margin: auto;"></td>
                </tr>
            </table>
    -->
        </form>
        <div class="cubes-reg">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,160L0,320L36.9,320L36.9,128L73.8,128L73.8,288L110.8,288L110.8,256L147.7,256L147.7,256L184.6,256L184.6,192L221.5,192L221.5,128L258.5,128L258.5,96L295.4,96L295.4,288L332.3,288L332.3,160L369.2,160L369.2,0L406.2,0L406.2,64L443.1,64L443.1,128L480,128L480,160L516.9,160L516.9,96L553.8,96L553.8,128L590.8,128L590.8,32L627.7,32L627.7,256L664.6,256L664.6,288L701.5,288L701.5,256L738.5,256L738.5,256L775.4,256L775.4,256L812.3,256L812.3,192L849.2,192L849.2,320L886.2,320L886.2,64L923.1,64L923.1,64L960,64L960,224L996.9,224L996.9,64L1033.8,64L1033.8,288L1070.8,288L1070.8,64L1107.7,64L1107.7,0L1144.6,0L1144.6,96L1181.5,96L1181.5,96L1218.5,96L1218.5,288L1255.4,288L1255.4,288L1292.3,288L1292.3,256L1329.2,256L1329.2,64L1366.2,64L1366.2,128L1403.1,128L1403.1,224L1440,224L1440,320L1403.1,320L1403.1,320L1366.2,320L1366.2,320L1329.2,320L1329.2,320L1292.3,320L1292.3,320L1255.4,320L1255.4,320L1218.5,320L1218.5,320L1181.5,320L1181.5,320L1144.6,320L1144.6,320L1107.7,320L1107.7,320L1070.8,320L1070.8,320L1033.8,320L1033.8,320L996.9,320L996.9,320L960,320L960,320L923.1,320L923.1,320L886.2,320L886.2,320L849.2,320L849.2,320L812.3,320L812.3,320L775.4,320L775.4,320L738.5,320L738.5,320L701.5,320L701.5,320L664.6,320L664.6,320L627.7,320L627.7,320L590.8,320L590.8,320L553.8,320L553.8,320L516.9,320L516.9,320L480,320L480,320L443.1,320L443.1,320L406.2,320L406.2,320L369.2,320L369.2,320L332.3,320L332.3,320L295.4,320L295.4,320L258.5,320L258.5,320L221.5,320L221.5,320L184.6,320L184.6,320L147.7,320L147.7,320L110.8,320L110.8,320L73.8,320L73.8,320L36.9,320L36.9,320L0,320L0,320Z"></path></svg>
        </div>
        </form>
        <?php
    }
}

new page(new register());
