<?php

class cmkxRealAudio extends WP_Widget{
    public function __construct(){
	
	// Constructor del Widget.
	$widget_ops = array('classname' => 'cmkx_real_audio', 'description' => "Caja audio real" );
	parent::__construct('cmkx_real_audio', "cmkx_real_audio", $widget_ops);
    }
    

    function widget($args,$instance){
	echo '<div id="real-audio-container">';
	echo "<audio id='cmkx-audio' controls='' src='https://icecast.teveo.icrt.cu/7hdNcTbM' preload='none'>";
	echo "Your browser does not support the audio tag.";
	echo "</audio>";
	echo "</div>";
	
    }
    
    function update($new_instance, $old_instance){       
    }
    
    function form($instance){  
    }

}


?>

  
