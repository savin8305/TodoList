let form = document.querySelector("form");
let username = document.getElementById("username");
let password = document.getElementById("password");
let danger_alert = document.getElementById("danger-alert");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  let username_value = username.value;
  let password_value = password.value;

  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let responseData = JSON.parse(xhr.responseText);

      if (responseData.stat == "error") {
        danger_alert.innerText = responseData.message;
        danger_alert.classList.add("d-block");
        danger_alert.classList.remove("d-none");
      } else {
        danger_alert.classList.add("d-none");
        window.location.replace("index.php?action=afficher");
      }
    }
  };

  xhr.open("POST", "index.php?action=authentification", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(`username=${username_value}&password=${password_value}`);
});
