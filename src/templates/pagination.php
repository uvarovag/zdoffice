<?php

$maxPaginationItem = 9;

if ($data['pagesQuantity'] <= $maxPaginationItem) {

	$firstPage = 1;
	$lastPage = $data['pagesQuantity'];

} else {

	$firstPage = $data['currentPage'] - intval($maxPaginationItem / 2);

	if ($firstPage < 1) {
		$firstPage = 1;
	}

	$lastPage = $firstPage + $maxPaginationItem - 1;

	if ($lastPage > $data['pagesQuantity']) {
		$lastPage = $data['pagesQuantity'];
	}

	if (($lastPage - $firstPage) < $maxPaginationItem) {
		$firstPage = $lastPage - $maxPaginationItem + 1;
	}

}

?>
<div class="mb-5">
  <nav aria-label="">
    <ul class="pagination justify-content-center m-0 p-0">
			<?php if (($data['currentPage'] - 1) < 1): ?>
    <li class="page-item disabled">
    <a class="page-link" href="<?= $data['url'] . 'page=' . $data['currentPage']; ?>" aria-label="Previous">
		<?php else: ?>
      <li class="page-item">
        <a class="page-link" href="<?= $data['url'] . 'page=' . ($data['currentPage'] - 1); ?>" aria-label="Previous">
					<?php endif; ?>
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Назад</span>
        </a>
      </li>
			<?php for ($pageNumber = $firstPage; $pageNumber <= $lastPage; $pageNumber++): ?>
				<?php if ($data['currentPage'] == $pageNumber): ?>
          <li class="page-item active"><a class="page-link" href="<?= $data['url'] . 'page=' . $pageNumber; ?>"><?= $pageNumber; ?></a></li>
				<?php else: ?>
          <li class="page-item"><a class="page-link" href="<?= $data['url'] . 'page=' . $pageNumber; ?>"><?= $pageNumber; ?></a></li>
				<?php endif; ?>
			<?php endfor; ?>
			<?php if (($data['currentPage'] + 1) > $lastPage): ?>
      <li class="page-item disabled">
        <a class="page-link" href="<?= $data['url'] . 'page=' . $data['currentPage']; ?>" aria-label="Next">
					<?php else: ?>
      <li class="page-item">
        <a class="page-link" href="<?= $data['url'] . 'page=' . ($data['currentPage'] + 1); ?>" aria-label="Next">
					<?php endif; ?>
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Вперед</span>
        </a>
      </li>
    </ul>
  </nav>
</div>