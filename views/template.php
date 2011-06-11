<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="is">
	<head>
		<title>Drag.forritun.org</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link type="text/css" media="screen" rel="stylesheet" href="/media/css/style.screen.css" />
		<link type="text/css" media="screen" rel="stylesheet" href="/media/css/jquery-ui-1.8.7.css" />
		<script type="text/javascript" src="/media/js/jquery-1.6.1.min.js"></script>
		<script type="text/javascript" src="/media/js/jquery-ui-1.8.7.min.js"></script>
		<script type="text/javascript" src="/media/js/drag.js"></script>
	</head>
	<body>
		<div id="header">
			<div id="logo">drag.forritun.org</div>
		</div>
		<div id="sidebar">
			<ul>
				<li<?php if ($controller == 'home'): ?> class="current"<?php endif; ?>><a href="/home"><?php echo __('Home'); ?></a></li>
				<li<?php if ($controller == 'car'): ?> class="current"<?php endif; ?>><a href="/car"><?php echo __('Cars'); ?></a></li>
				<li<?php if ($controller == 'time'): ?> class="current"<?php endif; ?>><a href="/time"><?php echo __('Times'); ?></a></li>
<?php if (Auth::instance()->logged_in('login')): ?>
				<li<?php if ($controller == 'user' AND $action == 'profile'): ?> class="current"<?php endif; ?>><a href="/user/profile"><?php echo __('Profile'); ?></a></li>
				<li<?php if ($controller == 'user' AND $action == 'logout'): ?> class="current"<?php endif; ?>><a href="/user/logout"><?php echo __('Logout'); ?></a></li>
<?php else: ?>
				<li<?php if ($controller == 'user' AND $action == 'register'): ?> class="current"<?php endif; ?>><a href="/user/register"><?php echo __('Register'); ?></a></li>
				<li<?php if ($controller == 'user' AND $action == 'login'): ?> class="current"<?php endif; ?>><a href="/user/login"><?php echo __('Login'); ?></a></li>
				<li<?php if ($controller == 'user' AND $action == 'lostpassword'): ?> class="current"<?php endif; ?>><a href="/user/lostpassword"><?php echo __('Lost password'); ?></a></li>
<?php endif; ?>
			</ul>
		</div>
		<div id="main">
<?php echo isset($view) ? $view : NULL; ?>
		</div>
	</body>
</html>
