const categorySelect = document.querySelector("#categoria");
const uploadForm = document.querySelector("#upload-form");

categorySelect.addEventListener("change", (e) => {
  const category = e.target.value;
  switch (category) {
    case "tecnico": {
      const publicacionot = document.querySelector("#publicacionot");
      publicacionot.parentElement.remove();

      const mensaje = document.querySelector("#mensaje").parentElement;
      mensaje.insertAdjacentElement("afterend", createImagen());
      // document.querySelector("#upload-form").insertBefore(createImagen(), imagen);
      break;
    }
    case "cientifico": {
      const imagen = document.querySelector("#imagen");
      imagen.parentElement.remove();

      const mensaje = document.querySelector("#mensaje").parentElement;
      mensaje.insertAdjacentElement("afterend", createPublicacionOT());
      break;
    }
  }
});

uploadForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const formData = new FormData(uploadForm);
  const categoria = formData.get("categoria");
  const urlPost = `${API_BASE}/articulo/${categoria}`;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", urlPost, true);
  //   xhr.setRequestHeader("Content-type", "application/json");
  xhr.onload = function () {
    if (this.status === 201) {
      //   console.log(this.responseText);
      //   return;
      // console.log(this.responseText);
      const response = JSON.parse(this.responseText);
      console.log(response);
      if (response.status === "success") {
        alert("Artículo creado correctamente");
        // refresh the page
        window.location.reload();
        // window.location.href = URL_BASE + "/admin";
      } else {
        console.log(this.status, this.responseText);
        alert("Error al crear el artículo");
      }
    } else {
      console.log(this.status, this.responseText);
      alert("Error al crear el artículo");
    }
  };
  xhr.send(formData);
});

function createPublicacionOT() {
  const publicacionot = document.createElement("div");
  publicacionot.classList.add("input-control");
  publicacionot.innerHTML = `
    <label for="publicacionot">Publicación</label>
    <input type="text" id="publicacionot" name="publicacionot" >
    `;
  return publicacionot;
}

function createImagen() {
  const imagen = document.createElement("div");
  imagen.classList.add("input-control");
  imagen.innerHTML = `
        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg, image/jpg" required>
        `;
  return imagen;
}
