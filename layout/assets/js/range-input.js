const range = document.querySelector(".range-selected");
const rangeInput = document.querySelectorAll(".range-input input");
const rangePrice = document.querySelectorAll(".range-price input");

// Функция для получения глобальных значений из HTML
function getGlobalValues() {
  // Берем значения из первого ползунка (они одинаковые для всех)
  const globalMin = parseInt(rangeInput[0].min) || 20;
  const globalMax = parseInt(rangeInput[0].max) || 500;

  // Получаем step из первого ползунка
  const step = parseInt(rangeInput[0].step) || 10;

  // Минимальный диапазон можно сделать настраиваемым через data-атрибут
  // По умолчанию = 100 или 20% от диапазона
  const rangeMin =
    parseInt(document.querySelector(".range").dataset.minRange) ||
    Math.round((globalMax - globalMin) * 0.2) ||
    100;

  console.log("Global values:", { globalMin, globalMax, step, rangeMin });

  return { globalMin, globalMax, step, rangeMin };
}

// Функция валидации значений с поддержкой движения всего отрезка
function validateValues(minVal, maxVal, changedInput, isDragging = false) {
  // Получаем актуальные глобальные значения
  const { globalMin, globalMax, step, rangeMin } = getGlobalValues();

  console.log("Before validation:", {
    minVal,
    maxVal,
    changedInput,
    isDragging,
  });

  // 1. Сначала ограничиваем значения глобальными границами
  minVal = Math.max(globalMin, Math.min(globalMax, minVal));
  maxVal = Math.max(globalMin, Math.min(globalMax, maxVal));

  // 2. Округляем до ближайшего step
  minVal = Math.round(minVal / step) * step;
  maxVal = Math.round(maxVal / step) * step;

  // 3. Проверяем, что min не больше max
  if (minVal > maxVal) {
    if (changedInput === "min") {
      minVal = maxVal;
    } else {
      maxVal = minVal;
    }
  }

  // 4. Гарантируем минимальный диапазон
  if (maxVal - minVal < rangeMin) {
    if (minVal === globalMin) {
      // Если левый ползунок в минимуме, двигаем только правый
      maxVal = globalMin + rangeMin;
    } else if (maxVal === globalMax) {
      // Если правый ползунок в максимуме, двигаем только левый
      minVal = globalMax - rangeMin;
    } else if (changedInput === "min") {
      // Если двигали левый, пододвигаем правый
      maxVal = minVal + rangeMin;
    } else {
      // Если двигали правый, пододвигаем левый
      minVal = maxVal - rangeMin;
    }
  }

  // 5. Финальная проверка границ после всех корректировок
  minVal = Math.max(globalMin, Math.min(globalMax, minVal));
  maxVal = Math.max(globalMin, Math.min(globalMax, maxVal));

  // 6. Еще одна проверка минимального диапазона (на всякий случай)
  if (maxVal - minVal < rangeMin) {
    if (minVal === globalMin) {
      maxVal = globalMin + rangeMin;
    } else {
      minVal = globalMax - rangeMin;
    }
  }

  // 7. Финальное округление
  minVal = Math.round(minVal / step) * step;
  maxVal = Math.round(maxVal / step) * step;

  console.log("After validation:", { minVal, maxVal });

  return { minVal, maxVal };
}

// Функция для безопасного получения числового значения
function getNumericValue(value, defaultValue) {
  if (value === "" || value === "-" || isNaN(value)) {
    return defaultValue;
  }
  return parseInt(value);
}

// Функция обновления всех элементов интерфейса
function updateUI(minValue, maxValue) {
  const { globalMin, globalMax } = getGlobalValues();

  // Обновляем значения ползунков
  rangeInput[0].value = minValue;
  rangeInput[1].value = maxValue;

  // Обновляем числовые поля
  rangePrice[0].value = minValue;
  rangePrice[1].value = maxValue;

  // Обновляем выделенную область
  range.style.left =
    ((minValue - globalMin) / (globalMax - globalMin)) * 100 + "%";
  range.style.right =
    100 - ((maxValue - globalMin) / (globalMax - globalMin)) * 100 + "%";
}

// Функция инициализации компонента
function initRangeSlider() {
  const { globalMin, globalMax, step } = getGlobalValues();

  // Устанавливаем атрибуты для всех элементов
  rangeInput.forEach((input) => {
    input.min = globalMin;
    input.max = globalMax;
    input.step = step;
  });

  rangePrice.forEach((input) => {
    input.min = globalMin;
    input.max = globalMax;
    input.step = step;
  });

  // Устанавливаем начальные значения
  updateUI(globalMin, globalMax);
}

// Обработчик для ползунков (перетаскивание)
rangeInput.forEach((input, index) => {
  input.addEventListener("input", (e) => {
    let minRange = parseInt(rangeInput[0].value);
    let maxRange = parseInt(rangeInput[1].value);

    // Определяем, какой ползунок изменен по индексу
    const changedInput = index === 0 ? "min" : "max";

    // Передаем true для isDragging, чтобы включить специальную логику
    const validated = validateValues(minRange, maxRange, changedInput, true);

    updateUI(validated.minVal, validated.maxVal);
  });
});

// Обработчик для числовых полей (для кнопок вверх/вниз и стрелок)
rangePrice.forEach((input) => {
  input.addEventListener("input", (e) => {
    const { globalMin, globalMax } = getGlobalValues();

    let minPrice = getNumericValue(rangePrice[0].value, globalMin);
    let maxPrice = getNumericValue(rangePrice[1].value, globalMax);

    const changedInput = e.target.name;
    // Для числовых полей используем обычную логику (без перетаскивания)
    const validated = validateValues(minPrice, maxPrice, changedInput, false);

    updateUI(validated.minVal, validated.maxVal);
  });
});

// Обработчик для ввода с клавиатуры
rangePrice.forEach((input) => {
  input.addEventListener("keyup", (e) => {
    if (e.key === "ArrowUp" || e.key === "ArrowDown" || e.key === "Tab") {
      return;
    }

    if (e.target.value === "") {
      return;
    }

    const { globalMin, globalMax } = getGlobalValues();

    let minPrice = getNumericValue(rangePrice[0].value, globalMin);
    let maxPrice = getNumericValue(rangePrice[1].value, globalMax);

    const changedInput = e.target.name;
    const validated = validateValues(minPrice, maxPrice, changedInput, false);

    updateUI(validated.minVal, validated.maxVal);
  });
});

// Обработчик для потери фокуса
rangePrice.forEach((input) => {
  input.addEventListener("blur", (e) => {
    const { globalMin, globalMax } = getGlobalValues();

    let minPrice = getNumericValue(rangePrice[0].value, globalMin);
    let maxPrice = getNumericValue(rangePrice[1].value, globalMax);

    const changedInput = e.target.name;
    const validated = validateValues(minPrice, maxPrice, changedInput, false);

    updateUI(validated.minVal, validated.maxVal);
  });
});

// Инициализация компонента
initRangeSlider();
