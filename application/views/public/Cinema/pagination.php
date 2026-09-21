<?php if (isset($total_pages) && $total_pages > 1) { ?>
    <nav aria-label="Listing pages">
        <ul class="pagination justify-content-center">
            <li class="page-item<?php echo $current_page <= 1 ? ' disabled' : ''; ?>">
                <a class="page-link" href="<?php echo $pagination_url . '?page=' . max(1, $current_page - 1); ?>" aria-label="Previous">&laquo;</a>
            </li>
            <?php
            $first_page = max(1, $current_page - 2);
            $last_page = min($total_pages, $current_page + 2);
            for ($page_number = $first_page; $page_number <= $last_page; $page_number++) { ?>
                <li class="page-item<?php echo $page_number === $current_page ? ' active' : ''; ?>">
                    <a class="page-link" href="<?php echo $pagination_url . '?page=' . $page_number; ?>"><?php echo $page_number; ?></a>
                </li>
            <?php } ?>
            <li class="page-item<?php echo $current_page >= $total_pages ? ' disabled' : ''; ?>">
                <a class="page-link" href="<?php echo $pagination_url . '?page=' . min($total_pages, $current_page + 1); ?>" aria-label="Next">&raquo;</a>
            </li>
        </ul>
    </nav>
<?php } ?>