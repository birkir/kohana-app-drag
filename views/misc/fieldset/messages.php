<?php foreach ($messages as $message): ?>
			<div class="message <?php echo isset($message->type) ? $message->type : NULL; ?>">
				<p>
					<?php echo is_array($message) ? implode(' '.__('and').' ', $message) : $message; ?>
				</p>
			</div>
<?php endforeach; ?>