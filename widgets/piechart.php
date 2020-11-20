<?php

namespace PieDonutChartElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * 
 *
 * 
 *
 * @since 1.0.0
 */
class pieanddonutchart_widget extends Widget_Base{

  public function get_name(){
    return 'piedonutcharts';
  }

  public function get_title(){
    return 'Pie-Chart';
  }

  public function get_icon(){
    return 'fa fa-pie-chart';
  }

  public function get_categories(){
    return ['general'];
  }

  protected function _register_controls(){

    $this->start_controls_section(
      'section_content',
      [
        'label' => 'Settings',
      ]
    );

    $this->add_control(
      'label_heading',
      [
        'label' => 'Chart Labels',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'Apple,Grapes,Banana'
      ]
    );

    $this->add_control(
      'chart_type',
      [
        'label'=> 'Chart Type',
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'pie',
        'options' =>['pie'=>__('Pie'),'polarArea'=>__('Polar'),'doughnut'=>__('Donut')]
      ]
    );

    $this->add_control(
      'content_heading',
      [
        'label' => 'Chart Data',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '20,30,40'
      ]
    );

    $this->add_control(
      'content',
      [
        'label' => 'Chart ID',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '23'
      ]
    );

    $this->end_controls_section();
  }
  

  protected function render(){
    $settings = $this->get_settings_for_display();

    

    ?>

    <div> <canvas id = "<?php echo $settings['content'];     ?>"></canvas></div>
    <?php  $fist = explode(',', $settings['content_heading']);
    $secd = explode(',', $settings['label_heading'])  ;                 ?>
    <script type="text/javascript">
      
      jQuery(document).ready(function(){


        var ctx = document.getElementById("<?php echo $settings['content'];       ?>").getContext('2d');

                    var chart = new Chart(ctx, {
                              // The type of chart we want to create
                              type: "<?php echo $settings['chart_type'];  ?>",

                              // The data for our dataset
                              data: {
                                  labels: <?php echo json_encode($secd);   ?>,
                                  datasets: [{
                                      label: "Chart.js",
                                      backgroundColor: ['teal', 'steelblue', 'aqua', 'bisque', 'plum',"RosyBrown","salmon","indigo","magenta","brown","blue","red","yellow","green","orange","crimson","violet","khaki"],
                                      borderColor: '#fff',
                                      data: <?php echo json_encode($fist);?>,
                                  }]
                              },

                              // Configuration options go here
                             
                          })






      })

    </script>




    <?php
  }


}

