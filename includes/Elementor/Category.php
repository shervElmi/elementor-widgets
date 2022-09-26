<?php
/**
 * Category class.
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

/**
 * Category class.
 *
 * @since 1.0.0
 */
final class Category implements Service, Registerable, Delayed {

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
	public function register() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
	}

	/**
	 * Add categories.
	 *
	 * @since 1.0.0
	 *
	 * @param \Elementor\Elements_Manager $elements_manager Elements manager instance.
	 *
	 * @return void
	 */
	public function register_categories( \Elementor\Elements_Manager $elements_manager ): void {
		$elements_manager->add_category(
			'insider',
			[
				'title' => __( 'Insider', 'insider-elementor-widgets' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}
}
