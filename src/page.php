<?php
require_once 'menu.php';
require_once 'a_content.php';

class page
{
	private a_content $content;
	public function __construct(a_content $content)
	{
		$this->content = $content;
		if ($this->content->is_protected() && !isset($_SESSION['auth'])) {
			header("Location: login.php");}
		$this->start_page();
		print '<div class = "wrapper">';
		$this->show_menu();
		$this->show_header();
		print '<div class = "main_content">';
		$content->show_content();
		print '</div>';
		print '<div class = "footer_content">';
		$this->show_footer();
		print '</div>';
		print '</div>';
		$this->finish_page();
	}


	public function start_page(){
            print "<html>";
            print("<head>");
            ?>
            <meta charset = "UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
  			<meta http-equiv="X-UA-Compatible" content="ie=edge">
  			<link rel="stylesheet"  type = "text/css" href="css/main.css">
  			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <title>
                <?php
                print ($this->content->get_title());
                ?>
                </title>
            <link rel = "stylesheet" type = "text/css" href="css/main.css">
            	</head>
			<body>
			<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 bg-white border-bottom shadow-sm">
      		<a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        	<span class="fs-4">wildbine</span>
				</a>
      		<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        	<a class="me-4 py-2 text-dark text-decoration-none" href="#">Main</a>
        	<a class="me-4 py-2 text-dark text-decoration-none" href="#">Contacts</a>
        	<a class="me-4 py-2 text-dark text-decoration-none" href="#">Products</a>
        	<a class="me-4 py-2 text-dark text-decoration-none" href="#">About us</a>
      			</nav>
			<a class = "btn btn-outline-primary me-2" href="login.php">Login</a>
      		<a class = "btn btn-outline-primary" href="#">Sign-up</a>
    			</div>
            
		</title>
		</head>

		<body>
			<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
				<div class="container">
					<a class="navbar-brand">wildbine</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="index.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Products</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">Contacts</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item">101</a></li>
									<li><a class="dropdown-item">102</a></li>
									<li><a class="dropdown-item">112</a></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><a class="dropdown-item" href="#">+7(986)-721-73-43 Шилин Юрий</a></li>
								</ul>
							</li>
							<script src="js/bootstrap.bundle.js"></script>
							<li class="nav-item">
								<a class="btn btn-outline-primary me-2" href="login.php">Login</a>
							</li>
							<li class="nav-item">
								<a class="btn btn-outline-primary me-2" href="register.php">Sign-up</a>
							</li>
							<li class="nav-item">
								<a class="btn btn-outline-danger" href="login.php?exit=1">Exit</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<script src="js/bootstrap.min.js"></script>
		<?php
	}

	public function finish_page()
	{
		?>
		</body>
		</html>
	<?php
	}

	public function show_menu()
	{
		//$m = new menu();
		//    $m_items = $m->get_items();
		//     print '<div class = "menu">';
		//    foreach ($m_items as $item) {
		//        print "<div class ='menuitem'>
		//		</div>";
		//   }
		//   print '</div>';
	}

	public function show_header()
	{
		print '<div class = "header">';
			print $this->content->get_title();
		?>
		<div class="dropdown-pages">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
				Разделы сайта
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
				<li><a class="dropdown-item" href="products.php">Купить товары</a></li>
				<li><a class="dropdown-item" href="purchases.php">Мои товары</a></li>
				<li><a class="dropdown-item" href="#">Корзина</a></li>
				<li><a class="dropdown-item" href="test.php">Задача</a></li>
			</ul>
		</div>
		<script src="js/bootstrap.bundle.js"></script>
		</div>
	<?php
	}

	public function show_footer()
	{
		print "<div class = 'container'>";
	?>
		<link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/footers/">
		<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
		<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
			<symbol id="twitter" viewBox="0 0 16 16">
				<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
			</symbol>
			<symbol id="twitch" viewBox="0 0 20 20">
				<path d="M11.857 3.143h-1.143V6.57h1.143V3.143zm-3.143 0H7.571V6.57h1.143V3.143z" />
			</symbol>
			<symbol id="telegram" viewBox="0 0 16 16">
				<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
			</symbol>
			<symbol id="youtube" viewBox="0 0 16 16">
				<path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
			</symbol>
		</svg>

		<div class="container">
			<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
				<div class="col-md-4 d-flex align-items-center">
					<a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
						<svg class="bi" width="30" height="24">
							<use xlink:href="#bootstrap"></use>
						</svg>
					</a>
					<span class="mb-3 mb-md-0 text-muted">© 2022 Jury Shilin, All rights are not reserved.</span>
				</div>

				<ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
					<li class="ms-3"><a class="text-muted" href="https://twitter.com/wildJury" target="_blank"><svg class="bi" width="24" height="24">
								<use xlink:href="#twitter"></use>
							</svg></a></li>
					<li class="ms-3"><a class="text-muted" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"><svg class="bi" width="24" height="24">
								<use xlink:href="#youtube"></use>
							</svg></a></li>
					<li class="ms-3"><a class="text-muted" href="https://t.me/wxrldbine" target="_blank"><svg class="bi" width="24" height="24">
								<use xlink:href="#telegram"></use>
							</svg></a></li>
				</ul>
			</footer>
		</div>
<?php
	}
}
