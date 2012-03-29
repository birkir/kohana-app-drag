<h5 class="nav"><?=(isset($title) ? $title : null);?></h5>
<nav>
<?php if ( ! function_exists('menu')): ?>
<?php function menu($items) { ?>
<ul>
<?php foreach ($items as $item): ?>
	<li<?=((isset($item['current']) AND $item['current'] == TRUE) ? ' class="current"' : NULL);?>>
		<a href="<?=$item['url'];?>"><?=__($item['title']);?></a>
		<?php if (isset($item['childs']) AND count($item['childs']) > 0): ?>
		<?php menu($item['childs']); ?>
		<?php endif; ?>
	</li>
<?php endforeach; ?>
</ul>
<?php } ?>
<?php endif; ?>
<? menu($items); ?>
</nav>
