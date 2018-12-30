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
        var placeholder1;
        if(id == 'add_faculty') {
        	placeholder1 = "Enter Faculty MIS";
        }

        else if (id == 'add_ug_student') {
        	placeholder1 = "Enter UG Student's MIS";
        }
        else if (id == 'add_pg_student') {
        	placeholder1 = "Enter PG Student's MIS";
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


    $('.journal_details').change(function() {
    	var c = this.checked;
    	var value = this.value;
    	var html = '<input type="text" class="form-control" name="' + value + '_journal_name" placeholder="Journal name"><br>';
    	if(c) {
    		$(this.parentElement.parentElement).append(html);
    	}
    	else {
    		$(this.parentElement.nextSibling.nextSibling).remove();
    		$(this.parentElement.nextSibling).remove();
    	}
    });

    $('.conference_details').change(function() {
    	var c = this.checked;
    	var value = this.value;
    	var html = '<input type="text" class="form-control" name="' + value + '_conference_name" placeholder="Journal name"><br>';
    	if(c) {
    		$(this.parentElement.parentElement).append(html);
    	}
    	else {
    		$(this.parentElement.nextSibling.nextSibling).remove();
    		$(this.parentElement.nextSibling).remove();
    	}
    });




});

// $(document).ready(function() {

// 	$(".appr").change(function (e) {
// 		// body...
// 		e.preventDefault();
// 		console.log("CLick0");
// 	});
// });
