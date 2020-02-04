$(document).ready(function() {

	// Setup - add a text input to each footer cell
    $('#example thead tr').clone(true).appendTo('#example thead');
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" style="width:60px;text-align:center;" placeholder="Search"/>' );   
        $( 'input',this).on('keyup change', function () {
            if ( employee_table.column(i).search() !== this.value ) {
                employee_table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        });
    });

    /*var table = $('#example').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );*/

    var employee_table = $('#example').DataTable({
        //fixedHeader: true,
        //colReorder: true,
        "order":[["1","asc"]],
        dom: 'Bfrtip',
        buttons: [
            'copy','excel', 'pdf', 'print'
        ],
        "scrollX": true,
        "paging": false
    });

    $('#skillmatrix_table thead tr').clone(true).appendTo('#skillmatrix_table thead');
    $('#skillmatrix_table thead tr:eq(1) th').each( function (i) {
        var title_skill = $(this).text();
        $(this).html( '<input type="text" style="width:60px;text-align:center;" placeholder="Search"/>' );   
        $( 'input',this).on('keyup change', function () {
            if ( skill_table_ser.column(i).search() !== this.value ) {
                skill_table_ser
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        });
    });

    var skill_table = $('#skillmatrix_table').DataTable({
        //fixedHeader: true,
        //colReorder: true,
        "order":[["1","asc"]],
        dom: 'Bfrtip',
        buttons: [
            'copy','excel', 'pdf', 'print'
        ],
        "scrollX": true,
        "paging": false
    });
    

     


    var certification_table = $('#certiTable').DataTable({
        fixedHeader: false,
        //colReorder: true,
        "order":[["3","desc"]],
       "paging": false

        //"scrollX": true
    });

    
});

    function Update_Element(id) {

        $.ajax({
        type: 'post',
        url: '/employee/get',
        data: {"emp_code":id},
        success: function (res) {
            if (res) {
                $('#manager').html("");
                var length = Object.keys(res.managers).length;
                for (var i = 1; i <= length; i++) {
                    $('#manager').append('<option value="'+res.managers[i]+'">'+res.managers[i]+'</option>');
                }  
                $('#contact_no').val(res.contact_no);  
                $('#cost_center').val(res.cost_center);  
                $('#department').val(res.department);  
                $('#designation').val(res.designation);  
                $('#doj').val(res.doj);  
                $('#email_id').val(res.email_id);  
                $('#emea_id').val(res.emea_id);  
                $('#emp_code').val(res.emp_code);  
                $('#emp_name').val(res.emp_name);  
                $('#grade').val(res.grade);  
                $('#wiw_id').val(res.wiw_id);
                if(res.active=='1'){
                    $('#active').attr("checked",true);
                }else{
                    $('#active').attr("checked",false);
                }
                if(res.is_manager=='1'){
                    $('#is_manager').attr("checked",true);
                }else{
                    $('#is_manager').attr("checked",false);
                }

                $('#manager').val(res.manager).attr("selected",true);
            }
        }
      });


    }
