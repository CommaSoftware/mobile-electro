const rentPriceTable = [
    [5000, 4200, 3700, 3000, 2800], //24 квт
    [5200, 4600, 4000, 3500, 3000], //30
    [6000, 5500, 4500, 4000, 3500], //50
    [6500, 6000, 5300, 4500, 3800], //60
    [7300, 6800, 6000, 5000, 4500], //80
    [8000, 7500, 7000, 6500, 5500], //100
    [10000, 9000, 8500, 7500, 6500], //160
    [15000, 12000, 10000, 8500, 7500], //200
    [16000, 13000, 11000, 9000, 8000], //220
    [18000, 17000, 14500, 13000, 11000], //250
    [20000, 18000, 15000, 13500, 12000]  //320
];

const powerMap = {
    24: 0,
    30: 1,
    50: 2,
    60: 3,
    80: 4,
    100: 5,
    160: 6,
    200: 7,
    220: 8,
    250: 9,
    320: 10
};

const rentPeriodMap = {
    '3': 0,
    '4-7': 1,
    '8-14': 2,
    '15-30': 3,
    '30+': 4
}

const availablePowers = Object.keys(powerMap).map(Number);

function findClosestPower(power) {
    return availablePowers.reduce((closest, current) => {
        return Math.abs(current - power) < Math.abs(closest - power) ? current : closest;
    });
}

function getPowerFromElement(element) {
    const text = element.innerText.trim();
    console.log(text);
    
    const match = text.match(/(\d+(?:\.\d+)?)\s*кВт/);
    return match ? parseFloat(match[1]) : null;
}

function getRentPrice(power, rentPeriod) {
    if (power === null || power === undefined || rentPeriod === null || rentPeriod === undefined) {
        console.warn('Неверные параметры: мощность или срок аренды не переданы');
        return null;
    }

    const closestPower = findClosestPower(power);
    
    const rowIndex = powerMap[closestPower];
    const colIndex = rentPeriodMap[rentPeriod];

    if (rowIndex === undefined || colIndex === undefined) {
        console.warn('Неверные параметры: мощность или срок аренды не найдены');
        return null;
    }

    if (!rentPriceTable[rowIndex] || rentPriceTable[rowIndex][colIndex] === undefined) {
        console.warn('Цена не найдена в таблице для указанных параметров');
        return null;
    }

    return rentPriceTable[rowIndex][colIndex];
}

function updatePrice() {
    const rentPeriodSelect = document.getElementById('rent-period');

    if (!rentPeriodSelect) {
        console.warn('Элемент rent-period не найден на странице');
        return;
    }


    const rentPeriod = rentPeriodSelect.value;
    
    if (!rentPeriod) {
        console.warn('Срок аренды не выбран');
        return;
    }


    const powerElement = document.querySelector('#base_power');
    
    if (!powerElement) {
        console.warn('Элемент с мощностью не найден');
        return;
    }


    const power = getPowerFromElement(powerElement);

    if (power === null) {
        console.warn('Мощность не найдена');
        return;
    }


    const price = getRentPrice(power, rentPeriod);

    if (price === null) {
        console.warn('Не удалось получить цену');
        return;
    }


    const priceElement = document.querySelector('.product-price-item__cost');
    
    if (!priceElement) {
        console.warn('Элемент для отображения цены не найден');
        return;
    }
    
    priceElement.textContent = `${price} ₽/сут.`;
}

function initProductPage() {
    const rentPeriodSelect = document.getElementById('rent-period');

    if (!rentPeriodSelect) {
        return;
    }

    
    rentPeriodSelect.addEventListener('change', updatePrice);

    if (rentPeriodSelect.value) {
        updatePrice();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    try {
        initProductPage();
    } catch (error) {
        console.error('Ошибка при инициализации скриптов:', error);
    }
});


//Функции для полного калькулятора (который отдельная html страница)

function getAddonPrice(buttonElement) {
    const priceText = buttonElement.textContent.trim();
    const match = priceText.match(/(\d+(?:\.\d+)?)\s*₽/);
    return match ? parseFloat(match[1]) : 0;
}

function isAddonActive(element) {
    if (!element) {
        return false;
    }


    const toggleButton = element.querySelector('.toggle-button')

    if (toggleButton) {
            const icon = toggleButton.querySelector('.icon');
            return icon && icon.dataset.type === 'minus';
        }
    return false;
}

function calculateAndDisplayRent() {
    const powerSelect = document.getElementById('power');
    const rentPeriodSelect = document.getElementById('rent-period');

    if (!powerSelect || !rentPeriodSelect) {
        console.warn('Элементы калькулятора не найдены');
        return;
    }


    const powerValue = powerSelect.value;
    const rentPeriod = rentPeriodSelect.value;

    if (!powerValue || !rentPeriod) {
        console.warn('Не выбраны мощность или срок аренды');
        return;
    }

    const power = parseInt(powerValue);

    const basePrice = getRentPrice(power, rentPeriod);

    if (basePrice === null) {
        return;
    }

    const addonElements = document.querySelectorAll('.calc-rent__option, .calc-rent__addon');
    let totalAddonsPrice = 0;

    if (addonElements && addonElements.length > 0) {
        addonElements.forEach(element => {
            const toggleButton = element.querySelector('.toggle-button');
            const priceButton = element.querySelector('.price-button');
            
            if (toggleButton && priceButton) {
                const isActive = isAddonActive(element);
                
                if (isActive) {
                    const price = getAddonPrice(priceButton);
                    totalAddonsPrice += price;
                }
            }
        });
    }

    const totalPrice = basePrice + totalAddonsPrice;

    const totalElement = document.querySelector('.calc-rent__footer h3');
    if (totalElement) {
        totalElement.textContent = `${totalPrice} ₽/сут.`;
    } else {
        console.warn('Элемент для отображения итоговой цены не найден');
    }
}

function toggleAddon(element) {
    if(!element) return;

    const toggleButton = element.querySelector('.toggle-button');
    if (!toggleButton) return;

    const icon = toggleButton.querySelector('.icon');
    if (!icon) return;

    toggleButton.classList.toggle('is-toggled');
    icon.dataset.type = icon.dataset.type === 'plus' ? 'minus' : 'plus';
    
    calculateAndDisplayRent();
}

function setupToggleButtons() {
    document.addEventListener('click', function(e) {
        const addonElement = e.target.closest('.calc-rent__option, .calc-rent__addon');
        if (!addonElement) return;
        
        toggleAddon(addonElement);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const powerSelect = document.getElementById('power');
    const rentPeriodSelect = document.getElementById('rent-period');

    if (!powerSelect || !rentPeriodSelect) {
        return;
    }

    powerSelect.addEventListener('change', calculateAndDisplayRent);
    rentPeriodSelect.addEventListener('change', calculateAndDisplayRent);

    setupToggleButtons();
});
