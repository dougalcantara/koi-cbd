<nav class="breadcrumbs">
  <ul class="breadcrumbs-links">
    <?php foreach($links as $i => $link): ?>
      <li>
        <?php if($i !== count($links) - 1): ?>
          <a href="<?php echo $link['url']; ?>">
            <?php echo $link['name']; ?>
          </a>
        <?php else: ?>
          <?php echo $link['name']; ?>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>