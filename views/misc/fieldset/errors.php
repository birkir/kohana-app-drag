<?php foreach ($errors as $name => $error): ?>
			<div class="message error">
				<p>
<?php foreach ($error as $k => $v): ?>
<?php if (is_string($v)): ?>
					<?php echo UTF8::ucfirst(__(':field must not be :error', array(
						':field' => $name,
						':error' => (string) $v
					))); ?>
<?php endif; ?>
<?php endforeach; ?>
				</p>
			</div>
<?php endforeach; ?>