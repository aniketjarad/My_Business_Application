$(document).ready(function(){

  $('#signup-form').on('submit', function (e) {
    e.preventDefault();
    if ($('#pass').val() != $('#con_pass').val()) {
      //console.log("Password doesn't match");
      $('#confirm').addClass('alert-validate');
      $('#pass,#con_pass').val("");
    }
    else if($('#email').val()!= "" && !$('#email_div').hasClass('alert-validate')){
      //console.log("i am still in");
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: '/user/save',
        data: $('#signup-form').serialize(),
        success: function (res) {
          if (res.data.status == 'success') {
            $('#hide').show();
            $('#hide').html('<span class="label-input50">'+res.data.response+'</span>');
            setTimeout(function() {
              window.location.href = "/home/login";
            }, 2000);
          }else if (res.data.status == 'error') {
            $('#hide').show();
            $('#hide').html('<span class="label-input50">'+res.data.response+'</span>');
            setTimeout(function() {
              window.location.href = "/home/login";
            }, 2000);
          }
        }
      });
    }
  });

  $('#login-form').on('submit', function (e) {
    e.preventDefault();
    if($('#email').val()!= "" && $('#pass').val()!= "" && !$('#email_div').hasClass('alert-validate')){
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: '/user/login',
        data: $('#login-form').serialize(),
        success: function (res) {
          if (res.status == 'success') {
            $('#hide').show();
            $('#hide').html('<span class="label-input50">'+res.response+'</span>');
            setTimeout(function() {
              window.location.href = "/home/";
            }, 2000);
          }else if (res.status == 'error') {
            $('#hide').show();
            $('#hide').html('<span class="label-input50">'+res.response+'</span>');
          }
        }
      });
    }
  });

  $('#logout').on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: 'post',
        url: '/user/logout',
        data:"",
        success: function (res) {
          if (res.status == 'success') {
            setTimeout(function() {
              window.location.href = "/home/login";
            }, 2000);
          }
        }
      });
  });

  $('#register-form').on('submit', function (e) {
    e.preventDefault();
    //console.log("step here");
    if(!$('#cc-div').hasClass('alert-validate') && !$('#contact-div').hasClass('alert-validate') && !$('#emp_code-div').hasClass('alert-validate')){
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: '/employee/save',
        data:$('#register-form').serialize(),
        success: function (res) {
          // console.log(res);
          if (res.status == 'success') {
            $('#hide').show();
            $('#hide').html('<span class="label-input50">'+res.data+'</span>');
            setTimeout(function() {
              window.location.href = "/employee/";
            }, 1000);
          }else if (res.status == 'error') {
            $('#hide').show();
            $('#hide').html('<span class="label-input50">'+res.data+'</span>');
          }
        }
      });
    }
  });
  
/*Skill matrix add skill acitivy*/
$('#addskill-form').on('submit', function (e) {
  e.preventDefault();
  //console.log("step asdadhere");
 //e.preventDefault();
  
  
 
  $.ajax({
    type: 'post',
    url: '/employee/add_certification',
    data:$('#addskill-form').serialize(),
    success: function (res) {
      // console.log(res);
      if (res.status == 'success') {
        // $('#hide').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
        console.log("Success");
        // setTimeout(function() {
        // window.location.href = "/employee/";
        // }, 1000);
      }else if (res.status == 'error') {
        console.log("Error");
        // $('#hide').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
      }
    }
  });
  
  
});



