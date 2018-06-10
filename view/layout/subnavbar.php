<?php
    $url = $this->di->get("url");
?>
<div class="nav-scroller bg-white box-shadow">
    <nav class="nav nav-underline">
        <a class="nav-link" style="color: #000">Trending</a>
        <?php foreach($coins as $coin): ?>
            <a class="nav-link" href="<?= $url->create("coin/$coin->slug")?>"><?php echo ucfirst($coin->name); ?> (<?php echo ucfirst($coin->total_posts); ?>)</a>
        <?php endforeach; ?>
    </nav>
</div>
