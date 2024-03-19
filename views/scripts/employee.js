var table;

function init() {
    showForm(false);
    getList();

    $("#form_employee").on("submit", function (e) {
        saveAndUpdate(e);
    });
}

function clearForm() {
    $("#id_employee").val("");
    $("#name").val("");
    $("#last_name").val("");
    $("#document_employee").val("");
    $("#phone_employee").val("");
    $("#code_employee").val("");
}

function showForm(flag) {
    clearForm();
    if (flag) {
        $("#list_records").hide();
        $("#form_register_employee").show();
        $("#btn_saver_employee").prop("disabled", false);
        $("#btnAdd").hide();
    } else {
        $("#list_records").show();
        $("#form_register_employee").hide();
        $("#btnAdd").show();
    }
}

function cancelForm() {
    clearForm();
    showForm(false);
}

function getList() {
    table = $("#tb-list").DataTable({
        "processing": true,
        "serverSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../controller/employeeController.php?op=list',
            type: "GET",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "destroy": true,
        "lengthMenu": [10, 25, 50, 100],
        "order": [[0, "desc"]]
    });
}

function saveAndUpdate(e) {
    e.preventDefault();
    $("#btn_saver_employee").prop("disabled", true);
    var formData = new FormData($("#form_employee")[0]);

    $.ajax({
        url: "../controller/employeeController.php?op=SaveAndUpdate",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            bootbox.alert(data);
            showForm(false);
            table.ajax.reload();
        }
    });
}

function show(id_employee) {
    $.post("../controller/employeeController.php?op=show", { id_employee: id_employee },
        function (data, status) {
            data = JSON.parse(data);
            showForm(true);

            $("#name").val(data.name);
            $("#last_name").val(data.last_name);
            $("#document_employee").val(data.document_number);
            $("#phone_employee").val(data.phone);
            $("#code_employee").val(data.code);
            $("#id_employee").val(data.id);
        }
    );
}

function deactivate(id_employee) {
    bootbox.confirm("¿Estás seguro de desactivar este dato?", function (result) {
        if (result) {
            $.post("../controller/employeeController.php?op=deactivate", { id_employee: id_employee }, function (e) {
                bootbox.alert(e);
                table.ajax.reload();
            });
        }
    });
}

function activate(id_employee) {
    bootbox.confirm("¿Estás seguro de activar este dato?", function (result) {
        if (result) {
            $.post("../controller/employeeController.php?op=activate", { id_employee: id_employee }, function (e) {
                bootbox.alert(e);
                table.ajax.reload();
            });
        }
    });
}

init();
