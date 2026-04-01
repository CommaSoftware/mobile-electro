const TargetBannerSlider = document.getElementById("target_banner_slider");
const TargetBannerSliderItems = document.querySelectorAll(
  "#target_banner_slider > div",
);

if (!!TargetBannerSlider && !!TargetBannerSliderItems) {
  const SLIDE_IN_TIMEOUT = 4500;

  function startSlider() {
    let slideIndex = 0;
    const totalSlides = TargetBannerSliderItems.length;

    // Функция сброса всех классов
    function resetAllSlides() {
      TargetBannerSliderItems.forEach((item) => {
        item.classList.remove("is-active", "is-shown");
      });
    }

    function showNextSlide() {
      // Сбрасываем все классы только если начинаем новый цикл
      if (slideIndex === 0) {
        resetAllSlides();
      }

      // Показываем текущий слайд как активный
      setTimeout(() => {
        TargetBannerSliderItems[slideIndex].classList.add("is-active");
      }, 1);

      // Добавляем is-shown ко всем предыдущим слайдам
      for (let i = 0; i < slideIndex; i++) {
        TargetBannerSliderItems[i].classList.add("is-shown");
      }

      // Через время показа делаем текущий слайд показанным
      setTimeout(() => {
        TargetBannerSliderItems[slideIndex].classList.remove("is-active");
        TargetBannerSliderItems[slideIndex].classList.add("is-shown");

        // Переходим к следующему слайду
        slideIndex = (slideIndex + 1) % totalSlides;

        // Запускаем следующий слайд с паузой
        showNextSlide();
      }, SLIDE_IN_TIMEOUT);
    }

    // Запускаем слайдер
    resetAllSlides();
    showNextSlide();
  }

  startSlider();
}