// This is for the certification details
$('#certificateCategory').on('change', function (e) {
  e.preventDefault();

  // console.log($('#certificateCategory').val());
  if ($('#certificateCategory').val() == "None") {
     $('#certificatediv').hide();
     $('#certificateModulediv').hide();
     $('#certificatedivCustomModule').hide();
     $('#certificatedivCustomName').hide();
     $('#IdcertModuleCustom').val('');
     $('#certificatedivCustomNameId').val('');
     $('#certificateExpDateId').val('');
   
  }
  else if( $('#certificateCategory').val() =="Other")
    {
      $('#certificatediv').hide();
     $('#certificateModulediv').hide();
     $('#IdcertModuleCustom').val('');
     $('#certificatedivCustomNameId').val('');
     $('#certificateExpDateId').val('');
     

     $('#certificatedivCustomModule').show();
     $('#certificatedivCustomName').show();
     $('#IdcertModuleCustom').val('');
     $('#certificatedivCustomNameId').val('');
     $('#certificateExpDateId').val('');
   }
   else{
      $('#certificatediv').show();
     $('#certificateModulediv').show();
     $('#certificatedivCustomModule').hide();
     $('#certificatedivCustomName').hide();
     $('#certificateExpDateId').val('');
   }  
   // $('#certificatedivCustom').hide();
 $('#certificateModule ').find('option') .remove(); 

  $.ajax({
    type: 'post',
    url: '/employee/certification_category',
    data: $('#addCertificate-form').serialize(),
    success: function (res){
       console.log(res);
      if (res.status == 'success') {
         $('#certificateModule').val('');
         // $('#certificatediv').show();
        for (var i = Object.keys(res.data).length - 1; i >= 0; i--) {
          // console.log(res.data['ITSM'])[i];
          
              $('#certificateModule').append('<option name='+ Object.keys(res.data)[i] +' >'+Object.keys(res.data)[i]+'</option>');
            }
            $('#certificateModule').on('change', function (e) {
                $('#certificateName').html("");

                var key = $('#certificateModule').val();
               
                for (var j = 0; j < res.data[key].length; j++) {
                 
                  $('#certificateName').append('<option name='+  res.data[key][j] +' >'+ res.data[key][j]+'</option>');
              
                }
                
        });
        
      }else if (res.status == 'error') {
         // console.log("Error");
         // $('#certificatediv').hide();
         
         // $('#certificatedivCustom').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
      }
    }
  });
  
  
});

// Add Certification details
$('#addCertificate-form').on('submit', function (e) {
  e.preventDefault();
  // console.log("step asdadhere");
 //e.preventDefault();
  $.ajax({
    type: 'post',
    url: '/employee/add_certification',
    data:$('#addCertificate-form').serialize(),
    success: function (res) {
      // console.log(res);
      if (res.status == 'success') {
        // $('#hide').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
        // console.log("Success");

        setTimeout(function() {
           $('#hide_result').show();
            $('#hide_result').html('<span class="label-input50">'+res.data+'</span>');
        window.location.href = "/employee/certification";
        }, 2000);
      }else if (res.status == 'error') {
        // console.log("Error");
        // $('#hide').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
      }
    }
  });
  
  
});




$('#update-form').on('submit', function (e) {
  //e.preventDefault();
  // console.log("step here");
  if(!$('#contact-div').hasClass('alert-validate')){
    e.preventDefault();
    $.ajax({
      type: 'post',
      url: '/employee/update',
      data:$('#update-form').serialize(),
      success: function (res) {
        // console.log(res);
        if (res.status == 'success') {
          $('#hide').show();
          $('#hide').html('<span class="label-input50">'+res.data+'</span>');
          setTimeout(function() {
            window.location.href = "/employee/";
          }, 1000);
        }else if (res.status == 'error') {
          $('#hide').show();
          $('#hide').html('<span class="label-input50">'+res.data+'</span>');
        }
      }
    });
  }
});

});
var url = window.location;
if(url == "http://www.mybusinessapplication.local.com/home/"){
  $("#home-link").addClass('active');
  $("#home-menu-link").addClass('active');
}else if(url == "http://www.mybusinessapplication.local.com/employee/"){
  $("#all_emp-link").addClass('active');
  $("#employee-tab").addClass('active');
  $("#employee-menu-link").addClass('active');
}
else if(url == "http://www.mybusinessapplication.local.com/employee/certification"){
  $("#cert-link").addClass('active');
  $("#employee-tab").addClass('active');
  $("#employee-menu-link").addClass('active');
}
else if(url == "http://www.mybusinessapplication.local.com/employee/skillmatrix"){
  $("#skill-link").addClass('active');
  $("#employee-tab").addClass('active');
  $("#employee-menu-link").addClass('active');
}/*
else if(url == "http://www.mybusinessapplication.local.com/home/"){
  
}
else if(url == "http://www.mybusinessapplication.local.com/home/"){
  
}*/


