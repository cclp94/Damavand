
$(document).ready(function(){
    $(".add-project").click(function(){
        var h = $('a[href="#project-add"]').tab('show');
    });

    $(".add-employee").click(function(){
        var h = $('a[href="#employee-add"]').tab('show');
    });

    $('.assignbox').change(function() {
        flipCheckBoxes(this);
    });

    $('#assignbox-master').change(function() {
        if($(this).is(":checked")) {
            $('.assignbox').prop('checked', true);
        }else{
            $('.assignbox').prop('checked', false);
        }
        flipCheckBoxes('.assignbox');
    });

    $("#assign").click(function(){
        var id = $("#taskId").val();
        var url = "./task-view.php?id="+id;
        $('.assignbox :checked').each(function() {
            url += "&assign[]="+$(this).val();
        });
        window.location.href = url;
    });

    var flipCheckBoxes = function(that){
        if($(that).is(":checked")) {
            $(that).parent().parent().removeClass($(that).parent().parent().attr("class"));
            $(that).parent().parent().addClass("info")
            $(that).parent().parent().children().children("input[type=number]").attr('disabled',false);
        }else{
            var lastClass = $(that).parent().parent().attr('class').split(' ').pop();   
            $(that).parent().parent().removeClass(lastClass);         
            $(that).parent().parent().addClass($(that).parent().parent().attr('default'));
            $(that).parent().parent().children().children("input[type=number]").attr('disabled',true);
        }
        $('#textbox1').val($(that).is(':checked'));    
    }


    $('#create-user').change(function() {
        $('#username').attr('disabled',!this.checked)
        $('#userPass').attr('disabled',!this.checked)
    });
});