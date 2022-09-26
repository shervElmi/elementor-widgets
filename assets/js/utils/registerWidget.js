const registerWidget = (className, widgetName, skin = 'default') => {
	if (!(className || widgetName)) {
		return;
	}

	window.addEventListener('elementor/frontend/init', () => {
		const addHandler = ($element) => {
			elementorFrontend.elementsHandler.addHandler(className, {
				$element,
			});
		};

		elementorFrontend.hooks.addAction(
			`frontend/element_ready/${widgetName}.${skin}`,
			addHandler
		);
	});
};
export default registerWidget;
