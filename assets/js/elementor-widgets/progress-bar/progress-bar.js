/**
 * External dependencies
 */
import CircleProgress from 'js-circle-progress';

/**
 * Internal dependencies
 */
import registerWidget from '../../utils/registerWidget';

class inewProgressBar extends elementorModules.frontend.handlers.Base {
	circleProgress;

	getDefaultSettings() {
		return {
			selectors: {
				progressBarWrapper: '.insider-progress-bar',
				circleProgress: '.insider-circle-progress',
			},
		};
	}

	getDefaultElements() {
		const element = this.$element.get(0);
		const selectors = this.getSettings('selectors');

		return {
			progressBarWrapper: element.querySelector(
				selectors.progressBarWrapper
			),
			circleProgress: element.querySelector(selectors.circleProgress),
		};
	}

	onInit(...args) {
		super.onInit(...args);
		this.observer();
	}

	register() {
		const { progressBarWrapper, circleProgress } = this.elements;

		if (!progressBarWrapper) {
			return;
		}

		// eslint-disable-next-line camelcase
		const { percent, start_angle, animation_speed } =
			this.getElementSettings();

		const circleProgressInstance = new CircleProgress(circleProgress, {
			value: percent.size ?? 78,
			// eslint-disable-next-line camelcase
			startAngle: start_angle.size ?? 0,
			// eslint-disable-next-line camelcase
			animationDuration: animation_speed ?? 2000,
			textFormat: 'percent',
			max: 100,
		});

		this.circleProgress = circleProgressInstance;
	}

	observer() {
		const observer = new IntersectionObserver(
			this.observerCallback.bind(this),
			{
				threshold: 1,
			}
		);

		observer.observe(this.elements.circleProgress);
	}

	observerCallback(entries, observer) {
		const entry = entries[0];

		if (!entry.isIntersecting) {
			return;
		}

		this.register();

		observer.unobserve(entry.target);
	}
}

document.addEventListener('DOMContentLoaded', () => {
	registerWidget(inewProgressBar, 'insider-progress-bar');
});
