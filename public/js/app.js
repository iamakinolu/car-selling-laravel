document.addEventListener("DOMContentLoaded", () => {
  const btnToggle = document.querySelector(".btn-navbar-toggle");
  if (btnToggle) btnToggle.addEventListener("click", () => document.body.classList.toggle("navbar-opened"));

  const menuHandler = document.querySelector(".navbar-menu-handler");
  if (menuHandler) menuHandler.addEventListener("click", () => {
    const menu = menuHandler.closest(".navbar-menu");
    if (menu) menu.classList.toggle("opened");
  });

  const fileInput = document.querySelector("#carFormImageUpload");
  const preview = document.querySelector("#imagePreviews");
  if (fileInput && preview) {
    fileInput.addEventListener("change", e => {
      preview.innerHTML = "";
      [...e.target.files].forEach(file => {
        if (!file.type.startsWith("image/")) return;
        const reader = new FileReader();
        reader.onload = ev => {
          const img = document.createElement("img");
          img.src = ev.target.result;
          preview.appendChild(img);
        };
        reader.readAsDataURL(file);
      });
    });
  }

  const activeImage = document.getElementById("activeImage");
  const thumbnails = [...document.querySelectorAll(".car-image-thumbnails img")];
  if (activeImage && thumbnails.length) {
    thumbnails.forEach((thumbnail, index) => {
      thumbnail.addEventListener("click", () => {
        activeImage.src = thumbnail.src;
        thumbnails.forEach(t => t.classList.remove("active-thumbnail"));
        thumbnail.classList.add("active-thumbnail");
      });
    });
  }
});