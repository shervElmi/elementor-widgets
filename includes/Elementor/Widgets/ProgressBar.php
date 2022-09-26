<?php
/**
 * ProgressBar class.
 * A Elementor widget that displays a progress bar.
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

namespace Insider\Elementor_Widgets\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;

/**
 * ProgressBar class.
 *
 * @since 1.0.0
 */
final class ProgressBar extends Widget_Base {

	/**
	 * Get the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @return string  Widget name.
	 */
	public function get_name(): string {
		return 'insider-progress-bar';
	}

	/**
	 * Get the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @return string  Widget title.
	 */
	public function get_title(): string {
		return __( 'Insider Progress Bar', 'insider-elementor-widgets' );
	}

	/**
	 * Get the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @return string  Widget icon.
	 */
	public function get_icon(): string {
		return 'eicon-skill-bar';
	}

	/**
	 * Get the widget categories.
	 *
	 * @since 1.0.0
	 *
	 * @return array  Widget categories.
	 */
	public function get_categories(): array {
		return [ 'insider' ];
	}

	/**
	 * Get the widget keywords.
	 *
	 * @since 1.0.0
	 *
	 * @return array  Widget keywords.
	 */
	public function get_keywords(): array {
		return [
			'pie',
			'charts',
			'circle',
			'progress',
			'insider',
		];
	}

	/**
	 * Get the widget scripts.
	 *
	 * @since 1.0.0
	 *
	 * @return array Widget scripts.
	 */
	public function get_script_depends(): array {
		return [ 'insider-progress-bar' ];
	}

	/**
	 * Get the widget styles.
	 *
	 * @since 1.0.0
	 *
	 * @return array Widget styles.
	 */
	public function get_style_depends(): array {
		return [ 'insider-styles' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function register_controls() {
		// Content section.
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'insider-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'percent',
			[
				'label'              => __( 'Percent', 'insider-elementor-widgets' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ '%' ],
				'range'              => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'            => [
					'unit' => '%',
					'size' => 78,
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => __( 'Text', 'insider-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'Add your title text', 'insider-elementor-widgets' ),
				'placeholder' => __( 'Enter your text', 'insider-elementor-widgets' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		// Config section.
		$this->start_controls_section(
			'section_config',
			[
				'label' => __( 'Config', 'insider-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'start_angle',
			[
				'label'              => __( 'Start angle', 'insider-elementor-widgets' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ 'deg' ],
				'range'              => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'default'            => [
					'unit' => 'deg',
					'size' => 0,
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'bar_width',
			[
				'label'       => __( 'Bar width', 'insider-elementor-widgets' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'default'     => 13,
				'selectors'   => [
					'{{WRAPPER}} .circle-progress-value' => 'stroke-width: {{VALUE}}px; stroke-linecap: round;',
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'bar_bg_width',
			[
				'label'       => __( 'Bar background width', 'insider-elementor-widgets' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'default'     => 13,
				'selectors'   => [
					'{{WRAPPER}} .circle-progress-circle' => 'stroke-width: {{VALUE}}px;',
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'animation_speed',
			[
				'label'              => __( 'Animation speed', 'insider-elementor-widgets' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 100,
				'default'            => 2000,
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		// Start the style tab.
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'insider-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bar_color',
			[
				'label'     => __( 'Bar Color', 'insider-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2146EC',
				'selectors' => [
					'{{WRAPPER}} .circle-progress-value' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bar_bg_color',
			[
				'label'     => __( 'Bar Background Color', 'insider-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C2CAF2',
				'selectors' => [
					'{{WRAPPER}} .circle-progress-circle' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'percent_color',
			[
				'label'     => __( 'Percent Color', 'insider-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#051235',
				'selectors' => [
					'{{WRAPPER}} .insider-circle-progress > svg text' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text Color', 'insider-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#051235',
				'selectors' => [
					'{{WRAPPER}} .insider-progress-bar__text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'percent_heading',
			[
				'label'     => __( 'Percent', 'insider-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'percent_typography',
				'selector' => '{{WRAPPER}} .insider-circle-progress > svg text',
			]
		);

		$this->add_control(
			'text_heading',
			[
				'label'     => __( 'Text', 'insider-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'selector' => '{{WRAPPER}} .insider-progress-bar__text',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => __( 'Padding', 'insider-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .insider-progress-bar__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// "wrapper" attributes.
		$this->add_render_attribute(
			'wrapper',
			[
				'class' => [
					'insider-progress-bar',
					'insider-text-center',
				],
			]
		);

		// "circle-progress" attributes.
		$this->add_render_attribute(
			'circle-progress',
			[
				'class' => [
					'insider-circle-progress',
				],
			]
		);

		// "text" attributes.
		$this->add_render_attribute(
			'text',
			[
				'class' => [
					'insider-progress-bar__text',
				],
			]
		);

		?>
		<div
		<?php echo wp_kses_post( $this->get_render_attribute_string( 'wrapper' ) ); ?>>
			<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'circle-progress' ) ); ?>></div>
			<span <?php echo wp_kses_post( $this->get_render_attribute_string( 'text' ) ); ?>>
				<?php echo wp_kses_post( $settings['text'] ); ?>
			</span>
		</div>
		<?php
	}
}
