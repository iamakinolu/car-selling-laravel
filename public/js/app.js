document.addEventListener("DOMContentLoaded", () => {
  const depthScene = document.querySelector("[data-depth-scene]");
  const prefersLessMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const finePointer = window.matchMedia("(hover: hover) and (pointer: fine)").matches;
  if (depthScene && !prefersLessMotion && finePointer) {
    let frame = 0;
    depthScene.addEventListener("pointermove", event => {
      if (frame) cancelAnimationFrame(frame);
      frame = requestAnimationFrame(() => {
        const bounds = depthScene.getBoundingClientRect();
        const x = (event.clientX - bounds.left) / bounds.width - .5;
        const y = (event.clientY - bounds.top) / bounds.height - .5;
        depthScene.style.setProperty("--scene-y", `${(x * 5).toFixed(2)}deg`);
        depthScene.style.setProperty("--scene-x", `${(-y * 4).toFixed(2)}deg`);
      });
    });
    depthScene.addEventListener("pointerleave", () => {
      if (frame) cancelAnimationFrame(frame);
      depthScene.style.setProperty("--scene-x", "0deg");
      depthScene.style.setProperty("--scene-y", "0deg");
    });
  }

  const revealItems = [...document.querySelectorAll(".home-page [data-reveal], .browse-page [data-reveal], .experience-page [data-reveal], .auth-experience [data-reveal]")];
  if (revealItems.length && !prefersLessMotion && "IntersectionObserver" in window) {
    revealItems.forEach(item => item.style.setProperty("--reveal-delay", `${item.dataset.revealDelay || 0}ms`));
    document.documentElement.classList.add("reveal-ready");
    const revealObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -35px 0px" });
    revealItems.forEach(item => revealObserver.observe(item));
  }

  const btnToggle = document.querySelector(".btn-navbar-toggle");
  const navbar = document.querySelector(".navbar");
  const setNavbarOpen = open => {
    document.body.classList.toggle("navbar-opened", open);
    if (btnToggle) {
      btnToggle.setAttribute("aria-expanded", String(open));
      btnToggle.setAttribute("aria-label", open ? "Close navigation" : "Open navigation");
    }
  };
  if (btnToggle) btnToggle.addEventListener("click", () => setNavbarOpen(!document.body.classList.contains("navbar-opened")));

  const menuHandler = document.querySelector(".navbar-menu-handler");
  if (menuHandler) menuHandler.addEventListener("click", () => {
    const menu = menuHandler.closest(".navbar-menu");
    if (menu) {
      const open = !menu.classList.contains("opened");
      menu.classList.toggle("opened", open);
      menuHandler.setAttribute("aria-expanded", String(open));
    }
  });
  if (navbar) {
    navbar.querySelectorAll(".navbar-panel a").forEach(link => link.addEventListener("click", () => setNavbarOpen(false)));
    document.addEventListener("click", event => {
      if (!navbar.contains(event.target)) {
        setNavbarOpen(false);
        const accountMenu = navbar.querySelector(".navbar-menu");
        const accountButton = navbar.querySelector(".navbar-menu-handler");
        if (accountMenu) accountMenu.classList.remove("opened");
        if (accountButton) accountButton.setAttribute("aria-expanded", "false");
      }
    });
    document.addEventListener("keydown", event => {
      if (event.key === "Escape") {
        setNavbarOpen(false);
        const accountMenu = navbar.querySelector(".navbar-menu");
        const accountButton = navbar.querySelector(".navbar-menu-handler");
        if (accountMenu) accountMenu.classList.remove("opened");
        if (accountButton) accountButton.setAttribute("aria-expanded", "false");
        btnToggle?.focus();
      }
    });
  }

  const fileInput = document.querySelector("#carFormImageUpload");
  const preview = document.querySelector("#imagePreviews");
  if (fileInput && preview) {
    const photoUpload = fileInput.closest(".car-photo-upload");
    const photoCount = document.querySelector("#carPhotoCount");
    let existingCount = Number(photoUpload?.dataset.existingCount || 0);
    const maxTotal = Number(photoUpload?.dataset.maxTotal || 10);
    if (photoCount) photoCount.textContent = `${existingCount} of ${maxTotal} photos currently on this listing.`;

    fileInput.addEventListener("change", e => {
      preview.innerHTML = "";
      const files = [...e.target.files];
      const overLimit = existingCount + files.length > maxTotal;
      fileInput.setCustomValidity(overLimit ? `A car can have up to ${maxTotal} photos. Remove some selected photos.` : "");
      if (photoCount) {
        photoCount.textContent = overLimit
          ? `Too many selected: ${existingCount + files.length} of ${maxTotal} photos after saving.`
          : `${existingCount + files.length} of ${maxTotal} photos after saving.`;
        photoCount.classList.toggle("text-error", overLimit);
      }
      files.forEach(file => {
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

    const csrfToken = document.querySelector('.listing-form input[name="_token"]')?.value;
    const photoFeedback = document.querySelector("#listingPhotoFeedback");
    document.querySelectorAll(".listing-photo-remove").forEach(button => {
      button.addEventListener("click", async () => {
        if (!window.confirm("Remove this photo from the listing?")) return;
        button.disabled = true;
        button.textContent = "…";
        try {
          const response = await fetch(button.dataset.deleteUrl, {
            method: "DELETE",
            headers: { "Accept": "application/json", "X-CSRF-TOKEN": csrfToken || "", "X-Requested-With": "XMLHttpRequest" }
          });
          if (!response.ok) throw new Error("Unable to remove this photo. Please try again.");
          const currentPhotos = button.closest(".listing-current-photos");
          button.closest(".listing-photo-thumb")?.remove();
          if (currentPhotos && !currentPhotos.querySelector(".listing-photo-thumb")) currentPhotos.remove();
          existingCount = Math.max(0, existingCount - 1);
          photoUpload.dataset.existingCount = String(existingCount);
          if (existingCount === 1 && currentPhotos) {
            const removeButton = currentPhotos.querySelector(".listing-photo-remove");
            const photoHint = currentPhotos.querySelector("strong span");
            if (photoHint) photoHint.textContent = "At least one photo must stay on this listing.";
            if (removeButton) {
              const protectedMark = document.createElement("span");
              protectedMark.className = "listing-photo-protected";
              protectedMark.title = "Every car listing needs at least one photo";
              protectedMark.setAttribute("aria-label", "Required photo");
              protectedMark.textContent = "✓";
              removeButton.replaceWith(protectedMark);
            }
          }
          const total = existingCount + fileInput.files.length;
          const overLimit = total > maxTotal;
          fileInput.setCustomValidity(overLimit ? `A car can have up to ${maxTotal} photos.` : "");
          if (photoCount) {
            photoCount.textContent = fileInput.files.length ? `${total} of ${maxTotal} photos after saving.` : `${existingCount} of ${maxTotal} photos currently on this listing.`;
            photoCount.classList.toggle("text-error", overLimit);
          }
          if (photoFeedback) {
            photoFeedback.classList.remove("text-error");
            photoFeedback.textContent = "Photo removed from the listing.";
          }
        } catch (error) {
          button.disabled = false;
          button.textContent = "×";
          if (photoFeedback) {
            photoFeedback.classList.add("text-error");
            photoFeedback.textContent = error.message;
          }
        }
      });
    });

    const listingForm = fileInput.closest("form");
    if (listingForm) {
      listingForm.addEventListener("submit", event => {
        if (existingCount + fileInput.files.length < 1) {
          event.preventDefault();
          fileInput.setCustomValidity("Upload at least one photo before saving this listing.");
          fileInput.reportValidity();
          if (photoFeedback) photoFeedback.textContent = "Add at least one photo before saving.";
        }
      });
    }
  }

  const activeImage = document.getElementById("activeImage");
  const activePhotoNumber = document.getElementById("activePhotoNumber");
  const thumbnails = [...document.querySelectorAll(".car-image-thumbnails [data-image-src]")];
  if (activeImage && thumbnails.length) {
    thumbnails.forEach(thumbnail => {
      thumbnail.addEventListener("click", () => {
        if (thumbnail.dataset.imageSrc === activeImage.src) return;
        activeImage.classList.remove("image-switching");
        requestAnimationFrame(() => activeImage.classList.add("image-switching"));
        activeImage.src = thumbnail.dataset.imageSrc;
        if (activePhotoNumber) activePhotoNumber.textContent = thumbnail.dataset.imageNumber;
        thumbnails.forEach(item => item.classList.remove("active-thumbnail"));
        thumbnail.classList.add("active-thumbnail");
      });
    });
  }
});
