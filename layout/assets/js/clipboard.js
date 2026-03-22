/**
 * Обработчики для mailto и tel ссылок
 */

async function copyToClipboard(text) {
  try {
    await navigator.clipboard.writeText(text);
    return true;
  } catch (error) {
    console.error("Ошибка копирования:", error);
    return false;
  }
}

function extractContactFromLink(href) {
  if (!href || typeof href !== "string") return null;

  if (href.startsWith("tel:")) {
    let phone = href.substring(4);

    phone = decodeURIComponent(phone);

    return {
      type: "tel",
      value: phone,
      raw: href,
    };
  }

  if (href.startsWith("mailto:")) {
    let email = href.substring(7);
    if (email.includes("?")) {
      email = email.split("?")[0];
    }

    email = decodeURIComponent(email);

    return {
      value: email,
      type: "mailto",
      raw: href,
    };
  }

  return null;
}

const ContactLinks = document.querySelectorAll(
  'a[href^="tel:"], a[href^="mailto:"]',
);

if (!!ContactLinks) {
  ContactLinks.forEach((Link) => {
    Link.addEventListener("click", (e) => {
      e.preventDefault();
      const HREF = Link.getAttribute("href");

      // Код перед переходом по ссылке
      const LINK_DATA = extractContactFromLink(HREF);

      res = copyToClipboard(LINK_DATA.value);
      if (!!res) {
        showPopup(`Скопировано: ${LINK_DATA.value}`, 1500);
      }

      // Отложенный переход н мобильных устройствах
      if (window.innerWidth <= 780)
        setTimeout(() => {
          // Возобновление перехода по ссылке
          window.location.href = Link.href;
        }, 1);
    });
  });
}
