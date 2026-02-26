(function () {
  "use strict";

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }

  function init() {
    const map = document.querySelector(".map");
    const svg = document.querySelector("svg.map-svg");
    const regions = document.querySelectorAll("path[data-title]");

    // Функция для показа тултипа для конкретного path
    function showTooltipForPath(region) {
      if (!region) return;

      // Удаляем предыдущий тултип, если был
      if (activeTooltip.element) {
        activeTooltip.element.remove();
        activeTooltip.element = null;
      }

      // Создаем новый тултип
      const tooltip = createTooltipElement(region);
      tooltipContainer.appendChild(tooltip);

      const center = getElementCenter(region);
      if (center) {
        tooltip.style.left = center.x + "px";
        tooltip.style.top = center.y + "px";

        // Сохраняем в активные
        activeTooltip.region = region;
        activeTooltip.element = tooltip;

        // Показываем с анимацией
        requestAnimationFrame(() => {
          tooltip.style.opacity = "1";
        });
      }
    }

    // Функция установки подсказки по-умолчанию
    function setDefaultActivePath() {
      const defaultActivePath = document.querySelector(
        "path.path_is-active-default",
      );
      if (defaultActivePath) {
        // Небольшая задержка для гарантии, что DOM полностью готов
        setTimeout(() => {
          showTooltipForPath(defaultActivePath);
        }, 100);
      }
    }
    setDefaultActivePath();

    // Создаем контейнер для подсказок
    let tooltipContainer = document.getElementById("map-tooltips");
    if (!tooltipContainer) {
      tooltipContainer = document.createElement("div");
      tooltipContainer.id = "map-tooltips";
      tooltipContainer.style.cssText = `
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 10;
      `;
      map.appendChild(tooltipContainer);
    }

    // Хранилище активных подсказок
    let activeTooltip = {
      region: null,
      element: null,
      timeout: null,
    };

    // Функция для получения центра SVG элемента
    function getElementCenter(element) {
      try {
        const bbox = element.getBBox();
        const svg = element.ownerSVGElement;
        const point = svg.createSVGPoint();
        point.x = bbox.x + bbox.width / 2;
        point.y = bbox.y + bbox.height / 2;
        const ctm = element.getScreenCTM();
        return point.matrixTransform(ctm);
      } catch (error) {
        return null;
      }
    }

    // Функция для создания HTML блока
    function createTooltipElement(region) {
      const title = region.getAttribute("data-title");

      const tooltip = document.createElement("div");
      tooltip.className = "map__tooltip";

      tooltip.innerHTML = `
        <span class="button is-size-l is-no-hover map-tooltip__label">${title}</span>
        <div class="button is-size-l is-style-accent">
          <span class="icon" data-type="truck"></span>
					<span class="label">Заказать</span>
        </div>
      `;

      // Добавляем обработчики для самого тултипа
      tooltip.addEventListener("mouseenter", () => {
        // Отменяем запланированное удаление
        if (activeTooltip.timeout) {
          clearTimeout(activeTooltip.timeout);
          activeTooltip.timeout = null;
        }
      });

      tooltip.addEventListener("mouseleave", () => {
        // Планируем удаление тултипа
        scheduleTooltipRemoval(region);
      });

      // Обработчик для кнопки заказа
      const orderButton = tooltip.querySelector(".is-style-accent");
      if (orderButton) {
        orderButton.addEventListener("click", (e) => {
          e.stopPropagation();
          // Здесь можно добавить свою логику заказа
        });
      }

      return tooltip;
    }

    // Функция для планирования удаления тултипа
    function scheduleTooltipRemoval(region) {
      // Если это не активный регион, ничего не делаем
      if (activeTooltip.region !== region) return;

      // Отменяем предыдущий таймаут
      if (activeTooltip.timeout) {
        clearTimeout(activeTooltip.timeout);
      }

      // Создаем новый таймаут
      activeTooltip.timeout = setTimeout(() => {
        removeActiveTooltip();
      }, 100); // Небольшая задержка для перемещения мыши между регионом и тултипом
    }

    // Функция удаления активного тултипа
    function removeActiveTooltip() {
      // Отменяем запланированное снятие подсветки для активного региона
      if (activeTooltip.region && activeTooltip.region._unhighlightTimeout) {
        clearTimeout(activeTooltip.region._unhighlightTimeout);
        activeTooltip.region._unhighlightTimeout = null;
      }

      if (activeTooltip.element) {
        activeTooltip.element.remove();
        activeTooltip.region = null;
        activeTooltip.element = null;
      }
      if (activeTooltip.timeout) {
        clearTimeout(activeTooltip.timeout);
        activeTooltip.timeout = null;
      }
    }

    // Функция обновления позиции тултипа
    function updateTooltipPosition() {
      if (activeTooltip.region && activeTooltip.element) {
        const center = getElementCenter(activeTooltip.region);
        if (center) {
          activeTooltip.element.style.left = center.x + "px";
          activeTooltip.element.style.top = center.y + "px";
        }
      }
    }

    // Обработчик mouseenter для региона
    function handleMouseEnter(event) {
      const region = event.currentTarget;
      const title = region.getAttribute("data-title");

      // Если это тот же регион, отменяем удаление
      if (activeTooltip.region === region) {
        if (activeTooltip.timeout) {
          clearTimeout(activeTooltip.timeout);
          activeTooltip.timeout = null;
        }
        return;
      }

      // Удаляем предыдущий тултип, если был
      removeActiveTooltip();

      // Создаем новый тултип
      const tooltip = createTooltipElement(region);
      tooltipContainer.appendChild(tooltip);

      const center = getElementCenter(region);
      if (center) {
        tooltip.style.left = center.x + "px";
        tooltip.style.top = center.y + "px";

        // Сохраняем в активные
        activeTooltip.region = region;
        activeTooltip.element = tooltip;

        // Показываем с анимацией
        requestAnimationFrame(() => {
          tooltip.style.opacity = "1";
        });
      }
    }

    // Обработчик mouseleave для региона
    function handleMouseLeave(event) {
      const region = event.currentTarget;
      const title = region.getAttribute("data-title");

      // Планируем удаление тултипа
      scheduleTooltipRemoval(region);
    }

    // Добавляем обработчики для всех регионов
    regions.forEach((region, index) => {
      region.removeAttribute("title");
      region.addEventListener("mouseenter", handleMouseEnter);
      region.addEventListener("mouseleave", handleMouseLeave);
      region.style.cursor = "pointer";
    });

    // Обновление позиции при движении мыши над регионом
    svg.addEventListener("mousemove", (event) => {
      if (activeTooltip.region && activeTooltip.element) {
        // Проверяем, находится ли мышь над активным регионом
        const target = event.target;
        if (
          target === activeTooltip.region ||
          target.closest("path") === activeTooltip.region
        ) {
          updateTooltipPosition();
        }
      }
    });

    map.addEventListener("mouseleave", () => {
      setDefaultActivePath();
    });

    // Обработчики для окна
    window.addEventListener("resize", () => {
      clearTimeout(window.resizeTimer);
      window.resizeTimer = setTimeout(updateTooltipPosition, 100);
    });

    window.addEventListener("scroll", updateTooltipPosition, { passive: true });
  }
})();
