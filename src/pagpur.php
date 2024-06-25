<?php 
require_once 'DBHelper.php';
$dbh = DBHelper::getInstance("root", "root"); 
?>
<nav aria-label="Page navigation examole">
    <ul class="pagination justify-content-lg-center mt-3 pb-3">
        <li class="page-item"><a class="page-link" href="?page=<?php $dbh->get_page_no_purchase($_SESSION['login'], 0) ?>">Первая</a></li>
    <?php if($page > 0): ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $dbh->get_page_no_purchase($_SESSION['login'], $page-1);?>">Предыдушая</a></li>
            <?php endif; ?>
        <?php if($page < $total_rows-1 ): ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $dbh->get_page_no_purchase($_SESSION['login'], $page+1);?>">Следующая</a></li>
            <?php endif; ?>
        <li class="page-item"><a class="page-link" href="?page=<?php echo $dbh->get_page_no_purchase($_SESSION['login'], $total_rows-1)?>">Последняя</a></li>
    </ul>

</nav>