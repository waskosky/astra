const { loadPage } = require("axe-puppeteer");
const formatAxeResults = require("../inc/axe-utils");

const puppeteer = require('puppeteer')

const { bs, util, fetch, localStorage } = require("../lib/bootstrap")
devices = require("puppeteer/DeviceDescriptors");

jest.setTimeout(50000);

// util.cleanupScreenshotsDir();

describe("theme accessibility", () => {
	it("header should have no violations", async () => {
        const browser = await puppeteer.launch()
		const axeBuilder = await loadPage(browser, process.env.ASTRA_TESTS_URL);
		// Only test a section of the page.
		axeBuilder.include(".site-header");
		const results = await axeBuilder.analyze();
		const formattedResults = formatAxeResults(results);
		expect(formattedResults).toHaveLength(0);
	});

	it("site content should have no violations", async () => {
        const browser = await puppeteer.launch()
		const axeBuilder = await loadPage(browser, process.env.ASTRA_TESTS_URL);
		// Only test a section of the page.
		const results = await axeBuilder.analyze();
		const formattedResults = formatAxeResults(results);
		expect(formattedResults).toHaveLength(0);
	});

	it("a single page should have no violations", async () => {
        const browser = await puppeteer.launch()
		const axeBuilder = await loadPage(
			browser,
			`${process.env.ASTRA_TESTS_URL}/?page_id=2`
		);
		const results = await axeBuilder.analyze();
		// Excluding site-header, checked earlier.
		axeBuilder.exclude(".site-header");
		const formattedResults = formatAxeResults(results);
		expect(formattedResults).toHaveLength(0);
	});
});
