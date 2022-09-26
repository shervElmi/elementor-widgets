<?php
/**
 * Injection_Chain final class.
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

namespace Insider\Elementor_Widgets\Infrastructure\Injector;

use LogicException;

/**
 * The injection chain is similar to a trace, keeping track of what we have done
 * so far and at what depth within the auto-wiring we currently are.
 *
 * It is used to detect circular dependencies, and can also be dumped for
 * debugging information.
 *
 * @since 1.0.0
 */
final class Injection_Chain {

	/** @var array<string> */
	private $chain = [];

	/** @var array<bool> */
	private $resolutions = [];

	/**
	 * Add class to injection chain.
	 *
	 * @since 1.0.0
	 *
	 * @param string $class Class to add to injection chain.
	 * @return self Modified injection chain.
	 */
	public function add_to_chain( string $class ): self {
		$this->chain[] = $class;

		return $this;
	}

	/**
	 * Add resolution for circular reference detection.
	 *
	 * @since 1.0.0
	 *
	 * @param string $resolution Resolution to add.
	 * @return self Modified injection chain.
	 */
	public function add_resolution( string $resolution ): self {
		$this->resolutions[ $resolution ] = true;

		return $this;
	}

	/**
	 * Get the last class that was pushed to the injection chain.
	 *
	 * @since 1.0.0
	 *
	 * @return string Last class pushed to the injection chain.
	 */
	public function get_class(): string {
		if ( empty( $this->chain ) ) {
			throw new LogicException(
				'Access to injection chain before any resolution was made.'
			);
		}

		return \end( $this->chain ) ?: '';
	}

	/**
	 * Get the injection chain.
	 *
	 * @since 1.0.0
	 *
	 * @return array Chain of injections.
	 */
	public function get_chain(): array {
		return \array_reverse( $this->chain );
	}

	/**
	 * Check whether the injection chain already has a given resolution.
	 *
	 * @since 1.0.0
	 *
	 * @param string $resolution Resolution to check for
	 * @return bool Whether the resolution was found.
	 */
	public function has_resolution( string $resolution ): bool {
		return \array_key_exists( $resolution, $this->resolutions );
	}
}
