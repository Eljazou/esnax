// daily_screenshot.js
const puppeteer = require('puppeteer');
const fs = require('fs');
const path = require('path');

(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();

  // Replace with the URL of your "tableau de bord" page
  await page.goto('http://your-cakephp-url/tableau_de_bord', { waitUntil: 'networkidle2' });

  // Take a screenshot
  const screenshotPath = path.resolve(__dirname, 'webroot/img/daily_report.png');
  await page.screenshot({ path: screenshotPath, fullPage: true });

  await browser.close();
})();
