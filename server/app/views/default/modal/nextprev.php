<?php 

if (!empty($this->nextp)) {
		
	$next= "<button class='btn btn-default' onclick=view('".$this->whatnext."',".$this->nextp[0]['id'].");><i class='glyphicon glyphicon-chevron-left'></i></button>";
}
if (!empty($this->prevp)) {
		
	$prev= "<button class='btn btn-default' onclick=view('".$this->whatnext."',".$this->prevp[0]['id'].");><i class='glyphicon glyphicon-chevron-right'></i></button>";
}
		
		?>
<div class="grid_3 text-right right">
	<div class="btn-group btn-group-sm">
		<?php echo @$next; 
			  echo @$prev; ?>
		<button class="btn btn-default soloenview" onclick="edit('<?php echo $this->whatnext . "', '". $this->curent ."'"; ?>);"><i class='glyphicon glyphicon-pencil'></i></button>
	</div>
</div>