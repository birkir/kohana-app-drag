<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>drag-dev :: development</title>
	<meta name="description" content="drag database application">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="/media/less/styles.less<?=Utilities::nocache();?>">
	<link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>
	<script src="/media/js/libs/modernizr-2.5.3.min.js<?=Utilities::nocache();?>"></script>
</head>
<body>
	<div class="wrap frame">
		<header>
			<div id="logo"><a href="/"><img src="/media/img/logo.png" alt="" /></a></div>
			<div id="labels">
				<ul>
					<li><a href="#" class="logout">Login</a></li>
				</ul>
			</div>
			<nav>
				<ul>
<?php foreach ($config->menu as $item): ?>
					<li<?=($toplevel == Inflector::singular($item) ? ' class="current"' : NULL);?>>
						<a href="/<?php echo $item; ?>"><?=__(ucfirst($item));?></a>
					</li>
<?php endforeach; ?>
				</ul>
				<div class="clearfix"></div>
			</nav>
		</header>
		<div id="container">
			<aside>
<?=(isset($navigation) ? $navigation : NULL);?>
			</aside>
			<div role="main" id="content">
<?php if (isset($content)): ?>
<?php if ( ! is_array($content)): ?>
				<section>
<?=$content;?>
				</section>
<?php else: ?>
<?php foreach ($content as $section): ?>
				<section>
<?=$section;?>
				</section>
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<?php if (isset($profiler)): ?>
<?php echo $profiler; ?>
<?php endif; ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/media/js/libs/jquery-1.7.1.min.js<?=Utilities::nocache();?>"><\/script>')</script>
	<script src="/media/js/plugins.js<?=Utilities::nocache();?>"></script>
	<script src="/media/js/script.js<?=Utilities::nocache();?>"></script>
</body>
</html>