//This is for the skill matrix delete and
    function Delete_Skill_Element(id) {
        // console.log("print" + id);
        if (confirm('Are you sure you want to delete this record?')) {
        $.ajax({
        type: 'post',
        url: '/employee/deleteSkill',
        data: {"emp_code":id},
        success: function (res) {
            // console.log(res);
            if (res.status == 'success') {
                // alert("Record Deleted Successfully.");
                // $('#hide_skillres').show();
                // $('#hide_skillres').html('<span class="label-input50">'+res.data+'</span>');
                // console.log("Success");
                setTimeout(function() {
                   // $('#hide_skillres').show();
                   //  $('#hide_skillres').html('<span class="label-input50"">'+res.data+'</span>');
                window.location.href = "/employee/skillmatrix";
                }, 500);
              }
            else if (res.status == 'error') {
                //  $('#hide_skillres').show();
                // $('#hide_skillres').html('<span class="label-input50"  style="color:#ff0000;">'+res.data+'</span>');
                 // console.log(res.response);
                setTimeout(function() {
                   // $('#hide_skillres').show();
                   //  $('#hide_skillres').html('<span class="label-input50" style="color:#ff0000;">'+res.data+'</span>');
                window.location.href = "/employee/skillmatrix";
                }, 500);
          }
        }
      });
    
    }
    }
     function Update_Skill_Element(id) {
        // console.log("asdas");
        // $("#updatePrimarySel").select2({
        //     tags: false,
        //     theme: "classic",
        //     allowClear: true
        // });
        // $("#updateSecondarySel").select2({
        //         tags: false,
        //         theme: "classic",
        //         allowClear: true
        // });
        $("#secskillcolapse").removeClass("show");
        $("#IdskillNameCustom").val("");
        $.ajax({
        type: 'post',
        url: '/employee/getEmpSkill',
        data: {"emp_code":id},
        success: function (res) {
            console.log(res);
            if (res) {                              
                $('#employee_Name').attr("readonly",true);
                $('#employee_Name').html('');
                $('#employee_Name').append('<option value='+ res.data.emp_code +'>'+ res.data.emp_name +'</option>')
                $('#mulipleselect_primary').html('');
                 for(var j = 0; j < res.selectedVal.primary_skill_sel.result.length; j++) {
                    if(res.selectedVal.primary_skill_sel.result[j].selected == false){
                      $('#mulipleselect_primary').append('<option name='+ res.selectedVal.primary_skill_sel.result[j].text +' >'+ res.selectedVal.primary_skill_sel.result[j].text +'</option>');
                    } 
                    else if(res.selectedVal.primary_skill_sel.result[j].selected == true){
                         $('#mulipleselect_primary').append('<option name='+ res.selectedVal.primary_skill_sel.result[j].text +' selected="selected" >'+ res.selectedVal.primary_skill_sel.result[j].text +'</option>');
                    }
                }
                $('#mulipleselect_secondary').html('');
                 for(var i = 0; i < res.selectedVal.secondary_skill_sel.result.length; i++) {
                    if(res.selectedVal.secondary_skill_sel.result[i].selected == false){
                      $('#mulipleselect_secondary').append('<option name='+ res.selectedVal.secondary_skill_sel.result[i].text +' >'+ res.selectedVal.secondary_skill_sel.result[i].text +'</option>');
                    } 
                    else if(res.selectedVal.secondary_skill_sel.result[i].selected == true){
                         $('#mulipleselect_secondary').append('<option name='+ res.selectedVal.secondary_skill_sel.result[i].text +' selected="selected" >'+ res.selectedVal.secondary_skill_sel.result[i].text +'</option>');
                    }
                }               
            }
        }
      });


    }

    /*Certification Actions delete
    */
    function deleteCertiElement(id) {
        
        var POST = id.split('|');
        // console.log(POST);
        if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                type: 'post',
                url: '/employee/deleteCertification',
                data: {POST},
                success: function (res) {
                    // console.log(res);
                    if (res.status = "success") {                              
                         setTimeout(function() {                      
                            window.location.href = "/employee/certification";
                            }, 500);

                        }
                      else{
                        console.log("There was some error in deleting the record.");

                        setTimeout(function() {                      
                            window.location.href = "/employee/certification";
                            }, 500);

                      }
                  }
              });

        }

    }
     function deleteCompEmp(id) {
        
        // var POST = id.split('|');
        // console.log(id);
        if (confirm('This will delete all the Certification Record of the Employee.')) {
                $.ajax({
                type: 'post',
                url: '/employee/deleteEmpCert',
                data: {'emp_code': id},
                success: function (res) {
                    // console.log(res);
                    if (res.status = "success") {                              
                         setTimeout(function() {                      
                            window.location.href = "/employee/certification";
                            }, 500);

                        }
                      else{
                        // console.log("There was some error in deleting the record.");

                        setTimeout(function() {                      
                            window.location.href = "/employee/certification";
                            }, 500);

                      }
                  }
              });

        }
        
    }