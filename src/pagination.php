<nav aria-label="Page navigation examole">
    <ul class="pagination justify-content-lg-center mt-3 pb-3">
        <li class="page-item"><a class="page-link" href="?page=1">Первая</a></li>
        <?php if($page > 0 ): ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo ($page);?>">Предыдушая</a></li>
            <?php endif; ?>
        <?php if($page < $total_rows-1 ): ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo ($page + 2);?>">Следующая</a></li>
            <?php endif; ?> 
        <li class="page-item"><a class="page-link" href="?page=<?php echo $total_rows?>">Последняя</a></li>
     
    </ul>

</nav>