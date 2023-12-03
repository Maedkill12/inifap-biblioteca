const prevBtn = document.querySelector("#prev-btn");
const nextBtn = document.querySelector("#next-btn");
const searchBtn = document.querySelector("#lupe");
const loaderContainer = document.querySelector(".loader-container");

prevBtn.addEventListener("click", () => {
  const currentPage = getCurrentPage();
  const prevPage = Math.max(1, currentPage - 1);
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("page", prevPage);
  window.location.href = `${URL_BASE}/admin?${urlParams.toString()}`;
});

nextBtn.addEventListener("click", () => {
  const currentPage = getCurrentPage();
  const nextPage = currentPage + 1;
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("page", nextPage);
  window.location.href = `${URL_BASE}/admin?${urlParams.toString()}`;
});

searchBtn.addEventListener("click", () => {
  const search = document.querySelector("#search").value;
  window.location.href = `${URL_BASE}/admin?search=${search}`;
});

function getCurrentPage() {
  const urlParams = new URLSearchParams(window.location.search);
  const queryPage = urlParams.get("page");
  if (queryPage) {
    return +queryPage;
  } else {
    return 1;
  }
}

window.addEventListener("load", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const search = urlParams.get("search");
  if (search) {
    document.querySelector("#search").value = search;
  }
});

function onDelete(id, categoria) {
  console.log(id, categoria);
  Toastify({
    text: "Clic aquí para confirmar la eliminación del artículo",
    duration: 3000,
    close: true,
    gravity: "top", // `top` or `bottom`
    position: "center", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
      background: "linear-gradient(to right, #00b09b, #96c93d)",
    },
    onClick: function () {
      const urlDelete = `${API_BASE}/articulo/${categoria}/${id}`;
      const xhr = new XMLHttpRequest();
      xhr.open("DELETE", urlDelete, true);
      xhr.onload = function () {
        hideLoading();
        if (this.status === 200) {
          const response = JSON.parse(this.responseText);
          if (response.status === "success") {
            Toastify({
              text: "Artículo eliminado correctamente",
              duration: 3000,
              style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
              },
            }).showToast();
            window.location.reload();
          } else {
            Toastify({
              text: "Error al eliminar el artículo",
              duration: 3000,
              style: {
                background: "linear-gradient(to right, #ff5050, #cc0000)",
              },
            }).showToast();
          }
        } else {
          Toastify({
            text: "Error al eliminar el artículo",
            duration: 3000,
            style: {
              background: "linear-gradient(to right, #ff5050, #cc0000)",
            },
          }).showToast();
        }
      };
      displayLoading();
      xhr.send();
    },
  }).showToast();
}

const displayLoading = () => {
  loaderContainer.style.display = "flex";
};

const hideLoading = () => {
  loaderContainer.style.display = "none";
};
