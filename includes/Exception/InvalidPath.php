<?php
/**
 * InvalidPath final class.
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
 * InvalidPath final class.
 *
 * @since 1.0.0
 */
final class InvalidPath
	extends InvalidArgumentException
	implements InsiderException {

	/**
	 * Create a new instance of the exception for a file that is not accessible
	 * or not readable.
	 *
	 * @since 1.0.0
	 *
	 * @param string $path Path of the file that is not accessible or not
	 *                     readable.
	 * @return static
	 */
	public static function from_path( $path ) {
		$message = \sprintf(
			'The view path "%s" is not accessible or readable.',
			$path
		);

		return new static( $message );
	}
}
