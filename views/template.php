<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>drag.forritun.org</title>
<?php foreach ($styles as $style => $type): ?>
		<link rel="stylesheet" href="/media/<?php echo $style; ?>" type="<?php echo $type; ?>" />
<?php endforeach; ?>
<?php foreach ($scripts as $script): ?>
		<script type="text/javascript" src="/media/<?php echo $script; ?>"></script>
<?php endforeach; ?>
	</head>
	<body>
		<div class="wrap">
			<div id="header">
				<h1><?php echo isset($title) ? $title.' | ' : NULL; ?>drag.forritun.org</h1>
				<div id="menu">
					<ul>
						<li><a href="/home"><?php echo __('Home'); ?></a></li>
<?php if (Auth::instance()->logged_in('login')): ?>
						<li><a href="/user/profile"><?php echo __('Profile'); ?></a></li>
						<li><a href="/user/logout"><?php echo __('Logout'); ?></a></li>
<?php else: ?>
						<li><a href="/user/register"><?php echo __('Register'); ?></a></li>
						<li><a href="/user/login"><?php echo __('Login'); ?></a></li>
<?php endif; ?>
					</ul>
				</div>
			</div>
			<div id="body">
<?php echo isset($view) ? $view : NULL; ?>
			</div>
			<div id="footer">
				
			</div>
		</div>
	</body>
</html>