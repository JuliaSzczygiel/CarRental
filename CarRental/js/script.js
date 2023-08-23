var update_modal = document.getElementById("update");
var spanEdit = document.getElementById("spanEdit");
spanEdit.onclick = function () {
  update_modal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == update_modal) {
    update_modal.style.display = "none";
  };
};

$(document).on("click", "#addBtn", function () {
  $("#mainBtn").removeClass("editBtn");
  $("#mainBtn").addClass("add");
  $('#update').show();
  $("#brandUpd").val("");
  $("#modelUpd").val("");
  $("#vintageUpd").val("");
  $("#typeUpd").val("");
  $("#colorUpd").val("");
  $("#hpUpd").val("");
  $('.title').html('Dodaj auto');

$(document).on("click", ".add", function () {
  let brand = $("#brandUpd").val();
  let model = $("#modelUpd").val();
  let vintage = $("#vintageUpd").val();
  let type = $("#typeUpd").val();
  let color = $("#colorUpd").val();
  let hp = $("#hpUpd").val();
    $.ajax({
      url: "functions/insert.php",
      method: "POST",
      data: {
        brand: brand,
        model: model,
        vintage: vintage,
        type: type,
        color: color,
        hp: hp
      },
      success: function () {
        location.reload();
      },
    });
});
});

$(document).on("click", "#delete", function ()
{
  var id = $(this).attr("data-id");
  $.ajax({
    url: "functions/delete.php",
    method: "POST",
    data: {id: id},
    success: function () {
      alert ("Rekord został pomyślnie usunięty z bazy!")
      window.location.href = "index.php";
    },
  });
});

$(document).on("click", "#edit", function () {
  $('.title').html('Edytuj dane');
  let id = $(this).attr("data-id");
  $("#mainBtn").removeClass("add");
  $("#mainBtn").addClass("editBtn");
  $("#update").show();
  $.ajax({
    url: "functions/fetch_one.php",
    method: "POST",
    data: { id: id },
    dataType: "json",
    success: function (data) {
      console.log(data);
      $("#id").val(data.id);
      $("#brandUpd").val(data.brand);
      $("#modelUpd").val(data.model);
      $("#vintageUpd").val(data.vintage);
      $("#typeUpd").val(data.type);
      $("#colorUpd").val(data.color);
      $("#hpUpd").val(data.hp);
    },
  });
});

$(document).on("click", ".editBtn", function () {
  let id = $("#id").val();
  let brand = $("#brandUpd").val();
  let model = $("#modelUpd").val();
  let vintage = $("#vintageUpd").val();
  let type = $("#typeUpd").val();
  let color = $("#colorUpd").val();
  let hp = $("#hpUpd").val();
    $.ajax({
      url: "functions/update.php",
      method: "POST",
      data: {
        id: id,
        brand: brand,
        model: model,
        vintage: vintage,
        type: type,
        color: color,
        hp: hp
      },
      success: function () {
        location.reload();
      },
    });
});

