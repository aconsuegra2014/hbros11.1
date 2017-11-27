var documents = document.querySelectorAll('.clamp p');
for(let clampDocument of documents)
    $clamp(clampDocument, {clamp: 2});

// Adding custom scroll with javascript
jQuery(function($) {
    $("section").niceScroll({
	cursorborder: ""
	,cursorcolor: "#808080cc"
    }); 
});
