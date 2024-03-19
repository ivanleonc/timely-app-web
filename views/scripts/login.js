$("#frmAcceso").on("submit", function (e) {
  e.preventDefault();

  logina = $("#logina").val();

  clavea = $("#clavea").val();

  if ($("#logina").val() == "" || $("#clavea").val() == "") {
    bootbox.alert("Asegúrate de llenar todo los campos");
  } else {
    $.post(
      "../controller/userController.php?op=verify",

      { logina: logina, clavea: clavea },

      function (data) {
        console.log(data);

        if (data != "null") {
          $(location).attr("href", "dashboard.php");
        } else {
          bootbox.alert("Usuario y/o Password incorrectos");
        }
      }
    );
  }
});
