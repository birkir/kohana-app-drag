<div class="block">
	<h2><?php echo __('Register'); ?></h2>
	<div class="content">
		<form action="" method="post">
			<fieldset>
		<?php echo View::factory('misc/fieldset/errors')->set('errors', isset($errors) ? $errors : array()); ?>
				<dl>
					<dt><label for="f_username"><?php echo __('Username'); ?></label></dt>
					<dd><input type="text" name="username" id="f_username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : NULL; ?>" /></dd>
		
					<dt><label for="f_email"><?php echo __('Email'); ?></label></dt>
					<dd><input type="text" name="email" id="f_email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : NULL; ?>" /></dd>
		
					<dt><label for="f_password"><?php echo __('Password'); ?></label></dt>
					<dd><input type="password" name="password" id="f_password" /></dd>
		
					<dt><label for="f_confirm_password"><?php echo __('Confirm password'); ?></label></dt>
					<dd><input type="password" name="password_confirm" id="f_confirm_password" /></dd>
		
					<script type="text/javascript">var RecaptchaOptions = {
						theme : 'white',
						custom_translations : {
							visual_challenge : "Sjónræn þraut",
							audio_challenge : "Hljóðræn þraut",
							refresh_btn : "Ný þraut",
							instructions_visual : "Skrifaðu orðin sem þú sérð:",
							instructions_audio : "Skrifaðu orðin sem þú heyrir:",
							cant_hear_this : "Sækja hljóðbrot sem MP3",
							help_btn : "Hjálp",
							play_again : "Spila hljóðbrot aftur",
							incorrect_try_again : "Vitlaust. Reyndu aftur."
					}};</script>
					<dt><label for="f_captcha"><?php echo __('Captcha'); ?></label></dt>
					<dd><?php echo $captcha; ?></dd>
				</dl>
				<input type="submit" value="<?php echo __('Register'); ?>" />
			</fieldset>
		</form>
	</div>
</div>