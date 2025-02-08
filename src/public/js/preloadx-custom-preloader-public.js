(function( $ ) {
	window.onload = function() {
		var preloader = document.getElementsByClassName('pxpreloader');
		if(preloader && preloader.length) {
			setTimeout(function() {
				preloader[0].classList.add('no-show');
			}, 1000); //Delay so that it shows loader atleast for 1 second
		}
	};
})( jQuery );
