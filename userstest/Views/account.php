	<div class="row">
		<div class="span6 offset3">
			<h1>Account settings</h1>
			
			<?php if(@$message): ?>
			<div class="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<?php echo $message; ?>
			</div>
			<?php endif; ?>

			<div class="well">
					
				<form class="form-horizontal" method="post" action="">
					<div class="control-group">
						<label for="inputNickname" class="control-label">Nickname</label>
						<div class="controls">
							<input type="text" id="inputNickname" name="nickname" value="<?php echo $user->user_nicename; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputEmail">Email</label>
						<div class="controls">
							<input type="text" id="inputEmail" placeholder="Email" name="email" value="<?php echo $user->user_email; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputPassword">Password</label>
						<div class="controls">
							<input type="password" id="inputPassword" placeholder="Password" name="password" value="" />
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

