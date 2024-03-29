<?php
/**
 * Renderable interface.
 *
 * @package   Insider/Elementor_Widgets
 * @license   MIT
 * @link      https://www.mwpd.io/
 * @copyright 2019 Alain Schlesser
 */

/**
 * Original code modified for this project.
 *
 * @copyright 2022 Insider Inc.
 * @license   GNU General Public License 3.0
 */

namespace Insider\Elementor_Widgets\Infrastructure;

/**
 * Something that can be rendered.
 *
 * This can be used for views, obviously, but could just as well be used for
 * other concepts like blocks or shortcodes, value objects, ...
 *
 * @since 1.0.0
 */
interface Renderable {

	/**
	 * Render the renderable.
	 *
	 * @since 1.0.0
	 *
	 * @param array $context Optional. Contextual information to use while
	 *                       rendering. Defaults to an empty array.
	 * @return string Rendered result.
	 */
	public function render( array $context = [] ): string;
}
