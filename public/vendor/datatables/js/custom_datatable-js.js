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
        "scrollX": true
    });
    
    var certification_table = $('#certiTable').DataTable({
        fixedHeader: true,
        //colReorder: true,
        "order":[["2","asc"]],
        //"scrollX": true
    });

    
} );

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
