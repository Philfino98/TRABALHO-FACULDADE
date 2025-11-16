window.addEventListener("load", () => {
  document.body.classList.add("loaded");
});

window.onload = () => {
  if (window.location.hash) {
    window.scrollTo(0, 0);
    history.replaceState(null, "", window.location.pathname);
  }
};

document.querySelector(".botao-topo button").addEventListener("click", () => {
  document.getElementById("topo").scrollIntoView({ behavior: "smooth" });
});

document.querySelector(".botao-baixo button").addEventListener("click", () => {
  document.getElementById("baixo").scrollIntoView({ behavior: "smooth" });
});

