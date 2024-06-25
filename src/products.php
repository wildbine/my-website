<?php
require_once 'a_content.php';
require_once 'page.php';
require_once 'DBHelper.php';

class products extends a_content{  
  public function __construct(){
    parent::__construct();
    $this->protected_page = false;
    $this->set_title("Проекты C#");
  }
  
  private function exe_btn(){
    $dbh = DBHelper::getInstance("root", "root");
    if(isset($_POST['exe-btn']) and $_POST['exe-btn'] == 'Baloons.exe'){
        $exe = $dbh->get_path("app", 0);
        exec('start ' . $exe['path'] . ' ');
      }
      else if(isset($_POST['exe-btn']) and $_POST['exe-btn'] == 'ProdConsBoom.exe'){
        $exe = $dbh->get_path("app", 2);
        exec('start ' . $exe['path'] . ' ');
      }
      else if(isset($_POST['exe-btn']) and $_POST['exe-btn'] == 'MyPaint.exe'){
        $exe = $dbh->get_path("app", 1);
        exec('start ' . $exe['path'] . ' ');
      }
      else if(isset($_POST['exe-btn']) and $_POST['exe-btn'] == 'Rocket.exe'){
        $exe = $dbh->get_path("app", 3);
        exec('start ' . $exe['path'] . ' ');
      }
    }

    private function purchase_btn(){
      //get_currentuserinfo();
      $id = 1;
      if (isset($_SESSION['login'])){
        $dbh = DBHelper::getInstance("root", "root");
        if (isset($_POST['purchase'])){
          $pur_item = $_POST['purchase'];
          switch ($pur_item) {
            case 'Купить Baloons': if(!$dbh->is_purchase_exists(1, $_SESSION['login'])) {$dbh->add_purchase(1, $_SESSION['login']); $id=1;}
              break;
            case 'Купить ProdConsBoom': if(!$dbh->is_purchase_exists(3, $_SESSION['login'])) {$dbh->add_purchase(3, $_SESSION['login']); $id=3;}
              break;
            case 'Купить MyPaint': if(!$dbh->is_purchase_exists(2, $_SESSION['login'])) {$dbh->add_purchase(2, $_SESSION['login']); $id=2;} 
              break;
            case 'Купить Rocket': if(!$dbh->is_purchase_exists(4, $_SESSION['login'])) {$dbh->add_purchase(4, $_SESSION['login']); $id=4;} 
              break;
          }
        }
      }
      else if (isset($_POST['purchase'])){
        ?><script type="text/javascript">
        if(document.location.href.indexOf('index.html') === -1){
        location="login.php";
        }
        </script> 
        <?php 
        login::get_auth_purchase($id);
        }
    }
  
  
  public function show_content(){
    $dbh = DBHelper::getInstance("root", "root");
    $limit = 1;
    $total_rows = round($dbh->get_row_count("app") / $limit, 0);
    $pagech = isset($_GET['page']) ? $_GET['page'] : 1;
    if(isset($pagech) and ($pagech > $total_rows || $pagech < 1 || !is_numeric($pagech))) {?>
      <script type="text/javascript">
        if(document.location.href.indexOf('index.html') === -1){
        location="http://my-website/products.php?page=1";
        }
        </script>
        <?php
    }
    $page = isset($_GET['page']) //and (gettype($_GET['page']) === gettype("1")) 
    ? $_GET['page']-1 : 1; //кол-во страниц или ноль
    $offset = $limit * $page;
    $this->purchase_btn();
    $this->exe_btn();
    ?>
    <form action="products.php" method="POST"> <?php
    for ($i = $page; $i < $page + $limit; $i++)
    {
      if ($i >= $total_rows) return;
      $title = $dbh->get_name_array("app", $i);
      $img_path = $dbh->get_img_path("app", $i);
      $description = $dbh->get_description("app", $i);
      $exe = $dbh->get_path("app", $i);
      ?>
      <div class ="card_style">
        <div class="card mx-auto mb-3" style="max-width: 600px;">
        <!-- Изображение -->
        <img class="card-img-top" src="<?php echo $img_path['img_path']?>" alt="...">
        <!-- Текстовый контент -->
        <div class="card-body">
            <h4 class="card-title">
              <?php echo $title['name'] ?></h4>
            <p class="card-text"><?php echo $description['description'] ?></p>
        </div>
        <!-- Текстовый контент -->
        <div class="card-body text-center">
          <!-- <input type="button" value="runMSPaint" onclick="runPaint()" /> -->
          <input type="submit" name="purchase" value="Купить <?php echo mb_substr($exe['path'], 14, strrpos(mb_substr($exe['path'], 14), '.'))  ?>" class="btn btn-primary me-2">
          <!-- <input type="submit" name="exe-btn" value="<?php //echo mb_substr($exe['path'], 14) ?>" class="btn btn-primary me-2"> -->
          <a href="#" class="btn btn-primary me-2">Добавить в корзину</a>
        </div>
      </div><!-- Конец карточки -->
    </div>
  </form>
  <div class="pagination mt-2 pt-3 justify-content-lg-center"> <?php
    include("pagination.php"); //пагинация
    ?> </div> 
    <?php
}
?>
</head><?php
  }
}

new page(new products());
