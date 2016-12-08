$(document).ready(function(){
    $('#input_partnername').on('change', function() {
        if ( this.value == '0'){
            $("#input_resourcename").hide();
            $("#input_templatename").hide();
            $("#input_numemails").hide();
        } else if (this.value == '1'){
            $("#input_resourcename").hide();
            $("#input_templatename").hide();
            $("#input_numemails").show();
        } else {
            $("#input_resourcename").show();
            $("#input_templatename").show();
        }
    }).trigger("change")
});
