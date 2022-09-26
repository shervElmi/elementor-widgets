<?php
/**
 * Service_Container interface.
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

use Traversable;
use Insider\Elementor_Widgets\Exception\InvalidService;
use Countable;
use ArrayAccess;

/**
 * The service container collects all services to manage them.
 *
 * This is based on PSR-11 and should extend that one if Composer dependencies
 * are being used. Relying on a standardized interface like PSR-11 means you'll
 * be able to easily swap out the implementation for something else later on.
 *
 * @since 1.0.0
 *
 * @see https://www.php-fig.org/psr/psr-11/
 */
interface Service_Container extends Traversable, Countable, ArrayAccess {

	/**
	 * Find a service of the container by its identifier and return it.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Identifier of the service to look for.
	 *
	 * @throws InvalidService If the service could not be found.
	 *
	 * @return Service Service that was requested.
	 */
	public function get( string $id ): Service;

	/**
	 * Check whether the container can return a service for the given
	 * identifier.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Identifier of the service to look for.
	 *
	 * @return bool
	 */
	public function has( string $id ): bool;

	/**
	 * Put a service into the container for later retrieval.
	 *
	 * @since 1.0.0
	 *
	 * @param string  $id      Identifier of the service to put into the
	 *                         container.
	 * @param Service $service Service to put into the container.
	 */
	public function put( string $id, Service $service );
}
