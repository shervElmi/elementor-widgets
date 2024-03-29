<?php
/**
 * Lazily_Instantiated_Service final class.
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

namespace Insider\Elementor_Widgets\Infrastructure\Service_Container;

use Insider\Elementor_Widgets\Infrastructure\Service;
use Insider\Elementor_Widgets\Exception\InvalidService;

/**
 * A service that only gets properly instantiated when it is actually being
 * retrieved from the container.
 *
 * @since 1.0.0
 */
final class Lazily_Instantiated_Service implements Service {

	/** @var callable */
	private $instantiation;

	/**
	 * Instantiate a Lazily_Instantiated_Service object.
	 *
	 * @since 1.0.0
	 *
	 * @param callable $instantiation Instantiation callable to use.
	 */
	public function __construct( callable $instantiation ) {
		$this->instantiation = $instantiation;
	}

	/**
	 * Do the actual service instantiation and return the real service.
	 *
	 * @since 1.0.0
	 *
	 * @throws InvalidService If the service could not be properly instantiated.
	 *
	 * @return Service Properly instantiated service.
	 */
	public function instantiate(): Service {
		$instantiation = $this->instantiation;
		$service       = $instantiation();

		if ( ! $service instanceof Service ) {
			throw InvalidService::from_service( $service );
		}

		return $service;
	}
}
