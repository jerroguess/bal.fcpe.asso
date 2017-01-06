<?php if(!empty($message)) { ?><div class="success"><?php echo $message ?></div><?php } ?>

<h1>Installation - Stage 2</h1>

<p>Compression options</p>

<form method="post" enctype="multipart/form-data" action="">

	<fieldset>
		<legend>Cache Directories</legend>

			<label>Your JavaScript will be cached in</label>
				<div class="info">
				<input type="text" name="user[javascript_cachedir]" class="long_text" value="<?php echo $javascript_cachedir ?>" />
				</div>	
			<label>Your CSS will be cached in</label>
				<div class="info">
				<input type="text" name="user[css_cachedir]" class="long_text" value="<?php echo $css_cachedir ?>" />
				</div>	
				
	</fieldset>

<?php foreach($options AS $key=>$type) { ?>	
	<fieldset>
		<legend><?php echo $key ?> Options</legend>

			<?php foreach($type AS $option=>$value) {  ?>

			<label><?php echo $key . " " . $option ?></label>
				<div class="info">
				Yes: <input name="user[<?php echo $key ?>][<?php echo $option ?>]" type="radio" value="1" <?php if(!empty($value)) { ?>checked<?php } ?>>
				No: <input name="user[<?php echo $key ?>][<?php echo $option ?>]" type="radio" value="0" <?php if(empty($value)) { ?>checked<?php } ?>>				
				</div>	
				
			<?php } ?>
		
	</fieldset>
<?php } ?>
		<input type="submit" name="submit" value="Next..." />	
		<input type="hidden" name="page" value="install_stage_3" />
		
		<input type="hidden" name="user[_username]" value="<?php echo $compress_options['username'] ?>" />
		<input type="hidden" name="user[_password]" value="<?php echo $compress_options['password'] ?>" />	
	
</form>	