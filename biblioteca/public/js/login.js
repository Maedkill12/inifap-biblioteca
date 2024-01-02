const loginBtn = document.getElementById("login");
const loaderContainer = document.querySelector(".loader-container");

loginBtn.addEventListener("click", login);

function login(e) {
  e.preventDefault();
  const apiKey = document.getElementById("password").value;

  if (!apiKey) {
    Toastify({
      text: "Contraseña incorrecta",

      duration: 3000,
      style: {
        background: "linear-gradient(to right, #ff5050, #cc0000)",
      },
    }).showToast();
    return;
  }

  const params = {
    API_KEY: apiKey,
  };

  const xhr = new XMLHttpRequest();

  xhr.open("POST", `${API_BASE}/admin/login`, true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.onload = function () {
    hideLoading();
    if (this.status === 200) {
      const response = JSON.parse(this.responseText);
      if (response.status === "success") {
        window.location.href = URL_BASE + "/admin";
      } else {
        Toastify({
          text: "Contraseña incorrecta",

          duration: 3000,
          style: {
            background: "linear-gradient(to right, #ff5050, #cc0000)",
          },
        }).showToast();
      }
    } else {
      Toastify({
        text: "Contraseña incorrecta",

        duration: 3000,
        style: {
          background: "linear-gradient(to right, #ff5050, #cc0000)",
        },
      }).showToast();
    }
  };
  displayLoading();
  xhr.send(JSON.stringify(params));
}

const displayLoading = () => {
  loaderContainer.style.display = "flex";
};

const hideLoading = () => {
  loaderContainer.style.display = "none";
};
