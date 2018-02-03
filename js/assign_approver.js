$(document).ready(function() {

	$("#appr_dept_id").change(function (e) {
		e.preventDefault();
		//get list of
		var val = $(this).val();
		$.get("get_faculty_list.php?dept="+val, function(data, status){
	        alert("Data: " + data + "\nStatus: " + status);
	    }); 
	});
});