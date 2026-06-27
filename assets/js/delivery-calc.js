const deliveryPriceTable = [
    [15000, 25000, 40000], //Москва
    [15000, 25000, 40000], //107
    [15000, 25000, 40000], //108
    [20000, 30000, 50000], //За 108
    [10000, 10000, 10000], //Чехов
    [15000, 25000, 40000], //Тула и север
    [25000, 37000, 60000], //Юг
    [15000, 25000, 40000], //Калуга
    [25000, 37000, 60000], //Калуга обл
    [25000, 40000, 60000], //Тверь
    [30000, 45000, 65000], //Тверь обл
    [25000, 40000, 60000], //Владимир
    [30000, 45000, 65000], //Владимир обл
    [20000, 30000, 50000], //Рязань
    [25000, 40000, 60000], //Рязань обл
    [25000, 37000, 60000], //Ржев
    [25000, 37000, 60000], //Вязьма
    [35000, 45000, 60000], //Орел
    [35000, 50000, 65000], //Орел обл
    [35000, 45000, 60000], //Брянск
    [40000, 50000, 65000], //Брянск обл
    [35000, 45000, 55000], //Смоленск
    [35000, 50000, 60000], //Смоленск обл
    [35000, 50000, 60000], //Ярославль
    [40000, 50000, 65000], //Ярославль обл
    [35000, 50000, 60000], //Кострома
    [45000, 60000, 75000], //Кострома обл
    [35000, 50000, 60000], //Иваново
    [35000, 50000, 60000], //Иваново обл
    [35000, 45000, 60000], //Липецк
    [35000, 50000, 60000], //Липецк обл
    [40000, 50000, 60000], //Воронеж
    [45000, 60000, 70000], //Воронеж обл
    [35000, 45000, 60000], //Курск
    [40000, 50000, 65000], //Курск об
    [40000, 55000, 65000], //Белгород
    [40000, 55000, 70000], //Белгород обл
    [45000, 60000, 75000], //Пенза
    [45000, 60000, 75000], //Пенза обл
    [45000, 60000, 75000], //Саранск
    [45000, 60000, 75000], //Саранск обл
    [35000, 55000, 65000], //Нижний Новгород
    [40000, 65000, 70000], //Нижний Новгород обл
    [35000, 50000, 65000], //Вологда
    [45000, 60000, 75000], //Вологда обл
    [40000, 60000, 70000], //Великий Новгород
    [40000, 60000, 70000], //Великий Новгород обл
    [40000, 60000, 75000], //Псков
    [40000, 60000, 75000], //Псков обл
    [50000, 65000, 80000], //Самара
    [50000, 65000, 80000], //Самара обл
    [50000, 65000, 80000], //Саратов
    [50000, 65000, 80000], //Саратов обл
    [45000, 65000, 80000], //Ростов-на-Дону
    [45000, 65000, 80000], //Волгоград
    [35000, 45000, 60000], //Тамбов
    [35000, 45000, 60000], //Тамбов область
];

const cityMap = {
    'moscow': 0,
    'oblast-107': 1,
    'oblast-108': 2,
    'beyond-108': 3,
    'chekhov': 4,
    'tula-north': 5,
    'oblast-south': 6,
    'kaluga': 7,
    'kaluga-oblast': 8,
    'tver': 9,
    'tver-oblast': 10,
    'vladimir': 11,
    'vladimir-oblast': 12,
    'ryazan': 13,
    'ryazan-oblast': 14,
    'rzhev': 15,
    'vyazma': 16,
    'orel': 17,
    'orel-oblast': 18,
    'bryansk': 19,
    'bryansk-oblast': 20,
    'smolensk': 21,
    'smolensk-oblast': 22,
    'yaroslavl': 23,
    'yaroslavl-oblast': 24,
    'kostroma': 25,
    'kostroma-oblast': 26,
    'ivanovo': 27,
    'ivanovo-oblast': 28,
    'lipetsk': 29,
    'lipetsk-oblast': 30,
    'voronezh': 31,
    'voronezh-oblast': 32,
    'kursk': 33,
    'kursk-oblast': 34,
    'belgorod': 35,
    'belgorod-oblast': 36,
    'penza': 37,
    'penza-oblast': 38,
    'saransk': 39,
    'saransk-oblast': 40,
    'n-novgorod': 41,
    'n-novgorod-oblast': 42,
    'vologda': 43,
    'vologda-oblast': 44,
    'v-novgorod': 45,
    'v-novgorod-oblast': 46,
    'pskov': 47,
    'pskov-oblast': 48,
    'samara': 49,
    'samara-oblast': 50,
    'saratov': 51,
    'saratov-oblast': 52,
    'rostov-na-donu': 53,
    'volgograd': 54,
    'tambov': 55,
    'tambov-oblast': 56
};

const transportMap = {
    'car': 0,
    'truck': 1,
    'crane-truck': 2
};

const citySelect = document.getElementById('city');
const transportSelect = document.getElementById('transport');
const priceElement = document.querySelector('.calc-delivery__footer h3');

function updatePrice() {
    const cityValue = citySelect.value;
    const transportValue = transportSelect.value;
    
    const cityIndex = cityMap[cityValue];
    const transportIndex = transportMap[transportValue];
    
    if (cityIndex !== undefined && transportIndex !== undefined) {
        const price = deliveryPriceTable[cityIndex][transportIndex];
        priceElement.textContent = price + ' ₽';
    }
}

if (!!citySelect && !!transportSelect && !!priceElement) {
    citySelect.addEventListener('change', updatePrice);
    transportSelect.addEventListener('change', updatePrice);
    updatePrice();
}
