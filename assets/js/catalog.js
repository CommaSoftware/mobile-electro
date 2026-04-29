document.addEventListener("DOMContentLoaded", () => {
  // DOM элементы
  const applyBtn = document.getElementById("apply-filters");
  const resetBtn = document.getElementById("reset-filters");
  const sortSelect = document.getElementById("sort-select");
  const rangeInputs = document.querySelectorAll(".range-input input");
  const rangePriceInputs = document.querySelectorAll(".range-price input");

  // Константы
  const DEFAULTS = { min: 20, max: 500 };

  // Получение параметров из URL
  const getUrlParams = () => ({
    min_power: new URLSearchParams(location.search).get("min_power"),
    max_power: new URLSearchParams(location.search).get("max_power"),
    sort: new URLSearchParams(location.search).get("sort"),
  });

  // Получение текущих значений ползунка
  const getRangeValues = () => ({
    min:
      rangeInputs.length === 2 ? parseInt(rangeInputs[0].value) : DEFAULTS.min,
    max:
      rangeInputs.length === 2 ? parseInt(rangeInputs[1].value) : DEFAULTS.max,
  });

  // Обновление UI ползунка (триггерим событие для кастомного скрипта)
  const triggerRangeUpdate = () => {
    if (rangeInputs.length === 2) {
      rangeInputs[0].dispatchEvent(new Event("input"));
      rangeInputs[1].dispatchEvent(new Event("input"));
    }
  };

  // Установка значений формы из URL
  const setFormValues = () => {
    const params = getUrlParams();

    if (rangeInputs.length === 2 && rangePriceInputs.length === 2) {
      if (params.min_power) {
        rangeInputs[0].value = rangePriceInputs[0].value = params.min_power;
      }
      if (params.max_power) {
        rangeInputs[1].value = rangePriceInputs[1].value = params.max_power;
      }
      triggerRangeUpdate();
    }

    if (sortSelect && params.sort) sortSelect.value = params.sort;
  };

  // Применение фильтров
  const applyFilters = () => {
    const { min, max } = getRangeValues();
    const sortValue = sortSelect?.value;
    const params = new URLSearchParams();

    if (min !== DEFAULTS.min || max !== DEFAULTS.max) {
      params.set("min_power", min);
      params.set("max_power", max);
    }

    if (sortValue && sortValue !== "default") params.set("sort", sortValue);

    params.delete("paged");
    const queryString = params.toString();
    location.href = location.pathname + (queryString ? "?" + queryString : "");
  };

  // Сброс фильтров
  const resetFilters = () => {
    if (location.search) {
      location.href = location.pathname;
      return;
    }

    if (rangeInputs.length === 2 && rangePriceInputs.length === 2) {
      rangeInputs[0].value = rangePriceInputs[0].value = DEFAULTS.min;
      rangeInputs[1].value = rangePriceInputs[1].value = DEFAULTS.max;
      triggerRangeUpdate();
    }

    if (sortSelect) sortSelect.value = "default";
  };

  // Обработчик сортировки
  const handleSortChange = () => {
    const params = new URLSearchParams(location.search);
    const sortValue = sortSelect.value;

    if (sortValue !== "default") params.set("sort", sortValue);
    else params.delete("sort");

    params.delete("paged");
    const queryString = params.toString();
    location.href = location.pathname + (queryString ? "?" + queryString : "");
  };

  // Обработчик Enter в числовых полях
  const handleEnterPress = (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      applyFilters();
    }
  };

  // Навешиваем обработчики событий
  if (applyBtn) applyBtn.addEventListener("click", applyFilters);
  if (resetBtn) resetBtn.addEventListener("click", resetFilters);
  if (sortSelect) sortSelect.addEventListener("change", handleSortChange);

  if (rangePriceInputs.length === 2) {
    rangePriceInputs.forEach((input) =>
      input.addEventListener("keypress", handleEnterPress),
    );
  }

  // Восстанавливаем значения формы
  setFormValues();
});
