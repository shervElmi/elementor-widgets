<?php
/**
 * InsiderException interface.
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

use Throwable;

/**
 * This is a "marker interface" to mark all the exception that come with this
 * plugin with this one interface.
 *
 * This allows you to not only catch individual exceptions, but also catch "all
 * exceptions from the this plugin".
 *
 * @since 1.0.0
 */
interface InsiderException extends Throwable {

}
