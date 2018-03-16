var documents = document.querySelectorAll('.clamp p');
for(var i =0; i < documents.length; i++)
    $clamp(documents[i], {clamp: 2});


jQuery(function($) {

    var slider = document.getElementById('slider');
    if(slider !=null){
	var sliderCloned = slider.cloneNode(true);
	window.addEventListener("orientationchange", function() {
	    var sliderContainer = document.getElementById('photo-report-container');
	    sliderContainer.removeChild(slider);
	    sliderContainer.appendChild(sliderCloned.cloneNode(true));
	    // Adding slider on index with various effects
	    $( '#slider' ).lateralSlider( {
		captionPadding: '0',
		captionHeight: 45
	    } );
	    
	});
    }
    
    // Adding slider on index with various effects
    $( '#slider' ).lateralSlider( {
      captionPadding: '0',
      captionHeight: 45
    } );

    //var document.querySelectorAll('div#slider > div')
    // Audio control
    var play = false;
    var realAudio = document.getElementById('cmkx-audio');
    if(realAudio == null){
	realAudio = new Audio();
	realAudio.preload = "none";
	realAudio.src = "https://icecast.teveo.icrt.cu/7hdNcTbM";
    }
    var realAudioIco = document.getElementById('real-audio-ico');
    realAudio.onpause =  function(){
	this.src= "";
	this.src= "https://icecast.teveo.icrt.cu/7hdNcTbM";
	realAudioIco.style = "filter: grayscale(100%);"
    };

    realAudio.onplay = function (){
	realAudioIco.style = "filter: none;"
    };
    
    $('#cmkx-audio-control').click(function(){
    	if(play){
	    realAudio.pause();
	    play = false;
	}
	else{
	    realAudio.play();
	    play= true;
	}
	return false;
    });
    //
    var lastYposition = 0;
    var navBarHidden = false;
    window.addEventListener('scroll', function(e){
	var topRadioStation = document.getElementById("top-radio-station");
	var hideNavBar = function(){
	    if(!navBarHidden){
		topRadioStation.style = "transform: translateY(-100%);" ;
		navBarHidden = true;
	    }
	}

	// Check if is a device if large or medium screem
	if( window.innerHeight > 600)
	    if( window.scrollY  < (lastYposition)){
		if(window.scrollY == 0)
		    topRadioStation.style ="";
		else
		    topRadioStation.style = "position: fixed; transform: translateY(0);";
		navBarHidden = false;
	    }
	else
	    hideNavBar();
	lastYposition = window.scrollY;
	
    });
    

});


