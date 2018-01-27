var documents = document.querySelectorAll('.clamp p');
for(let clampDocument of documents)
    $clamp(clampDocument, {clamp: 2});


jQuery(function($) {
	// Adding custom scroll with javascript
    $("section").niceScroll({
	cursorborder: ""
	,cursorcolor: "#808080cc"
    }); 
	
	// Adding slider on index with various effects
    $( '#slider' ).lateralSlider( {
      captionPadding: '0',
      captionHeight: 45
    } );
	
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
    
    window.addEventListener('scroll', function(e){
	var topRadioStation = document.getElementById("top-radio-station");
	console.log(window.scrollY);
	if(window.scrollY > 0)
	    topRadioStation.style = "position: fixed;   top: 0;" ;
	else
	    topRadioStation.style = "" ;
    });
    

});


