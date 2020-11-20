<?php
namespace PieDonutChartElementor;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class pieanddonutchart_elementor {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var pieanddonutchart_elementor The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return pieanddonutchart_elementor An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_scripts() {

	     wp_register_script( 'elementor-piecharts-script', plugins_url( '/assets/js/chart.js', __FILE__ ),['jquery']);

	     wp_enqueue_script( 'elementor-piecharts-script' );
			
	}

	public function widget_styles(){
		wp_register_style( 'elementor-piecharts-style', plugins_url( '/assets/js/style.css', __FILE__ ));
		wp_enqueue_style( 'elementor-piecharts-style');

	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files() {

		require_once( __DIR__ . '/widgets/piechart.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets

	
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\pieanddonutchart_widget() );
	}

	/**
	 *  pieanddonutchart_elementor class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		add_action('elementor/frontend/after_enqueue_styles',[$this,'widget_styles']);

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate pieanddonutchart_elementor
pieanddonutchart_elementor::instance();
