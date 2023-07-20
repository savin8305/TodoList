// Updating Variables
let modal_textArea = document.querySelector("textarea"),
  input_id = document.getElementById("todo_form_id"),
  form_update = document.getElementById("form_update"),
  alert_box = document.getElementById("alert"),
  table = document.querySelector("table"),
  table_body = document.querySelector("tbody"),
  modal_feedback = document.getElementById("modal-alert"),
  submit_update = document.getElementById("submit_update");

// Get The Data Of Each Todo When Clicking On Update

addEventListener("click", function (e) {
  if (e.target.hasAttribute("data-action") && e.target.getAttribute("data-action") == "update") {
    let todo_id = e.target.getAttribute("data-todo-id");
    let todo_content = e.target.parentElement.parentElement.firstElementChild.innerText;

    modal_textArea.value = todo_content;
    input_id = todo_id;

    // Remove The Ability Of Dismissing The Update Modal By Default Until Validation Checking
    if (submit_update.hasAttribute("data-bs-dismiss")) {
      submit_update.removeAttribute("data-bs-dismiss");
    }
  }
});

// Submit Changes On Modal Form
form_update.addEventListener("submit", function (e) {
  e.preventDefault();

  let new_todo = modal_textArea.value;

  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (this.status == 200 && this.readyState == 4) {
      let update_response = this.responseText;
      if (update_response == "GOOD") {
        // Show Positive Feedback When Inserting Valid Todo
        alert_box.innerText = "Todo Has Been Updated Successfully!!!";
        alert_box.classList.remove("d-none");

        // Update The Table Content Only Using XMLHttpRequest
        table_body.innerHTML = include_table();
        console.log(include_table());

        // Add The Functionality To Dismiss The Update Modal To This Button On Success And Simulate Click
        submit_update.setAttribute("data-bs-dismiss", "modal");
        submit_update.dispatchEvent(new Event("click"));
      } else {
        modal_feedback.classList.remove("d-none");
        modal_feedback.innerText = xhr.responseText;
      }
    }
  };

  xhr.open("POST", "index.php?action=update");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(`todo=${new_todo}&todo_id=${input_id}`);
});

function include_table() {
  let request_table_body = new XMLHttpRequest();
  let table_Response = null;

  request_table_body.onreadystatechange = function () {
    if (this.status == 200 && this.readyState == 4) {
      table_Response = this.responseText;
    }
  };

  request_table_body.open("GET", "views/includes/table_content.php", false);
  request_table_body.send();

  return table_Response;
}

export { include_table, table_body, alert_box };
