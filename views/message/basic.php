<ul id="message">
	<?php foreach ($messages as $message): ?>
	<li class="<?php echo $message->type; ?>">
		<?php echo $message->message; ?>
	</li>
	<?php endforeach; ?>
</ul>