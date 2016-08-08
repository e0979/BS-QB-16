<?php if (!empty($this->notificaciones)) {  ?>
          <ul class="nav navbar-nav navbar-right">
           	<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-bell notifications-bell"></i> &nbsp;<span class="badge"><?php echo count($this -> notificaciones); ?></span></a>
           		
             	<ul id="notifications-array" class="dropdown-menu text-left">
             		<?php foreach($this->notificaciones as $lista) { ?>
             		<li><?php echo $lista["text"]; ?>
             			<a class="notification-btn" href="<?php echo URL.$lista['goto']; ?>"><i class="glyphicon glyphicon-eye-open"></i></a>
             			<button class="btn btn-xs not<?php echo $lista["id"]; ?>" onclick="eliminate_notifications(<?php echo $lista["id"]; ?>);"> &nbsp;<i class="glyphicon glyphicon-ok"></i></button></li>
                	<?php } ?>                	
                    
               </ul>
         	</li>
          </ul>
<?php } ?>