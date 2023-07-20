let username_input = document.getElementById("username"),
  email_input = document.getElementById("email"),
  password_input = document.getElementById("password"),
  confirm_password_input = document.getElementById("confirm_password"),
  alert_box = document.getElementById("danger-alert"),
  form = document.querySelector("form");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  let username = username_input.value,
    email = email_input.value,
    password = password_input.value,
    confirm_password = confirm_password_input.value;

  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let request_response = JSON.parse(this.responseText);

      if (request_response.status == "success") {
        window.location.replace("index.php?action=login");
      } else {
        alert_box.innerText = request_response.message;
        alert_box.classList.remove("d-none");
      }
    }
  };

  xhr.open("POST", "index.php?action=register");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(`username=${username}&email=${email}&password=${password}&confirm_password=${confirm_password}`);
});
