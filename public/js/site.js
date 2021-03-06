$(document).ready(function(){
  
  $('.dt-button').addClass('button button2').removeClass('dt-button');
  
  $('#add_emp').on('click', function (e) {
    e.preventDefault();
    window.location.href = "/employee/register";
  });


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

  //Forgot Password
  $('#forgot_password_form').on('submit', function (e) {
    e.preventDefault();   
   
      
    $.ajax({
      type: 'post',
      url: '/user/checkForgotUser',
      data: $('#forgot_password_form').serialize(),
      success: function (res) {
        // console.log(res); 
        if (res.status == 'success') {
          // alert("Register Again");
          $('#hide').show();
          $('#hide').html('<span class="label-input50">'+res.response+'</span>');
          setTimeout(function() {
            window.location.href = "/user/signup";
          }, 1000);
        }else if (res.status == 'error') {
          $('#email_id_div').addClass('alert-validate');
          $('#forgot_emp_code_div').addClass('alert-validate');
          $('#forgot_emeaid_div').addClass('alert-validate');
          $('#hide').show();
          $('#hide').html('<span class="label-input50">'+res.response+'</span>');
          // setTimeout(function() {
          //   window.location.href = "/home/signup";
          // }, 2000);
        }
      }
    });
    
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
          }
          else if (res.status == 'error') {
            $('#hide').show();
            $('#hide').html('<span class="label-input50">'+res.data+'</span>');
          }
        }
      });
    }
  });
  
  /*Skill matrix add skill acitivy*/

  $("#mulipleselect_primary").select2({
    maximumSelectionLength: 1,
    tags: false,
    theme: "classic",
    allowClear: true
  });
  $("#mulipleselect_secondary").select2({
    tags: false,
    theme: "classic",
    allowClear: true
  });


  
  $('#addskill_btn').click( function (e) {
    e.preventDefault();
    $('#mulipleselect_primary').empty().trigger('change');
    $('#mulipleselect_secondary').empty().trigger('change');
    $('#employee_Name').attr("readonly",false);  
    $("#secskillcolapse").removeClass("show");
    $("#IdskillNameCustom").val("");
    $("#employee_Name").empty();
    $.ajax({
      type: 'post',
      url: '/employee/getAllEmpForSkill',
      data:null,
      success: function (res) {       
        
        if (res.status == 'success') {
          
           for(var i=1; i<=  Object.keys(res.data).length ; i++) {         
             // console.log(res.data.result[j].text);

            $('#employee_Name').append('<option value='+ res.data[i].emp_code +' >'+ res.data[i].emp_name +'</option>');
          
            }           
        }
      //   else if (res.status == 'error') {
      //     console.log("Error");
      //   }
      }
    });
    $.ajax({
      type: 'get',
      url: '/employee/getSkillList',
      data:null,
      success: function (res) {       
        // console.log(res.data);
        if (res.status == 'success') {
           for(var j = 0; j < res.data.result.length; j++) {         
             // console.log(res.data.result[j].text);
            $('#mulipleselect_primary').append('<option name='+ res.data.result[j].text +' >'+ res.data.result[j].text +'</option>');
            $('#mulipleselect_secondary').append('<option name='+ res.data.result[j].text +' >'+ res.data.result[j].text +'</option>');
            }           
        }
        else if (res.status == 'error') {
          console.log("Error");
        }
      }
    });
  });



  $('#addnewskill_btn').click( function (e) {

    e.preventDefault();
    $.ajax({
      type: 'post',
      url: '/employee/addNewSkill',
      data:$('#addskill-form').serialize(),
      success: function (res) {
        // console.log(res.status);
        if (res.status == 'success') {
          $('#hide_skillres').show();
          $('#hide_skillres').html('<span class="label-input50">'+res.data+'</span>');
          // console.log("Success");
          // setTimeout(function() {
          //    $('#hide_skillres').show();
          //     $('#hide_skillres').html('<span class="label-input50"">'+res.data+'</span>');
          // window.location.href = "/employee/skillmatrix";
          // }, 1000);
        }else if (res.status == 'error') {
           $('#hide_skillres').show();
          $('#hide_skillres').html('<span class="label-input50"  style="color:#ff0000;">'+res.data+'</span>');
           // console.log(res.response);
          // setTimeout(function() {
          //    $('#hide_skillres').show();
          //     $('#hide_skillres').html('<span class="label-input50" style="color:#ff0000;">'+res.data+'</span>');
          // window.location.href = "/employee/skillmatrix";
          // }, 1000);
        }
      }
    });
    

  });


  $('#addskill-form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
      type: 'post',
      url: '/employee/addSkillSets',
      data:$('#addskill-form').serialize(),
      success: function (res) {
        // console.log(res);
        if (res.status == 'success') {
          $('#hide_skillres').show();
          $('#hide_skillres').html('<span class="label-input50">'+res.data+'</span>');
          // console.log("Success");
          setTimeout(function() {
          window.location.href = "/employee/skillmatrix";
          }, 1000);
        }else if (res.status == 'error') {
          // console.log("Error");
          $('#hide_skillres').show();
          $('#hide_skillres').html('<span class="label-input50" style="color:#ff0000;"s>'+res.data+'</span>');
        }
      }
    });
    
    
  });
  //On page load get the Certificate Category.
  $.ajax({
      type: 'get',
      url: '/employee/getCertCategory',
      data: null,
      success: function (res){
         // console.log(res.data.length);
        if (res.status == 'success') {
          $('#certificateCategory').append('<option name="None">---Select Category---</option>');
          for (var i = Object.keys(res.data).length - 1; i >= 0; i--) {
            $('#certificateCategory').append('<option name='+ res.data[i] +' >'+ res.data[i] +'</option>');
          }
          // $('#certificateCategory').append('<option name="Other">Other</option>');
        }
        else if (res.status == 'error') {
           // console.log("Error");
            $('#certificateCategory').append('<option name="None">---Select Category---</option>');
            // $('#certificateCategory').append('<option name="Other">Other</option>');
        }   
        } 
  });
  //This variable stores the complete data of all the certificates and the modules
  var data_val;
  // This is for the certification details
  $('#certificateCategory').on('change', function (e) {
    e.preventDefault();
    $.ajax({
      type: 'post',
      url: '/employee/certification_category',
      data: $('#addCertificate-form').serialize(),
      success: function (res){
         // console.log(res.data);
         data_val = res.data;
        if (res.status == 'success') {
         $('#certificateName').html('');
         $('#certificateModule').html('');
          $('#certificateModule').append('<option name="SelectModule" >----Select Module----</option>');
          for (var i = Object.keys(res.data).length - 1; i >= 0; i--) {
            $('#certificateModule').append('<option name='+ Object.keys(res.data)[i] +' >'+Object.keys(res.data)[i]+'</option>');
          }
          
        }else if (res.status == 'error') {
           // console.log("Error");
           // $('#certificatediv').hide();
           
           // $('#certificatedivCustom').show();
          // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
        }
      }
    });
  });


  $('#certificateModule').on('change', function (e) {
              
    var key = $('#certificateModule').val();
    // console.log(data_val);

    
     $('#certificateName').html('');
      $('#certificateName').append('<option name="SelectName" >----Select Name----</option>');
    for (var j = 0; j < data_val[key].length; j++) {
      // console.log(data_val[key][j]);
      $('#certificateName').append('<option name='+  data_val[key][j] +' >'+ data_val[key][j]+'</option>');
    }            
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

  //Creates New Certificate Category Module in all certificates table
  $('#newCertificate-form').on('submit', function (e) {
    e.preventDefault();
    // console.log("step asdadhere");
    $.ajax({
      type: 'post',
      url: '/employee/add_new_certi_category',
      data:$('#newCertificate-form').serialize(),
      success: function (res) {
        // console.log(res);
        if (res.status == 'success') {
          // $('#hide').show();
          // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
          // console.log("Success");

          setTimeout(function() {
             $('#hide_result_new').show();
              $('#hide_result_new').html('<span class="label-input50">'+res.data+'</span>');
          window.location.href = "/employee/certification";
          }, 1000);
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
    $('#DemandTitle').html("Add Demand");
    $('#btn_demand').html("Add Demand");
    $('#action').val("add");
    $('#demand_id_text').val("");  
    $('#bos_id').val("");  
    $('#candidate_name').val("");  
    $('#position').val("");  
    $('#joining_date').val("");  
    $('#tentative_mapping').val(""); 
    $('#jd_div').show();
    $('#cv_div').show();
    $("#jd").html("");
    $("#cv").html("");
    $("#jd_attach").attr("required",true);
    e.preventDefault();
    $.ajax({
      type: 'post',
      url: '/demand/getDemand',
      data: null,
      success: function (res) {
        if(res.status == 'success'){
          //$('#demand_id_text').hide();
          //$('#demand_id_select').show();
          $('#demand_id_text').val(res.data[0]);
          // for (var j = 0; j < res.data.length; j++) {
          //   $('#demand_id_select').append('<option value='+  res.data[j] +' >'+ res.data[j]+'</option>');
          // }
        }else{
          //$('#demand_id_select').hide();
          //$('#demand_id_text').show();
        }
      }
    });

    $.ajax({
      type: 'post',
      url: '/project/getAllProjects',
      data: null,
      success: function (res) {

        $('#tentative_mapping').html("");
        
        for (var i=1; i<=  Object.keys(res.data).length ; i++) {
          $('#tentative_mapping').append('<option value="'+ res.data[i] +'" >'+res.data[i]+'</option>');
        }
      }
    });
  });
    //Chart Downloias
  // $('#saveServicenowChart').on('click',function (e) {
  //     console.log("asdad");
     
  //       html2canvas(document.getElementById('barChart'), {
  //         onrendered: function(canvas) {
  //           var link = document.createElement('a');
  //           link.href = canvas.toDataURL('image/jpeg');
  //           link.download = 'myChart.jpeg';
  //             link.click();
  //         }
  //       })
        

  // });
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
        }, 2000);
      },
      success: function (res) {
        // console.log(res);
        if (res.status == 'success') {
          $('#msg').show();
          $('#msg').html('<span class="label-input50">'+res.data+'</span>');
          //console.log("Success");
          setTimeout(function() {
          window.location.href = "/demand/";
          }, 1000);
        }else if (res.status == 'error') {
          //console.log("Error");
          $('#msg').show();
          $('#msg').html('<span class="label-input50">'+res.data+'</span>');
        }
      },error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });
  /*
  $('#btn_demand').on('click', function (e) {
    console.log("called");
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
        }, 2000);
      },
      success: function (res) {
        // console.log(res);
        if (res.status == 'success') {
          $('#msg').show();
          $('#msg').html('<span class="label-input50">'+res.data+'</span>');
          //console.log("Success");
          setTimeout(function() {
          window.location.href = "/demand/";
          }, 1000);
        }else if (res.status == 'error') {
          //console.log("Error");
          $('#msg').show();
          $('#msg').html('<span class="label-input50">'+res.data+'</span>');
        }
      },error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });
  */
  $('#demand_status').on('change', function (e) {
    var val = $('#demand_status').val();
    if(val =="Backfill"){
      $.ajax({
        type: 'post',
        url: '/demand/getInActiveEmployee',
        data: null,
        success: function (res) {
          // console.log(res);
          // console.log(res.data[1].emp_code);
          // console.log(res.data[1].emp_name);
          if(res.status == 'success'){
            $('#backfill_div').show();
            $('#backfill_select').show();
            $('#backfill_select').html("");
            //console.log(Object.keys(res.data)[1].emp_code);
            for (var i=1; i<= Object.keys(res.data).length ; i++) {
              $('#backfill_select').append('<option value="'+ res.data[i].emp_name +'" >'+res.data[i].emp_name+'</option>');
            }
          }
        }
      });
    }
    else{
      $('#backfill_div').hide();
    }
  });


  var val = location.pathname.split("/").slice(1);
  if(val[1] == ""){
    val = val.slice(0,-1);
  }
  if(val.length == 2){
    $('nav a[href^="/'+location.pathname.split("/")[1]+'/'+location.pathname.split("/")[2]+'"]').addClass('active');  
  }else if(val.length == 1){
    $('nav a[href="/'+location.pathname.split("/")[1]+'/"]').addClass('active');
  }


  /* ################# Project Module #################*/

  $("#multiSelectPurchaseOrderId").select2({
    
    tags: false,
    theme: "classic",
    header: false,  
    allowClear: true
  });
  //Hide Ative & Purchase Order on Add Button Click
  $('#addProjectBtn').on('click', function (e) {
    
    $('#activDiv').hide();
    $('#multiSelectPurchaseOrderDiv').hide();
    $('#hiddenProjectRes').hide();
    $('#projectId').prop('readonly', false);
    $('#projectId').val("");
    $('#projectNameId').val("");
    $('#projectCostCenterId').val("");
    $('#ActionId').val("add");


  });

  $('#addProjectForm').on('submit', function (e) {    
    e.preventDefault();
    $.ajax({
      type: 'post',
      url: '/project/addNewProject',
      data: $('#addProjectForm').serialize(),
      success: function (res) {
        console.log(res);
        if (res.status == 'success') {
          $('#hiddenProjectRes').show();
          $('#hiddenProjectRes').html('<span class="label-input50">'+res.data+'</span>');
          setTimeout(function() {
            window.location.href = "/project/projects";
          }, 500);
        }else if (res.status == 'error') {
          $('#hiddenProjectRes').show();
          $('#hiddenProjectRes').html('<span class="label-input50">'+res.data+'</span>');
          setTimeout(function() {
            window.location.href = "/project/projects";
          }, 500);
        }
      }
    });
  });



/*##################Project Functions ###############*/

$('#addPOBtn').on('click', function (e) {
    
    $('#activDiv').hide();
    $('#poNumId').val("");
    $('#startDateId').val("");
    $('#endDateId').val("");
    $('#poNumId').prop('readonly', false);
    $('#projectNameId').attr('readonly', false);
    // $('#projectNameId').attr("readonly",true);
    $('#projectNameId').empty();
    $('#projectNameId').val("");
    $('#ActionId').val("add");

    e.preventDefault();
    $.ajax({
      type: 'post',
      url: '/project/getAllProjects',
      data: null,
      success: function (res) {
          // console.log(res);
          if (res.status == 'success') {
            // $('#projectNameId').append('<option value=null >----- Select Project -----</option>');
            for (var i=1; i<=  Object.keys(res.data).length ; i++) {
             $('#projectNameId').append('<option value="'+ res.data[i] +'" >'+res.data[i]+'</option>');
            }

          }
        // else if (res.status == 'error') {
        //   $('#hidPoRes').show();
        //   $('#hidPoRes').html('<span class="label-input50">'+res.data+'</span>');
        //   setTimeout(function() {
        //     window.location.href = "/project/purchaseorder";
        //   }, 500);
        // }
      }
    });

  });

$('#addPOForm').on('submit', function (e) {    
    e.preventDefault();
    $.ajax({
      type: 'post',
      url: '/project/addNewPO',
      data: $('#addPOForm').serialize(),
      success: function (res) {
        // console.log(res);
        if (res.status == 'success') {
          $('#hidPoRes').show();
          $('#hidPoRes').html('<span class="label-input50">'+res.data+'</span>');
          setTimeout(function() {
            window.location.href = "/project/purchaseorder";
          }, 500);
        }else if (res.status == 'error') {
          $('#hidPoRes').show();
          $('#hidPoRes').html('<span class="label-input50">'+res.data+'</span>');
          setTimeout(function() {
            window.location.href = "/project/purchaseorder";
          }, 500);
        }
      }
    });
  });


  /* This the On Document Ready Functioins Bracket*/  
});
/* This the On Document Ready Functioins Bracket*/  
  
