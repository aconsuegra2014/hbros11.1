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

});


