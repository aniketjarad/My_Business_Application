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
        for (var i = Object.keys(res.data).length - 1; i >= 0; i--) {
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

$('#add_btn').on('click',function (e) {
  e.preventDefault();
  $.ajax({
    type: 'post',
    url: '/demand/getDemand',
    data: null,
    success: function (res) {
      if(res.status == 'success'){
        $('#demand_id_text').hide();
        $('#demand_id_select').show();
        $('#demand_id_select').html("");
        for (var j = 0; j < res.data.length; j++) {
          $('#demand_id_select').append('<option value='+  res.data[j] +' >'+ res.data[j]+'</option>');
        }
      }else{
        $('#demand_id_select').hide();
        $('#demand_id_text').show();
      }
    }
  });
});
/*Skill matrix add skill acitivy*/
$('#add-demand-form').on('submit', function (e) {
  e.preventDefault();
  $.ajax({
    type: 'post',
    url: '/demand/add',
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    beforeSend:function(){
      console.log("we are here");
      $('#msg').show();
      $('#msg').html('<span class="label-input50">Uploading......!</span>');
      setTimeout(function() {
        $('#msg').hide();
      }, 5000);
    },
    success: function (res) {
      // console.log(res);
      if (res.status == 'success') {
        // $('#msg').show();
        // $('#msg').html('<span class="label-input50">'+res.data+'</span>');
        console.log("Success");
        // setTimeout(function() {
        // window.location.href = "/demand/";
        // }, 1000);
      }else if (res.status == 'error') {
        console.log("Error");
        $('#msg').show();
        $('#msg').html('<span class="label-input50">'+res.data+'</span>');
      }
    },error: function(xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('#demand_status').on('change', function (e) {
  var val = $('#demand_status').val();
  if(val =="Backfill"){
    $.ajax({
      type: 'post',
      url: '/demand/getInActiveEmployee',
      data: null,
      success: function (res) {
        console.log(res);
        console.log(res.data[1].emp_code);
        console.log(res.data[1].emp_name);
        if(res.status == 'success'){
          $('#backfill_div').show();
          $('#backfill_select').show();
          $('#backfill_select').html("");
          //console.log(Object.keys(res.data)[1].emp_code);
          for (var i=1; i<= Object.keys(res.data).length ; i++) {
            $('#backfill_select').append('<option value='+ res.data[i].emp_code +' >'+res.data[i].emp_name+'</option>');
          }
        }
      }
    });
  }
  else{
    $('#backfill_div').hide();
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


