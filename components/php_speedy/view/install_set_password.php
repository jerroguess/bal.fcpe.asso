<h1>Installation - set password</h1>

<p>We need to password protect this installation so only you have access.</p>

<form method="post" enctype="multipart/form-data" action="">

<fieldset>
	<legend>Your username and password</legend>
	
			<label>Username</label>
				<div class="info">
				<input type="text" name="user[username]" class="long_text" value="" />
				</div>	
			<label>Password</label>
				<div class="info">
				<input type="password" name="user[password]" class="long_text" value="" />
				</div>	
			
		<input type="submit" name="submit" value="Next..." />	
		<input type="hidden" name="page" value="install_stage_1" />
	
	</form>	
		
</fieldset>