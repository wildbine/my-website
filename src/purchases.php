<?php
require_once 'a_content.php';
require_once 'page.php';
require_once 'DBHelper.php';
class purchases extends a_content{
  public function __construct(){
    parent::__construct();
    $this->protected_page = true;
    $this->set_title("Мои покупки");
  }
  
  private function exe_btn(){
    $dbh = DBHelper::getInstance("root", "root");
    if(isset($_POST['exe-btn']) and $_POST['exe-btn'] == 'Baloons.exe'){
        $info = $dbh->get_path("app", 0);
        exec('start ' . $info['path'] . ' ');
      }
     if(isset($_POST['exe-btn']) and $_POST['exe-btn'] == 'ProdConsBoom.exe'){
        $info = $dbh->get_path("app", 2);
        exec('start ' . $info['path'] . ' ');
      }
     if(isset($_POST['exe-btn']) and $_POST['exe-btn'] == 'MyPaint.exe'){
        $info = $dbh->get_path("app", 1);
        exec('start ' . $info['path'] . ' ');
      }
     if(isset($_POST['exe-btn']) and $_POST['exe-btn'] == 'Rocket.exe'){
        $info = $dbh->get_path("app", 3);
        exec('start ' . $info['path'] . ' ');
      }
    }
        
        function file_download($filename){
         if (file_exists($filename)){
           if(ob_get_level())
             ob_end_clean();
             header('Content-Description: File Transfer');
             header('Content-Type: application/octet-stream');
             header('Content-Disposition: attachment; filename=' . basename($filename));
             header('Content-Transfer-Encoding: binary');
             header('Expires: 0');
             header('Cache-Control: must-revalidate');
             header('Pragma: public');
             header('Content-Length: '.filesize($filename));
             readfile($filename);
             exit;
         }
       }
        
      private function start_download(){
        $dbh = DBHelper::getInstance("root", "root");
        $filename = "";
        if (isset($_POST['download'])){
          $file = $_POST['download'];
          switch ($file) {
            case 'Скачать Baloons': $filename = $dbh->get_rar_path("app", 0)['path_rar'];
              break;
            case 'Купить ProdConsBoom': $filename = $dbh->get_rar_path("app", 2)['path_rar'];
              break;
            case 'Купить MyPaint': $filename = $dbh->get_rar_path("app", 1)['path_rar'];
              break;
            case 'Купить Rocket': $filename = $dbh->get_rar_path("app", 3)['path_rar'];
              break;
          }
          $this->file_download($filename);
        }
    }
      
        
    public function show_content(){
        $page = isset($_GET['page']) ? $_GET['page']-1: 1; //кол-во страниц или ноль
        $dbh = DBHelper::getInstance("root", "root");
       $limit = 1;
      $offset = $limit * $page;
      $total_rows = round($dbh->get_purchase_user_count($_SESSION['login']) / $limit, 0);
      //$this->file_download('rar-файлы/Baloons.rar');
      //$this->start_download();
      $this->exe_btn();
      //$i = 0;  
      ?><form action="purchases.php" method="POST"><?php
              //$res = $dbh->get_all_purchase_info($_SESSION['login']);
              for($i = $page; $i < $page + $limit; $i++){
                if ($i >= $total_rows) return;
                $title = $dbh->get_name_array_purchase($i, $_SESSION['login']);
        $img_path = $dbh->get_img_path_purchase($i, $_SESSION['login']);
        $rar = $dbh->get_path_rar_purchase($i, $_SESSION['login']);
        $exe = $dbh->get_path_purchase($i, $_SESSION['login']);
  ?>
               <div class ="card_style pb-3">
              <div class="card mx-auto mb-3" style="max-width: 600px;">
              <!-- Изображение -->
              <img class="card-img-top" src="<?php echo $img_path['img_path']?>" alt="...">
              <!-- Текстовый контент -->
              <div class="card-body">
              <h4 class="card-title">
              <?php echo $title['name']?></h4><p class="card-text"></p>
              </div>
              <!-- Текстовый контент -->
              <div class="card-body text-center">
              <a href="<?php echo $rar['path_rar'] ?>" download="" class="btn btn-primary me-2">Скачать <?php echo mb_substr($rar['path_rar'], 10) ?></a>
              <input type="submit" name="exe-btn" value="<?php echo mb_substr($exe['path'],14) ?>" class="btn btn-primary me-2">
              <!-- <a href="<?php echo ($exe['path']) ?>" download="" class="btn btn-primary me-2">Скачать <?php echo mb_substr($exe['path'], 14) ?></a> -->
              </div>
              </div><!-- Конец карточки -->
              </div>
              </form>
                       <div class="pagination mt-2 pt-3 justify-content-lg-center"> <?php
              include("pagination.php"); //пагинация
              ?> </div> 
              <?php 
              } ?>

</head><?php
  }
}

new page(new purchases());