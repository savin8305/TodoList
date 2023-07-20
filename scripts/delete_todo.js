import { include_table, table_body, alert_box } from "./update_todo.js";

let confirm_delete_btn = document.getElementById("confirm_delete");

addEventListener("click", function (e) {
  if (e.target.hasAttribute("data-action") && e.target.getAttribute("data-action") == "delete") {
    // Remove Todo Only When Confirming On Delete Modal
    confirm_delete_btn.addEventListener("click", function () {
      let todo_id = e.target.getAttribute("data-todo-id");

      let xhr = new XMLHttpRequest();

      xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == "success") {
            alert_box.innerText = "Todo Has Been Deleted Successfully!!!";
            alert_box.classList.remove("d-none");

            table_body.innerHTML = include_table();
          }
        }
      };

      xhr.open("POST", "index.php");
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(`action=supprimer&id=${todo_id}`);
    });
  }
});
