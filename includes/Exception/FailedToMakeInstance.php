<?php
/**
 * FailedToMakeInstance final class.
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

use RuntimeException;

/**
 * FailedToMakeInstance final class.
 *
 * @since 1.0.0
 */
final class FailedToMakeInstance
	extends RuntimeException
	implements InsiderException {

	// These constants are public so you can use them to find out what exactly
	// happened when you catch a "FailedToMakeInstance" exception.
	const CIRCULAR_REFERENCE             = 100;
	const UNRESOLVED_INTERFACE           = 200;
	const UNREFLECTABLE_CLASS            = 300;
	const UNRESOLVED_ARGUMENT            = 400;
	const UNINSTANTIATED_SHARED_INSTANCE = 500;
	const INVALID_DELEGATE               = 600;

	/**
	 * Create a new instance of the exception for an interface or class that
	 * created a circular reference.
	 *
	 * @since 1.0.0
	 *
	 * @param string $interface_or_class Interface or class name that generated
	 *                                   the circular reference.
	 *
	 * @return static
	 */
	public static function for_circular_reference( string $interface_or_class ) {
		$message = \sprintf(
			'Circular reference detected while trying to resolve the interface or class "%s".',
			$interface_or_class
		);

		return new static( $message, static::CIRCULAR_REFERENCE );
	}

	/**
	 * Create a new instance of the exception for an interface that could not
	 * be resolved to an instantiable class.
	 *
	 * @since 1.0.0
	 *
	 * @param string $interface Interface that was left unresolved.
	 *
	 * @return static
	 */
	public static function for_unresolved_interface( string $interface ) {
		$message = \sprintf(
			'Could not resolve the interface "%s" to an instantiable class, probably forgot to bind an implementation.',
			$interface
		);

		return new static( $message, static::UNRESOLVED_INTERFACE );
	}

	/**
	 * Create a new instance of the exception for an interface or class that
	 * could not be reflected upon.
	 *
	 * @since 1.0.0
	 *
	 * @param string $interface_or_class Interface or class that could not be
	 *                                   reflected upon.
	 *
	 * @return static
	 */
	public static function for_unreflectable_class( string $interface_or_class ) {
		$message = \sprintf(
			'Could not reflect on the interface or class "%s", probably not a valid FQCN.',
			$interface_or_class
		);

		return new static( $message, static::UNREFLECTABLE_CLASS );
	}

	/**
	 * Create a new instance of the exception for an argument that could not be
	 * resolved.
	 *
	 * @since 1.0.0
	 *
	 * @param string $argument_name Name of the argument that could not be
	 *                              resolved.
	 * @param string $class         Class that had the argument in its
	 *                              constructor.
	 * @return static
	 */
	public static function for_unresolved_argument( string $argument_name, string $class ) {
		$message = \sprintf(
			'Could not resolve the argument "%s" while trying to instantiate the class "%s".',
			$argument_name,
			$class
		);

		return new static( $message, static::UNRESOLVED_ARGUMENT );
	}

	/**
	 * Create a new instance of the exception for a class that was meant to be
	 * reused but was not yet instantiated.
	 *
	 * @since 1.0.0
	 *
	 * @param string $class Class that was not yet instantiated.
	 *
	 * @return static
	 */
	public static function for_uninstantiated_shared_instance( string $class ) {
		$message = \sprintf(
			'Could not retrieve the shared instance for "%s" as it was not instantiated yet.',
			$class
		);

		return new static( $message, static::UNINSTANTIATED_SHARED_INSTANCE );
	}

	/**
	 * Create a new instance of the exception for a delegate that was requested
	 * for a class that doesn't have one.
	 *
	 * @since 1.0.0
	 *
	 * @param string $class Class for which there is no delegate.
	 *
	 * @return static
	 */
	public static function for_invalid_delegate( string $class ) {
		$message = \sprintf(
			'Could not retrieve a delegate for "%s", none was defined.',
			$class
		);

		return new static( $message, static::INVALID_DELEGATE );
	}
}
