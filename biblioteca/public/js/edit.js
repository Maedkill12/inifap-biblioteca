const editForm = document.querySelector("#edit-form");
const loaderContainer = document.querySelector(".loader-container");

editForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const formData = new FormData(editForm);
  const categoria = formData.get("categoria");
  const id = formData.get("id");
  const urlPatch = `${API_BASE}/articulo/${categoria}/${id}`;

  if (!categoria || !id) {
    Toastify({
      text: "Error al editar el artículo",

      duration: 3000,
      style: {
        background: "linear-gradient(to right, #ff5050, #cc0000)",
      },
    }).showToast();
    return;
  }

  if (!formData.get("imagen") || formData.get("imagen").size === 0) {
    formData.delete("imagen");
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", urlPatch, true);
  xhr.onload = function () {
    hideLoading();
    if (this.status === 200) {
      const response = JSON.parse(this.responseText);

      if (response.status === "success") {
        Toastify({
          text: "Artículo editado correctamente",

          duration: 3000,
          style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
          },
        }).showToast();
        // window.location.reload();
      } else {
        Toastify({
          text: "Error al editar el artículo",

          duration: 3000,
          style: {
            background: "linear-gradient(to right, #ff5050, #cc0000)",
          },
        }).showToast();
      }
    } else {
      Toastify({
        text: "Error al editar el artículo",

        duration: 3000,
        style: {
          background: "linear-gradient(to right, #ff5050, #cc0000)",
        },
      }).showToast();
    }
  };
  displayLoading();
  xhr.send(formData);
});

const displayLoading = () => {
  loaderContainer.style.display = "flex";
};

const hideLoading = () => {
  loaderContainer.style.display = "none";
};
