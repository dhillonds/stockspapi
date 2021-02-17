$(document).ready(function(){
	$('.shift_dash').click(function(){
		window.location.href = js_base_url+"shift";
	});
	$('.daily_dash').click(function(){
		window.location.href = js_base_url+"daily";
	});
	$('.employee_dash').click(function(){
		window.location.href = js_base_url+"users/employees";
	});
	$('.reports_dash').click(function(){
		window.location.href = js_base_url+"reports";
	});
	$('.total_report_btn').click(function(){
		window.location.href = js_base_url+"reports/view";
	});
	$('.daily_report_btn').click(function(){
		window.location.href = js_base_url+"reports/daily";
	});
	$('#logout_btn').click(function(){
		window.location.href = js_base_url+"users/logout";
	});
});
function goBack() {
  window.history.back();
}
function gorepdash() {
  event.preventDefault();
  window.location.href = js_base_url+"reports";
}