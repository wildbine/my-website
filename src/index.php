<?php
require_once 'a_content.php';
require_once 'page.php';

class index extends a_content {
	public function __construct(){
		parent::__construct();
		$this->protected_page = false;
		$hello = isset($_SESSION['login']) ? ', ' . $_SESSION['login'] : ""; 
		$this->set_title("Добро пожаловать на сервер Shizofrenija$hello!");
	}

	public function show_content(){
	/*	function _exec($cmd) {
			$WshShell = new COM("WScript.Shell");
			$oExec = $WshShell->Run($cmd, 0, false);
			echo $cmd;
			return $oExec == 0 ? true : false;
		 }
		 _exec("Мои_экзешники/Baloons.exe"); */
		?>
		<header class = "page-header gradient">
			<div class="container pt-3">
				<div class="row align-items-center justify-content-center">
				<div class="col-md-6">С ДРУГОЙ СТОРОНЫ ПОСТОЯННОЕ ИНФОРМАЦИОННО-ПРОПАГАНДИСТСКОЕ ОБЕСПЕЧЕНИЕ НАШЕЙ ДЕЯТЕЛЬНОСТИ ОБЕСПЕЧИВАЕТ ШИРОКОМУ КРУГУ (СПЕЦИАЛИСТОВ) УЧАСТИЕ В ФОРМИРОВАНИИ ПОЗИЦИЙ, ЗАНИМАЕМЫХ УЧАСТНИКАМИ В ОТНОШЕНИИ ПОСТАВЛЕННЫХ ЗАДАЧ.
НЕ СЛЕДУЕТ, ОДНАКО ЗАБЫВАТЬ, ЧТО ДАЛЬНЕЙШЕЕ РАЗВИТИЕ РАЗЛИЧНЫХ ФОРМ ДЕЯТЕЛЬНОСТИ СПОСОБСТВУЕТ ПОДГОТОВКИ И РЕАЛИЗАЦИИ ФОРМ РАЗВИТИЯ. ТОВАРИЩИ! СЛОЖИВШАЯСЯ СТРУКТУРА ОРГАНИЗАЦИИ ПРЕДСТАВЛЯЕТ СОБОЙ ИНТЕРЕСНЫЙ ЭКСПЕРИМЕНТ ПРОВЕРКИ НАПРАВЛЕНИЙ ПРОГРЕССИВНОГО РАЗВИТИЯ.
С ДРУГОЙ СТОРОНЫ УКРЕПЛЕНИЕ И РАЗВИТИЕ СТРУКТУРЫ ОБЕСПЕЧИВАЕТ УЧАСТИЕ В ФОРМИРОВАНИИ СИСТЕМ МАССОВОГО УЧАСТИЯ. ИДЕЙНЫЕ СООБРАЖЕНИЯ ВЫСШЕГО ПОРЯДКА, А ТАКЖЕ УКРЕПЛЕНИЕ И РАЗВИТИЕ СТРУКТУРЫ ИГРАЕТ ВАЖНУЮ РОЛЬ В ФОРМИРОВАНИИ СУЩЕСТВЕННЫХ ФИНАНСОВЫХ И АДМИНИСТРАТИВНЫХ УСЛОВИЙ.
</div>
				<div class="col-md-6"><img src="img/email_campaign_monochromatic.svg"
				alt="Header image" />
			</div>
			</div>
		</header>
		<div class ="waves">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1.2" d="M0,160L48,170.7C96,181,192,203,288,192C384,181,480,139,576,117.3C672,96,768,96,864,128C960,160,1056,224,1152,245.3C1248,267,1344,245,1392,234.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
		</div>
		<?php
	}
}

new page(new index());
