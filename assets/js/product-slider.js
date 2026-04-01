document.querySelectorAll(".product-slider-item").forEach((item) => {
  item.addEventListener("click", function () {
    document
      .querySelectorAll(".product-slider-item")
      .forEach((el) => el.classList.remove("is-active"));
    this.classList.add("is-active");
  });
});
