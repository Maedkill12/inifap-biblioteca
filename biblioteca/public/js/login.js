const loginBtn = document.getElementById("login");

loginBtn.addEventListener("click", login);

function login(e) {
  e.preventDefault();
  const apiKey = document.getElementById("password").value;

  if (!apiKey) {
    // Change this later to a error message
    alert("Password incorrecto");
    return;
  }

  const params = {
    API_KEY: apiKey,
  };

  const xhr = new XMLHttpRequest();

  xhr.open("POST", `${API_BASE}/admin/login`, true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onload = function () {
    if (this.status === 200) {
      const response = JSON.parse(this.responseText);
      if (response.status === "success") {
        window.location.href = URL_BASE + "/admin";
      } else {
        // Change this later to a error message
        alert("Password incorrecto");
      }
    } else {
      // Change this later to a error message
      alert("Password incorrecto");
    }
  };
  xhr.send(JSON.stringify(params));
}
