const editForm = document.querySelector("#edit-form");

editForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const formData = new FormData(editForm);
  const categoria = formData.get("categoria");
  const id = formData.get("id");
  const urlPatch = `${API_BASE}/articulo/${categoria}/${id}`;

  if (!categoria || !id) {
    alert("Error al editar el artículo");
    return;
  }

  if (!formData.get("imagen") || formData.get("imagen").size === 0) {
    formData.delete("imagen");
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", urlPatch, true);
  //   xhr.setRequestHeader("Content-type", "application/json");
  xhr.onload = function () {
    if (this.status === 200) {
      //   console.log(this.responseText);
      //   return;

      const response = JSON.parse(this.responseText);

      if (response.status === "success") {
        alert("Artículo editado correctamente");
        // refresh the page
        window.location.reload();
        // window.location.href = URL_BASE + "/admin";
      } else {
        alert("Error al editar el artículo");
      }
    } else {
      alert("Error al editar el artículo");
    }
  };
  xhr.send(formData);
});
