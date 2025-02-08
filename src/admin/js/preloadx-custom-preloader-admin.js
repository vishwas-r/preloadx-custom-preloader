(function( $ ) {
	function toggleBackgroundInputs() {
		var type = document.getElementById('preloadx_bgtype').value;
		document.getElementById('color-input').style.display = (type === 'color') ? 'block' : 'none';
		document.getElementById('gradient-input').style.display = (type === 'gradient') ? 'block' : 'none';
		document.getElementById('image-input').style.display = (type === 'image') ? 'block' : 'none';
		changeBackground(type);
	}
	function changeBackground(type) {
		var elements = document.getElementsByClassName('pxpreloader-preview');
		for (var i = 0; i < elements.length; i++) {
			if(type === "image") {
				elements[i].style.background = "url(" + document.getElementById('preloadx_bg' + type).value + ")";
				elements[i].style.backgroundSize = "cover";
				elements[i].style.backgroundRepeat = "no-repeat";
			}
			else {
				elements[i].style.background = elements[i].getAttribute("id") === "no-loader" ? "none" : document.getElementById('preloadx_bg' + type).value;
			}
		}
	}
	document.addEventListener('DOMContentLoaded', function() {
		toggleBackgroundInputs();
		document.getElementById("preloadx_bgtype").addEventListener("change", function() {
			toggleBackgroundInputs();
		});
		document.getElementById("preloadx_bgcolor").addEventListener("change", function() {
			changeBackground('color');
		});
		document.getElementById("preloadx_bggradient").addEventListener("change", function() {
			changeBackground("gradient");
		});
		document.getElementById("preloadx_bgimage").addEventListener("change", function() {
			changeBackground("image");
		});
		document.getElementById("preloadx_color").addEventListener("change", function() {
			document.documentElement.style.setProperty('--preloader-color', document.getElementById('preloadx_color').value);
		});
	});

})( jQuery );
