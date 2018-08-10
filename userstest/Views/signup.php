
	
	<div class="row">
		<div class="span6 offset3">
			<h1>Sign up</h1>
						
			<?php if(@$error): ?>
			<div class="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<?php echo $error; ?>
			</div>
			<?php endif; ?>
	

			<div class="well">
			
				<form class="form-horizontal" method="post" action="">
					<div class="control-group">
						<label class="control-label" for="inputFullName">Full Name</label>
						<div class="controls">
							<input type="text" id="inputFullName" value="<?php echo set_value('fullname'); ?>" name="fullname">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="inputEmail">Username</label>
						<div class="controls">
							<input type="text" id="inputEmail" value="<?php echo set_value('username'); ?>" name="username">
							<em>http://<strong>username</strong>.site.com</em>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="inputEmail">Email</label>
						<div class="controls">
							<input type="text" id="inputEmail" value="<?php echo set_value('email'); ?>" name="email">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputPassword">Password</label>
						<div class="controls">
							<input type="password" id="inputPassword" name="password">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn">Sign up</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
