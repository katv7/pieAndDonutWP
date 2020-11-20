<?php 
//shortcode class
class pieanddonutchart_shortcode
{
	
	function __construct()
	{
		add_shortcode( "piechart", array($this,'my_shortj' ));
        add_action('wp_enqueue_scripts',array($this,'enqueue'));
	}



function my_shortj($atts, $content = null){

	$atts = shortcode_atts( 

		array('label'=>'apple,mango','data'=> '10,20', 'id'=>'1','type'=> 'pie')
		, $atts );

		 wp_enqueue_style( 'mystylej' );
			wp_enqueue_script( 'myscriptj');	
	    
		ob_start();

	      ?>  
		 <div class="bg">
		 	<?php  $first = explode(',', $atts['label']);
		 	$second = explode(',', $atts['data']); ?>
		 	<canvas id="<?php  echo 'cat'.$atts['id'];            ?>"></canvas>
		 </div>
		 						<script type="text/javascript">
		 							
		 							jQuery(document).ready(function(){
		 							var ctx = document.getElementById("<?php  echo 'cat'.$atts['id'];?>").getContext('2d');



		 								 var chart = new Chart(ctx, {
											        // The type of chart we want to create
											        type: "<?php echo $atts['type'];  ?>",

											        // The data for our chart
											        data: {
											            labels: <?php echo json_encode($first);   ?>,
											            datasets: [{
											                label: "Chart.js",
											                backgroundColor: ['teal', 'steelblue', 'aqua', 'bisque', 'plum',"RosyBrown","salmon","indigo","magenta","brown","blue","red","yellow","green","orange","crimson","violet","khaki"],
											                borderColor: '#fff',
											                data: <?php echo json_encode($second);?>,
											            }]
											        },

											        // Configuration options go here
											       
											    })


		 								});





		 						</script>

	

		

	     <?php   

	      return ob_get_clean();

}



        function enqueue(){

		
		//enqueing scripts to pages/posts
	   wp_register_style('mystylej',plugins_url('lib/style.css',__FILE__));
	   wp_register_script('myscriptj',plugins_url('assets/js/chart.js',__FILE__),array('jquery'), '1.0', false);
		
	    
			
		


}







}

//instantiate pieanddonutchart_shortcode
$run = new pieanddonutchart_shortcode();
