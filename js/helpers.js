function add_faculty_fun() {
	//get html of div add_faculty
	console.log("BUtton clicked!");
}

$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
    	//debugger;
    	console.log(this.parentElement);
    	wrapper = this.parentElement;
        var id = $(this).attr('id');
        var placeholder1, placeholder2;
        if(id == 'add_faculty') {
        	placeholder1 = "Enter Faculty MIS";
        	placeholder2 = "Enter Faculty's full name";
        }
        	
        else if (id == 'add_ug_student') {
        	placeholder1 = "Enter UG Student's MIS";
        	placeholder2 = "Full Name";
        }
        else if (id == 'add_pg_student') {
        	placeholder1 = "Enter PG Student's MIS";
        	placeholder2 = "Full Name";
        }
        else if (id == 'add_external') {
        	var html = '<div class="input-group form-group">\
        					<input type="text" class="form-control" name="'+id+'name[]" placeholder="Full Name"> \
        					&nbsp<a href="#" class="remove_field btn btn-info">Remove</a>\
        				</div>';
        }
        if(id != 'add_external') {
	        var html = '<div class="input-group form-group">\
	        				<input type="text" class="form-control" name="'+id+'mis[]" placeholder="'+placeholder1+'">\
	        				<span class="input-group-addon">&nbsp&nbsp</span>\
	        				<input type="text" class="form-control" name="'+id+'name[]" placeholder="'+placeholder2+'">\
	        				&nbsp<a href="#" class="remove_field btn btn-info">Remove</a>\
	        			</div>';
	    }			
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).prepend(html); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});