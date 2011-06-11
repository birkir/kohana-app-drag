<?php foreach ($errors as $error): ?>
			<div class="message error">
				<p>
					<?php echo is_array($error) ? implode(' '.__('and').' ', $error) : $error; ?>
				</p>
			</div>
<?php endforeach; ?>