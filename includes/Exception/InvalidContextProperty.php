<?php
/**
 * InvalidContextProperty final class.
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

namespace Insider\Elementor_Widgets\Exception;

use InvalidArgumentException;

/**
 * InvalidContextProperty final class.
 *
 * @since 1.0.0
 */
final class InvalidContextProperty
	extends InvalidArgumentException
	implements InsiderException {

	/**
	 * Create a new instance of the exception for a context property that is
	 * not recognized.
	 *
	 * @since 1.0.0
	 *
	 * @param string $property Name of the context property that was not
	 *                         recognized.
	 * @return static
	 */
	public static function from_property( string $property ) {
		$message = \sprintf(
			'The property "%s" could not be found within the context of the currently rendered view.',
			$property
		);

		return new static( $message );
	}
}
