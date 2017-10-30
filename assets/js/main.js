var documents = document.querySelectorAll('.clamp p');
for(let clampDocument of documents)
	$clamp(clampDocument, {clamp: 2});
