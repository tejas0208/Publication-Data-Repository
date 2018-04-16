$(document).ready(function() {
  $("#mis_id").change(function(){
    var mis = $('#mis_id').val();
    var data = {
      "mis": mis
    };
    data = $(this).serialize() + "&" + $.param(data);
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "getData.php", //Relative or absolute path to response.php file
      data: data,
      success: function(data) {
        $("#full_name_id").val(data["FullName"]);
        $("#email_id").val(data["CoepEmail"]);
        $("#dept_id").val(data["Department"]).change();
        $("#branch_id").val(data["BranchName"]).change();
      }
    });
    return false;
  });
  var role = $("#role_id");
  if(role.val() == 'student') {
    var username = $("#username_id").val();
    $("#mis_id").val(username).trigger("change");
  }
});