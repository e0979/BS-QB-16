<script id="item-card-list" type="text/template">
	<div id="search" class="results-wrapper">	
		<div class="container cards-list">
				{{doctors}}
			<div class="col-lg-4 col-md-4 columna">
				<div id="results-doctor-{{#}}" class="item-card">		
					<div class="default-pic">
						<img src="				
						{{if image|empty}}					
							{{if gender|equals>F}}
								<?php echo IMG; ?>default-female.png				
							{{else}}
								<?php echo IMG; ?>default-male.png
							{{/if}}
					    {{else}}
					  	  	{{image}}
				        {{/if}}" class="img-responsive img-circle">
						
						
						
						
					</div>
					<div class="item-head {{specialty}}">
						<h4>{{specialty}}</h4>
						<h1>{{name}}</h1>					
					</div>
					<div id="collapse-{{#}}" class="info panel-collapse collapse in">
						&nbsp;
					{{if practice}}
						{{practice}}
						<div class="clinics-list">
							<div class="clinic-name"><i class="fa fa-building-o"></i> {{name}}</div>
							<div class="dates">
								{{if schedule}}
									{{schedule}}
										<div class="day">
											{{day}}
										</div>
										<div class="time">
											{{ini_schedule}}-{{end_schedule}}
										</div>
									{{/schedule}}
								{{/if}}
							</div>
						</div>
						{{/practice}}
					{{/if}}
					</div>
					<div class="col-lg-5 col-md-5">
						<input id="doctor-rating-{{#}}" class="rating" data-min="0" data-max="5" data-step="1" data-size="xs" data-show-clear="false" data-show-caption="false">
					</div>
					<div class="col-lg-7 col-md-7 text-right">					
						
							<a class="btn btn-default btn-moreinfo right" href="#doctor/details/{{id}}">
								<?php echo SITE__SEE_MORE; ?> <i class="fa fa-plus"></i>
							</a>
							<button type="button" class="btn btn-default btn-book right">
								<?php echo SITE__BOOK_APPOINTMENT; ?>
							</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			{{/doctors}}
		</div>
	</div>
</script>