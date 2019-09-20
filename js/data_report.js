$(document).ready(function() {
    $("#formdata").submit(function(e) {
        var postData = $(this).serializeArray();
        $.ajax(
        {
            url : "data_process.php",
            type: "POST",
            crossDomain: true,
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#output").html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                alert('it didnt work');   
            }
        });
        e.preventDefault(); //STOP default action
        e.unbind();
    });
});