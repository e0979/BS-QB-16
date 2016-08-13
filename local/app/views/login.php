		<form id="form-login" role="form" class="form-signin">
			<h1 class="form-signin-heading text-muted quinbi-login"><!--img src="<?php echo IMG; ?>quinbi.png"--></h1>
								
			<input type="text" class="form-control user" id="username" name="username" required autofocus="">
			<input type="password" class="form-control password" id="password" name="password" required>
			<!--button  class="btn btn-lg btn-login btn-block" type="submit">
				
			</button-->
			<button id="send" type="submit" class=" btn btn-lg btn-login  btn-block">
			<i class="glyphicon glyphicon-log-in"></i>
			</button>
			<div class="clear" style="height:20px"></div>
			<div id="response"></div>
		</form>