var table;

function init() {
    showForm(false);
    getList();

    $("#form_user").on("submit", function (e) {
        saveAndUpdate(e);
    });
}

function clearForm() {
    $("#name_user").val("");
    $("#last_name_user").val("");
    $("#email_user").val("");
    $("#username_user").val("");
    $("#password_user").val("");
    $("#image_user").val("");
    $("#image_shows").attr("src", "");
    $("#current_image").val("");
    $("#id_user").val("");
}

function showForm(flag) {
    clearForm();
    if (flag) {
        $("#list_records").hide();
        $("#form_register_user").show();
        $("#btn_saver_user").prop("disabled", false);
        $("#btnAdd").hide();
    } else {
        $("#list_records").show();
        $("#form_register_user").hide();
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
            url: '../controller/userController.php?op=list',
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
    $("#btn_saver_user").prop("disabled", true);
    var formData = new FormData($("#form_user")[0]);

    $.ajax({
        url: "../controller/userController.php?op=SaveAndUpdate",
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

function show(id_user) {
    $.post("../controller/userController.php?op=show", { id_user: id_user },
        function (data, status) {
            data = JSON.parse(data);
            showForm(true);

            $("#name").val(data.name);
            $("#last_name").val(data.last_name);
            $("#email_user").val(data.email);
            $("#username_user").val(data.username);
            $("#image_shows").attr("src", "../files/users/" + data.image);
            $("#current_image").val(data.image);
            $("#image_user").attr("src", "../files/users/" + data.image);
            $("#id_user").val(data.id);
        }
    );
}

function deactivate(id_user) {
    bootbox.confirm("¿Estás seguro de desactivar este dato?", function (result) {
        if (result) {
            $.post("../controller/userController.php?op=deactivate", { id_user: id_user }, function (e) {
                bootbox.alert(e);
                table.ajax.reload();
            });
        }
    });
}

function activate(id_user) {
    bootbox.confirm("¿Estás seguro de activar este dato?", function (result) {
        if (result) {
            $.post("../controller/userController.php?op=activate", { id_user: id_user }, function (e) {
                bootbox.alert(e);
                table.ajax.reload();
            });
        }
    });
}

init();
