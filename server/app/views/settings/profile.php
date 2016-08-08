<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="title-header">
					  <h1> <small>Mi Perfil</small></h1>
			</div>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                    
                <div class="col-md-10 col-md-offset-1">
                        <h3><?php echo $this->userdata[0]['name']; ?> <small> ( <i class="glyphicon glyphicon-user"></i> <?php echo $this->userdata[0]['rif']; ?> )</small></h3>
                       
                        <p><i class="glyphicon glyphicon-envelope"></i> <?php echo $this->userdata[0]['email']; ?></p>
                        <p> <i class="glyphicon glyphicon-phone"></i> <?php echo $this->userdata[0]['phone']; ?></p>
                        <br>
                        <div class="right">
                        <a href="<?php echo URL;?>settings/edit/password" class="btn btn-default disabled"><i class="glyphicon glyphicon-pencil"></i> Editar Perfil</a>
                        <a href="<?php echo URL;?>settings/edit/password" class="btn btn-default"><i class="glyphicon glyphicon-lock"></i> Editar Contraseña</a>
                        </div>
                    </div>
                <div class="clear" style="height:20px"></div>
				<div id="msg"><div id="response"></div><div class="b-close"></div></div>	
            </div>
            
        </div>
    </div>
</div>