<?php if(!empty($message)) { ?><div class="success"><?php echo $message ?></div><?php } ?>

<h1>Installation - Stage 1</h1>

<p>Welcome to PHP Speedy installation.</p>

<fieldset>
	<legend>Path Information</legend>
	<label>Your full path to document root:</label>
		<div class="info"><?php echo $paths['full']['document_root'] ?></div>	
	<form method="post" enctype="multipart/form-data" action="">
			
			<p>			
				<div class="notice">
				Your document root is the root folder that your HTML files are served from. If you don't know what it is, it's probably the path above. Just click <strong>Next...</strong> below			
				</div>		
			</p>
			<p></p>
		
		<h4>Wait! That's not it...</h4>	
		<p><strong>Is the above path incorrect?</strong> If so, please enter the correct path
		<input type="text" name="user[document_root]" class="long_text" value="<?php echo $document_root ?>" />
		</p>	
			
		<input type="submit" name="submit" value="Next..." />	
		<input type="hidden" name="page" value="install_stage_2" />
		
		<input type="hidden" name="user[_username]" value="<?php echo $compress_options['username'] ?>" />
		<input type="hidden" name="user[_password]" value="<?php echo $compress_options['password'] ?>" />
	
	</form>	
		
</fieldset>