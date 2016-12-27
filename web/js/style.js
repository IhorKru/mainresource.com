$(document).ready(function(){
    $('#input_partnername').on('change', function() {
        if ( this.value == '0'){
            $("#input_resourcename").hide();
            $("#input_templatename").hide();
            $("#numemailspicker").hide();
            $("#timezonepicker").hide();
            $("#datetimepicker2").hide();
        } else if (this.value == '1'){
            $("#input_resourcename").hide();
            $("#input_templatename").hide();
            $("#numemailspicker").show();
            $("#timezonepicker").show();
            $("#datetimepicker2").show();
        } else {
            $("#input_resourcename").show();
            $("#input_templatename").show();
            $("#timezonepicker").show();
            $("#datetimepicker2").show();
        }
    }).trigger("change")
       
    $('.form_datetime').datetimepicker({
        //language:  'uk',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
    
    $('.form_date').datetimepicker({
        language:  'uk',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
    
    $('.form_time').datetimepicker({
        language:  'uk',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
});
