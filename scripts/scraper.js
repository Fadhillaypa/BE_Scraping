const puppeteer = require('puppeteer');

async function scrapeData(url) {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.goto(url, { waitUntil: 'networkidle2' });

    // Mengambil data dari halaman
    const data = await page.evaluate(() => {
        const produkUrl = document.querySelector('div.bl-thumbnail__slider a') ? document.querySelector('div.bl-thumbnail__slider a').href : '';
        const produkName = document.querySelector('.product-name') ? document.querySelector('.product-name').textContent : '';
        const produkPrice = document.querySelector('.product-price') ? document.querySelector('.product-price').textContent : '';
        const produkRating = document.querySelector('.product-rating') ? document.querySelector('.product-rating').textContent : '';

        return { produkUrl, produkName, produkPrice, produkRating };
    });

    await browser.close();
    return JSON.stringify(data); // Mengembalikan data sebagai string JSON
}

// Menangani URL yang diberikan sebagai parameter
const url = process.argv[2]; // URL dari command line argument
scrapeData(url).then(data => {
    console.log(data); // Mencetak data hasil scraping ke console
});
