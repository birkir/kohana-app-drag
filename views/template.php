<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="is">
	<head>
		<title>Drag.forritun.org</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link type="text/css" media="screen" rel="stylesheet" href="/media/css/style.screen.css" />
		<link type="text/css" media="screen" rel="stylesheet" href="/media/css/jquery-ui-1.8.7.css" />
		<script type="text/javascript" src="/media/js/amcharts/amcharts.js" ></script>
		<script type="text/javascript" src="/media/js/amcharts/raphael.js" ></script>
		<script type="text/javascript" src="/media/js/jquery-1.6.1.min.js"></script>
		<script type="text/javascript" src="/media/js/jquery-ui-1.8.7.min.js"></script>
		<script type="text/javascript" src="/media/js/jquery-tablesorter-2.0.js"></script>
		<script type="text/javascript" src="/media/js/drag.js"></script>
	</head>
	<body>
		<div id="header">
			<div id="logo"><a href="" title=""><img src="/media/img/logo.png" alt="" /></a></div>
			<div id="account">
				<ul>
<?php if (Auth::instance()->logged_in('login')): ?>
					<li<?php if ($controller == 'user' AND $action == 'profile'): ?> class="current"<?php endif; ?>><a href="/user/profile"><?php echo __('Profile'); ?></a></li>
					<li<?php if ($controller == 'user' AND $action == 'logout'): ?> class="current"<?php endif; ?>><a href="/user/logout"><?php echo __('Logout'); ?></a></li>
<?php else: ?>
					<li<?php if ($controller == 'user' AND $action == 'login'): ?> class="current"<?php endif; ?>><a href="/user/login"><?php echo __('Login'); ?></a></li>
					<li<?php if ($controller == 'user' AND $action == 'lostpassword'): ?> class="current"<?php endif; ?>><a href="/user/lostpassword"><?php echo __('Lost password'); ?></a></li>
					<li<?php if ($controller == 'user' AND $action == 'register'): ?> class="current"<?php endif; ?>><a href="/user/register"><?php echo __('Register'); ?></a></li>
<?php endif; ?>
				</ul>
			</div>
		</div>
		<div id="sidebar">
			<ul>
				<li<?php if ($controller == 'home'): ?> class="current"<?php endif; ?>><a href="/home"><?php echo __('Home'); ?></a></li>
				<li<?php if ($controller == 'car'): ?> class="current"<?php endif; ?>>
					<a href="/car"><?php echo __('Cars'); ?></a>
<?php if ($controller == 'car'): ?>
					<ul>
						<li<?php if ($action == 'garage'): ?> class="current"<?php endif; ?>><a href="/car/garage"><?php echo __('Garage'); ?></a></li>
						<li<?php if ($action == 'add'): ?> class="current"<?php endif; ?>><a href="/car/add"><?php echo __('Add car'); ?></a></li>
					</ul>
<?php endif; ?>
				</li>
				<li<?php if ($controller == 'time'): ?> class="current"<?php endif; ?>><a href="/time"><?php echo __('Times'); ?></a></li>
				<li<?php if ($controller == 'competition'): ?> class="current"<?php endif; ?>>
					<a href="/competition"><?php echo __('Competitions'); ?></a>
<?php if (isset($_GET['id']) AND $controller == 'competition'): ?>
					<ul>
						<li<?php if ($action == 'classes'): ?> class="current"<?php endif; ?>><a href="/competition/classes?id=<?php echo $_GET['id']; ?>"><?php echo __('Classes'); ?></a></li>
						<li<?php if ($action == 'rounds'): ?> class="current"<?php endif; ?>>
							<a href="/competition/rounds?id=<?php echo $_GET['id']; ?>"><?php echo __('Rounds'); ?></a>
<?php if ($id > 0): ?>
							<ul>
								<li<?php if ($action == 'competitors' OR $action == 'competitor'): ?> class="current"<?php endif; ?>><a href="/competition/competitors/<?php echo $id; ?>?id=<?php echo $_GET['id']; ?>"> <?php echo __('Competitors'); ?></a></li>
								<li<?php if ($action == 'matches' OR $action == 'match'): ?> class="current"<?php endif; ?>><a href="/competition/matches/<?php echo $id; ?>?id=<?php echo $_GET['id']; ?>"> <?php echo __('Matches'); ?></a></li>
							</ul>
<?php endif; ?>
						</li>
					</ul>
<?php endif; ?>
				</li>
			</ul>
		</div>
		<div id="main">
<?php if ( ! empty($title)): ?>
			<h1><?php echo __($title); ?></h1>
<?php endif; ?>
<?php echo isset($view) ? $view : NULL; ?>
		</div>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-24164997-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
			 var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
	</body>
</html>
