  $(document).ready(function(){
// console.log(BASE_URL+"/home/"+"====>"+window.location);
// if(window.location == this){
  $.ajax({
    type: 'get',
    url: '/home/getModulesChart',
    data:'',
    success: function (res) {
      // console.log(res);
      if (res) {
          var colors = [];
          var border_colors = [];

          function dynamicColors () {
                  var r = Math.floor(Math.random() * 255);
                  var g = Math.floor(Math.random() * 255);
                  var b = Math.floor(Math.random() * 255);
                  return "rgba(" + r + "," + g + "," + b;
              };
            function color_generate (){
              
              for(i in res.certiModLabels){
                color = dynamicColors();
                background = color+",0.8)";
                border = color+",1)";
                colors.push(background);
                border_colors.push(border);
                }
              };

        color_generate();
        
        var ctx = document.getElementById("barChart"); 
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
                       // animation: {
                       //    onComplete: function() {
                       //      isChartRendered = true
                       //    }
                       //  },
                      scales: { 
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



