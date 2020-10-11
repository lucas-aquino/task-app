$(document).ready(() => {
  console.log("jQuery funciona");

  let editar = false;

  $("#task-result").hide();
  fetchTask();

  $("#buscar").keyup(() => {
    if ($("#buscar").val()) {
      let busqueda = $("#buscar").val();

      $.ajax({
        url: "task-search.php",
        type: "POST",
        data: { busqueda },
        success: (response) => {
          let dTasks = JSON.parse(response);
          let template = "";
          dTasks.forEach((dTask) => {
            template += `
              <li>${dTask.nombre}</li>
            `;
          });

          $("#container").html(template);
          $("#task-result").show();
        },
      });
    }
  });

  $("#taskForm").submit((e) => {
    const D_POST = {
      id: $("#taskID").val(),
      nombre: $("#nombre").val(),
      descripcion: $("#descripcion").val(),
    };

    let url = editar === false ? "task-add.php" : "task-edit.php";

    $.post(url, D_POST, (response) => {
      fetchTask();
      $("#taskForm").trigger("reset");
      console.log(response);
    });

    e.preventDefault();
  });

  function fetchTask() {
    $.ajax({
      url: "task-list.php",
      type: "GET",
      success: (response) => {
        let dTasks = JSON.parse(response);
        let template = "";
        dTasks.forEach((task) => {
          template += `
            <tr taskID="${task.id}">
              <td >${task.id}</td>
              <td>
                <a href="#" class="task-item">${task.nombre}</a>
              </td>
              <td>${task.descripcion}</td>
              <td>
                <button class="task-delete btn btn-danger btn-sm">
                  Borrar
                </button>
              </td>
            </tr>
          `;
        });
        $("#tareas").html(template);
      },
    });
  }

  $(document).on("click", ".task-delete", function () {
    if (confirm("Quieres eliminarlo?")) {
      let element = $(this)[0].parentElement.parentElement;
      let id = $(element).attr("taskID");
      $.post("task-delete.php", { id }, (response) => {
        fetchTask();
        console.log(response);
      });
    }
  });

  $(document).on("click", ".task-item", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskID");
    $.post("task-update.php", { id }, (response) => {
      const dTask = JSON.parse(response);
      $("#taskID").val(dTask.id);
      $("#nombre").val(dTask.nombre);
      $("#descripcion").val(dTask.descripcion);
      editar = true;
    });
  });
});
