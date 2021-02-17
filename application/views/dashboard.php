<div class="container">
	<div class="row">
		<?php
			if(is_admin()){
		?>
		<button class="col-md-2 btn-warning dash-button employee_dash" id="employee_dash" data-idpre="employee_dash"> <i class="far fa-address-book"></i> Employees </button>
		<button class="col-md-4 btn-warning dash-button employee_dash" id="employee_dash_info" data-idpre="employee_dash" style="opacity: 0.6;"><h5 class="employee_dash" id="employee_dash_text" style="display: block;"> Click to add and view employees </h5><i class="fas fa-arrow-right fa-5x employee_dash" id="employee_dash_arrow" style="display: none;"></i></button>
		<?php
			}
		?>
		<button class="col-md-2 btn-primary dash-button shift_dash" id="shift_dash" data-idpre="shift_dash"> <i class="fas fa-plus-square"></i> Shift </button>
		<button class="col-md-4 btn-primary dash-button shift_dash" id="shift_dash_info" style="opacity: 0.6;" data-idpre="shift_dash"><h5 id="shift_dash_text" class="shift_dash" style="display: block;"> Click to add Shift Data </h5><i class="fas fa-arrow-right fa-5x shift_dash" id="shift_dash_arrow" style="display: none;"></i></button>
		<button class="col-md-2 btn-info dash-button daily_dash" id="daily_dash" data-idpre="daily_dash"> <i class="fas fa-edit"></i> Daily </button>
		<button class="col-md-4 btn-info dash-button daily_dash" id="daily_dash_info" style="opacity: 0.6;" data-idpre="daily_dash"><h5 id="daily_dash_text" class="daily_dash" style="display: block;"> Click to add Daily Data and shift overview </h5><i class="fas fa-arrow-right fa-5x daily_dash" id="daily_dash_arrow" style="display: none;"></i></button>
		<?php
			if(is_admin()){
		?>
		<button class="col-md-2 btn-success dash-button reports_dash" id="reports_dash"> <i class="fas fa-chart-bar" data-idpre="reports_dash"></i> Reports </button>
		<button class="col-md-4 btn-success dash-button reports_dash" id="reports_dash_info" style="opacity: 0.6;" data-idpre="reports_dash"><h5 id="reports_dash_text" class="reports_dash" style="display: block;"> Click to view all reports </h5><i class="fas fa-arrow-right fa-5x reports_dash" id="reports_dash_arrow" style="display: none;"></i></button>
		<?php
			}
		?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.dash-button').hover(function(){
		var arrow = $(this).data('idpre')+'_arrow';
		var text = $(this).data('idpre')+'_text';
		$('#'+arrow).show();
		$('#'+text).hide();
	},function(){
		var arrow = $(this).data('idpre')+'_arrow';
		var text = $(this).data('idpre')+'_text';
		$('#'+arrow).hide();
		$('#'+text).show();
	});
});
</script>