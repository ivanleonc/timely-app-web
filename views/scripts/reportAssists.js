var table;

function init(){
    getList();
    $.post("../controller/employeeController.php?op=select_employee", function(r){
        $("#id_employee").html(r);
        $("#id_employee").selectpicker('refresh');
    });
}

function getList() {
    var date_start = $("#date_start").val();
    var date_end = $("#date_end").val();
    var employee_id = $("#id_employee").val();
    console.log(employee_id);
    table = $("#tb-list").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": 
        {
            url: '../controller/assistsController.php?op=list_assist',
            data: {date_start: date_start, date_end: date_end, employee_id: employee_id},
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    }).DataTable();
}
init();