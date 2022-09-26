<?php
/**
 * Plugin Requirements class.
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

/**
 * Class Plugin_Requirements.
 *
 * @since 1.0.0
 */
class Plugin_Requirements {

	/**
	 * WP_Error object.
	 *
	 * @var WP_Error
	 */
	private $wp_error;

	/**
	 * PHP version.
	 *
	 * @var string
	 */
	private $php_version;

	/**
	 * WordPress version.
	 *
	 * @var string
	 */
	private $wp_version;

	/**
	 * List of required files.
	 *
	 * @var array
	 */
	private $required_files = array();

	/**
	 * Whether Elementor has been installed.
	 *
	 * @var bool
	 */
	private $is_elementor_required = false;

	/**
	 * Requirements constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Error $wp_error WP_Error object.
	 */
	public function __construct( WP_Error $wp_error ) {
		$this->wp_error = $wp_error;
	}

	/**
	 * Check minimum PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function check_php_version() {
		if ( version_compare( PHP_VERSION, $this->get_php_version(), '<' ) ) {
			$message = esc_html(
				sprintf(
					/* translators: %s: PHP version */
					__( 'Insider Elementor Widgets requires PHP %s or higher.', 'insider-elementor-widgets' ),
					$this->get_php_version()
				)
			);
			$this->wp_error->add( 'failed_check_php_version', $message );

			return false;
		}

		return true;
	}

	/**
	 * Check minimum WordPress version.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function check_wp_version() {
		if ( version_compare( get_bloginfo( 'version' ), $this->get_wp_version(), '<' ) ) {
			$message = esc_html(
				sprintf(
					/* translators: %s: WordPress version */
					__( 'Insider Elementor Widgets requires WordPress %s or higher.', 'insider-elementor-widgets' ),
					$this->get_wp_version()
				)
			);
			$this->wp_error->add( 'failed_check_wp_version', $message );

			return false;
		}

		return true;
	}

	/**
	 * Check if required files.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function check_required_files() {
		$required_files = $this->get_required_files();

		if ( $required_files ) {
			foreach ( $required_files as $required_file ) {
				if ( ! is_readable( $required_file ) ) {
					$message =
						sprintf(
							/* translators: %s: build commands. */
							__( 'You appear to be running an incomplete version of the plugin. Please run %s to finish installation.', 'insider-elementor-widgets' ),
							'<code>composer install &amp;&amp; yarn install &amp;&amp; yarn run build</code>'
						);
					$this->wp_error->add( 'failed_check_required_files', $message );

					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Check if Elementor installed and activated.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function check_elementor_installed() {
		$is_elementor_required = $this->get_is_elementor_required();

		if ( $is_elementor_required ) {
			if ( ! did_action( 'elementor/loaded' ) ) {
				$message = esc_html__( 'Insider Elementor Widgets requires Elementor to be installed and activated.', 'insider-elementor-widgets' );
				$this->wp_error->add( 'failed_check_elementor_installed', $message );

				return false;
			}
		}

		return true;
	}

	/**
	 * Run checks in admin.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function run_checks() {
		$this->check_php_version();
		$this->check_wp_version();
		$this->check_required_files();
		$this->check_elementor_installed();
	}

	/**
	 * Get WP_Error object.
	 *
	 * @return WP_Error
	 */
	public function get_wp_error() {
		return $this->wp_error;
	}

	/**
	 * Get PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_php_version() {
		return $this->php_version;
	}

	/**
	 * Set PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @param   string $php_version  PHP version.
	 *
	 * @return  self
	 */
	public function set_php_version( string $php_version ) {
		$this->php_version = $php_version;

		return $this;
	}

	/**
	 * Get WordPress version.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_wp_version() {
		return $this->wp_version;
	}

	/**
	 * Set WordPress version.
	 *
	 * @since 1.0.0
	 *
	 * @param string $wp_version  WordPress version.
	 *
	 * @return self
	 */
	public function set_wp_version( string $wp_version ) {
		$this->wp_version = $wp_version;

		return $this;
	}

	/**
	 * Get list of required files.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_required_files() {
		return $this->required_files;
	}

	/**
	 * Set list of required files.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $required_files  List of required files.
	 *
	 * @return self
	 */
	public function set_required_files( array $required_files ) {
		$this->required_files = $required_files;

		return $this;
	}

	/**
	 * Get whether Elementor has been installed.
	 *
	 * @return bool
	 */
	public function get_is_elementor_required() {
		return $this->is_elementor_required;
	}

	/**
	 * Set whether Elementor has been installed.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $is_elementor_required  Whether Elementor has been installed.
	 *
	 * @return self
	 */
	public function set_is_elementor_required( bool $is_elementor_required ) {
		$this->is_elementor_required = $is_elementor_required;

		return $this;
	}
}
