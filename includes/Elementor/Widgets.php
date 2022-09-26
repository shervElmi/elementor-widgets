<?php
/**
 * Widgets class.
 *
 * @package   Insider/Elementor_Widgets
 * @copyright 2022 Insider Inc.
 * @license   GNU General Public License 3.0
 * @link      https://useinsider.com/
 */

/*
 * Copyright (C) 2022 Insider Inc.
 *
 * Licensed under GNU GPL, Version 3.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * ADDITIONAL TERMS per GNU GPL Section 7 The origin of the Program
 * must not be misrepresented; you must not claim that you wrote
 * the original Program. Altered source versions must be plainly marked
 * as such, and must not be misrepresented as being the original Program.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Insider\Elementor_Widgets\Elementor;

use Insider\Elementor_Widgets\Infrastructure\{Service, Registerable, Delayed};
use Insider\Elementor_Widgets\Assets;

/**
 * Widget class.
 *
 * @since 1.0.0
 */
class Widgets implements Service, Registerable, Delayed {

	/**
	 * List of widgets.
	 *
	 * The widgets array contains a map of <identifier> => <widget class name>
	 * associations.
	 *
	 * @var array<string>
	 */
	const WIDGETS = [
		'insider-progress-bar' => Widgets\ProgressBar::class,
	];

	/**
	 * Assets instance.
	 *
	 * @var Assets Assets instance.
	 */
	protected $assets;

	/**
	 * Widgets constructor.
	 *
	 * @since 1.8.0
	 *
	 * @param Assets  $assets  Assets instance.
	 */
	public function __construct( Assets $assets ) {
		$this->assets = $assets;
	}

	/**
	 * Get the action to use for registering the service.
	 *
	 * @since 1.0.0
	 *
	 * @return string  Registration action to use.
	 */
	public static function get_registration_action(): string {
		return 'elementor/init';
	}

	/**
	 * Get the action priority to use for registering the service.
	 *
	 * @since 1.0.0
	 *
	 * @return int Registration action priority to use.
	 */
	public static function get_registration_action_priority(): int {
		return 10;
	}

	/**
	 * Register the service.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register(): void {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Register widgets frontend styles and scripts.
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );
	}

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_widgets(): void {
		foreach ( self::WIDGETS as $widget_class ) {
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget_class() );
		}
	}

	/**
	 * Register widgets frontend styles.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_styles(): void {
		$this->assets->register_style_asset( 'insider-styles' );
	}

	/**
	 * Register widgets frontend scripts.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_scripts(): void {
		$this->assets->register_script_asset( 'insider-progress-bar', [ 'elementor-frontend' ] );
	}
}
