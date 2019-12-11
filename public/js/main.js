
(function ($) {
    "use strict";

    $(function() {
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;    
        $('.datepicker').attr('max', maxDate);
    });

    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){ 
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
    $('.input1000').each(function(){ 
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');
    input = $('.validate-input .input1000');
    $('.validate-form').on('submit',function(){
        var check = true;
        
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });
    $('.validate-form .input1000').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {

        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {

            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
               
                return false;
            }
        }
        else if($(input).attr('name')== 'contact_no' || $(input).attr('name') == 'cost_center' || $(input).attr('name') == 'emp_code') {

            if($(input).val().trim().match(/^(\d{5,})$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();
        $(input).val("");
        $(thisAlert).addClass('alert-validate');
        
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');
    }
    
     /*==================================================================
    [ Show / hide Form ]*/
    
    $('.contact1000-btn-hide').on('click', function(){
       // $('.wrap-contact1000').fadeOut(400);
    })

    $('.contact1000-btn-show').on('click', function(){
        //$('.wrap-contact1000').fadeIn(400);
    })


})(jQuery);

 