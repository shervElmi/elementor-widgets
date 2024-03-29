<?php
/**
 * Plugin interface.
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
 * A plugin is basically nothing more than a convention on how manage the
 * lifecycle of a modular piece of code, so that you can:
 *  1. activate it,
 *  2. register it with the framework, and
 *  3. deactivate it again.
 *
 * This is what this interface represents, by assembling the separate,
 * segregated interfaces for each of these lifecycle actions.
 *
 * Additionally, we provide a means to get access to the plugin's container that
 * collects all the services it is made up of. This allows direct access to the
 * services to outside code if needed.
 *
 * @since 1.0.0
 */
interface Plugin extends Plugin_Activation, Plugin_Deactivation, Registerable {

	/**
	 * Get the service container that contains the services that make up the
	 * plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return Service_Container Service container of the plugin.
	 */
	public function get_container(): Service_Container;
}
