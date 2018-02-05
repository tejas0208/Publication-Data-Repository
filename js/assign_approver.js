$(document).ready(function() {

	$("#appr_dept_id").change(function (e) {
		e.preventDefault();
		//get list of
		var val = $(this).val();
		var html;
		$.get("get_faculty_list.php?dept="+val, function(data, status){
			debugger;
	        //alert("Data: " + data + "\nStatus: " + status);
	        var approvers_list = JSON.parse(data);
	        for (var mis in approvers_list) {
	        	var name = approvers_list[mis];
	        	html = '<option value="' + mis + '">' + name + '</option>';
	        	$("#approver_name").append(html);
	        }
	    }); 
	});
});