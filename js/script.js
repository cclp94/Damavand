
$(document).ready(function(){
    $(".add-project").click(function(){
        var h = $('a[href="#project-add"]').tab('show');
    });

    $(".add-employee").click(function(){
        var h = $('a[href="#employee-add"]').tab('show');
    });
});