const prevBtn = document.querySelector("#prev-btn");
const nextBtn = document.querySelector("#next-btn");
const searchBtn = document.querySelector("#lupe");

// Filters
const filterBtn = document.querySelector("#filtro");
const techBtn = document.querySelector("#tech-btn");
const scientificBtn = document.querySelector("#scientific-btn");
const allBtn = document.querySelector("#all-btn");

filterBtn.addEventListener("click", () => {
  const dropwdown = document.querySelector("#dropdown");
  dropwdown.classList.toggle("active");
});

techBtn.addEventListener("click", () => {
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("type", "tecnico");
  window.location.href = `${URL_BASE}/?${urlParams.toString()}`;
});

scientificBtn.addEventListener("click", () => {
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("type", "cientifico");
  window.location.href = `${URL_BASE}/?${urlParams.toString()}`;
});

allBtn.addEventListener("click", () => {
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("type", "todos");
  window.location.href = `${URL_BASE}/?${urlParams.toString()}`;
});

// END Filters

prevBtn.addEventListener("click", () => {
  const currentPage = getCurrentPage();
  const prevPage = Math.max(1, currentPage - 1);
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("page", prevPage);
  window.location.href = `${URL_BASE}/?${urlParams.toString()}`;
});

nextBtn.addEventListener("click", () => {
  const currentPage = getCurrentPage();
  const nextPage = currentPage + 1;
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("page", nextPage);
  window.location.href = `${URL_BASE}/?${urlParams.toString()}`;
});

searchBtn.addEventListener("click", () => {
  const search = document.querySelector("#search").value;
  window.location.href = `${URL_BASE}/?search=${search}`;
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
