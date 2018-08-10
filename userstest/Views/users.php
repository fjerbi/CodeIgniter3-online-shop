
	<div class="row">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Pass</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbod>
					<?php foreach($users as $user): ?>
					<tr>
						<td><?php echo $user->id; ?></td>
						<td><a href="<?php echo base_url('users/'.$user->user_nicename); ?>"><?php echo $user->user_login; ?></a></td>
						<td><?php echo $user->user_pass; ?></td>
						<td><?php echo $user->user_email; ?></td>
					</tr>
					<?php endforeach; ?>
				</tbod>
			</table>
			
		</div>
	</div>
