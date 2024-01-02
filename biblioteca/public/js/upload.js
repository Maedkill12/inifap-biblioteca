const categorySelect = document.querySelector("#categoria");
const uploadForm = document.querySelector("#upload-form");
const loaderContainer = document.querySelector(".loader-container");

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

  // check if the fields are filled
  if (categoria === "") {
    Toastify({
      text: "Debe seleccionar una categoría",

      duration: 3000,
      style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
      },
    }).showToast();
    return;
  }

  if (formData.get("publicacion") === "") {
    Toastify({
      text: "Debe ingresar un título",

      duration: 3000,
      style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
      },
    }).showToast();
    return;
  }

  if (formData.get("muestra") === "") {
    Toastify({
      text: "Debe ingresar una muestra",

      duration: 3000,
      style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
      },
    }).showToast();
    return;
  }

  if (formData.get("cuenta") === "") {
    Toastify({
      text: "Debe ingresar una cuenta",

      duration: 3000,
      style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
      },
    }).showToast();
    return;
  }

  if (formData.get("pdf") === "") {
    Toastify({
      text: "Debe ingresar un pdf",

      duration: 3000,
      style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
      },
    }).showToast();
    return;
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", urlPost, true);
  xhr.onload = function () {
    hideLoading();
    if (this.status === 201) {
      const response = JSON.parse(this.responseText);
      console.log(response);
      if (response.status === "success") {
        Toastify({
          text: "Artículo creado correctamente",

          duration: 3000,
          style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
          },
        }).showToast();
        window.location.reload();
      } else {
        console.log(this.status, this.responseText);
        Toastify({
          text: "Error al crear el artículo",

          duration: 3000,
          style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
          },
        }).showToast();
      }
    } else {
      console.log(this.status, this.responseText);
      Toastify({
        text: "Error al crear el artículo",

        duration: 3000,
        style: {
          background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
      }).showToast();
    }
  };
  displayLoading();
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

const displayLoading = () => {
  loaderContainer.style.display = "flex";
};

const hideLoading = () => {
  loaderContainer.style.display = "none";
};
