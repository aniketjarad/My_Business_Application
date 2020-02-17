  $(document).ready(function(){
// console.log(BASE_URL+"/home/"+"====>"+window.location);
// if(window.location == this){




//################### Home Dashboard Page Charts ###################

// ################### All Certificate Chart ###################
  $.ajax({
    type: 'get',
    url: '/home/getModulesChart',
    data:'',
    success: function (res) {
      // console.log(res);
      if (res) {
        //   var colors = [];
        //   var border_colors = [];

        //   function dynamicColors () {
        //           var r = Math.floor(Math.random() * 255);
        //           var g = Math.floor(Math.random() * 255);
        //           var b = Math.floor(Math.random() * 255);
        //           return "rgba(" + r + "," + g + "," + b;
        //       };
        //     function color_generate (){
              
        //       for(i in res.certiModLabels){
        //         color = dynamicColors();
        //         background = color+",0.8)";
        //         border = color+",1)";
        //         colors.push(background);
        //         border_colors.push(border);
        //         }
        //       };

        // color_generate();
        
        var ctx = document.getElementById("allBarChartHome"); 
              var data = new Chart(ctx, { 
                type: 'bar', 
                data: { 
                  labels: res.certiModLabels, 
                  datasets: [ 
                    { label: res.certiModLabels, 
                      data: res.certiModCount, 
                      backgroundColor: "rgb(253,252,242,1)" ,

                      borderColor: 'rgb(244,17,158)',
                
               
              borderWidth : 2 
                    } 
                  ] 
                }, 
                options: { 
                      scales: { 
                          xAxes: [{
                              barPercentage: 0.5
                          }],
                          yAxes: [{ 
                              ticks: { 
                                  beginAtZero:true 
                              } 
                          }] 
                      } 
                  } 
              }); 
          

      }else if (res.status == 'error') {
        // console.log("Error");
        // $('#hide').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
      }
    }
  });

  // ################### All SkillSet Chart ###################
  $.ajax({
    type: 'get',
    url: '/home/getAllSkillSetChart',
    data:'',
    success: function (res) {
      // console.log(res);
      if (res) {
                
        var ctx = document.getElementById("allSkillSetsChart"); 
              var data = new Chart(ctx, { 
                type: 'doughnut', 
                data: { 
                  labels: res.certiModLabels, 
                  datasets: [ 
                    { label: "Skill Sets", 
                      data: res.certiModCount, 
                      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                
               
              borderWidth : 2 
                    } 
                  ] 
                }
              
              }); 
          

      }else if (res.status == 'error') {
        // console.log("Error");
        // $('#hide').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
      }
    }
  });
  // ################### All Expertise Chart ###################
  $.ajax({
    type: 'get',
    url: '/home/getAllExpertiseChart',
    data:'',
    success: function (res) {
      // console.log(res);
      if (res) {
                
        var ctx = document.getElementById("allExpertiseChart"); 
              var data = new Chart(ctx, { 
                type: 'doughnut', 
                data: { 
                  labels: res.certiModLabels, 
                  datasets: [ 
                    { label: "Skill Sets", 
                      data: res.certiModCount, 
                      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                
               
              borderWidth : 2 
                    } 
                  ] 
                }
              
              }); 
          

      }else if (res.status == 'error') {
        // console.log("Error");
        // $('#hide').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
      }
    }
  });
  
//################### RPA Page Charts ###################

// ################### RPA Certificate Chart ###################
 $.ajax({
    type: 'get',
    url: '/home/getRPACertificateChart',
    data:'',
    success: function (res) {
      // console.log(res);
      if (res) {
        
        var ctx = document.getElementById("rpaCertificateBarChart"); 
              var data = new Chart(ctx, { 
                type: 'bar', 
                data: { 
                  labels: res.certiModLabels, 
                  datasets: [ 
                    { label: res.certiModLabels, 
                      data: res.certiModCount, 
                      backgroundColor: "rgb(253,252,242,1)" ,

                      borderColor: 'rgb(244,17,158)',                
               
              borderWidth : 2 
                    } 
                  ] 
                }, 
                options: { 
                      scales: { 
                          xAxes: [{
                              barPercentage: 0.5
                          }],
                          yAxes: [{ 
                              ticks: { 
                                  beginAtZero:true 
                              } 
                          }] 
                      } 
                  } 
              }); 
          

      }else if (res.status == 'error') {
        // console.log("Error");
        // $('#hide').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
      }
    }
  });

//################### Servicenow Page Charts ###################

// ################### Servicenow Certificate Chart ###################
  $.ajax({
    type: 'get',
    url: '/home/getServicenowCertificateChart',
    data:'',
    success: function (res) {
      // console.log(res);
      if (res) {
        
        var ctx = document.getElementById("servicenowCertificateBarChart"); 
              var data = new Chart(ctx, { 
                type: 'bar', 
                data: { 
                  labels: res.certiModLabels, 
                  datasets: [ 
                    { label: res.certiModLabels, 
                      data: res.certiModCount, 
                      backgroundColor: "rgb(253,252,242,1)" ,

                      borderColor: 'rgb(244,17,158)',
                
               
              borderWidth : 2 
                    } 
                  ] 
                }, 
                options: { 
                      scales: { 
                          xAxes: [{
                              barPercentage: 0.5
                          }],
                          yAxes: [{ 
                              ticks: { 
                                  beginAtZero:true 
                              } 
                          }] 
                      } 
                  } 
              }); 
          

      }else if (res.status == 'error') {
        // console.log("Error");
        // $('#hide').show();
        // $('#hide').html('<span class="label-input50">'+res.data+'</span>');
      }
    }
  });
  
  
  // }

});



