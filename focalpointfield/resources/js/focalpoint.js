// Wrap our implementation in an Immediately-Invoked Function Expression
;(function ( root ) {
  // Create a simple namespace
  root.com = root.com || {};
  root.com.craftcms = root.com.craftcms || {};

  // Expose our main function in namespace
  root.com.craftcms.FocalPointField = function(selector){
		
		var craftPositonTranslate = {
      'top-left': '0% 0%',
      'top-center': '50% 0%',
      'top-right': '100% 0%',
      'center-left': '0% 50%',
      'center-center': '50% 50%',
      'center-right': '100% 50%',
      'bottom-left': '0% 100%',
      'bottom-center': '50% 100%',
      'bottom-right': '100% 100%'
    };
		
		var $field = $(selector);
		var $focalpointWrapper = $field.find('.focalpointfield-wrapper');
		var $inputField = $field.find('.focalpointfield-field-data');
		var $marker = $('<span class="focalpointfield-marker">');
		var isDragging = false;

		function placeMarker(x, y) {
			var imageWidth = $focalpointWrapper.outerWidth();
			var imageHeight = $focalpointWrapper.outerHeight();
			
			$focalpointWrapper.append($marker);
			$marker.css({ top: Math.round((y/100)*imageHeight), left: Math.round((x/100)*imageWidth) });
		}
		
		function parseValue(val) {
			if (craftPositonTranslate[val] !== undefined) {
				val = craftPositonTranslate[val];
			}
			
			var arr = val.split(' ');
			
			if (arr.length==2) {
				var x = Number(arr[0].replace('%', ''));
				var y = Number(arr[1].replace('%', ''));
				if (x<0) { x = 0; }
				if (y<0) { y = 0; }
				if (x>100) { x = 100; }
				if (y>100) { y = 100; }
				
				placeMarker(x, y);
			} 
		}
		
		function setValue(x, y) {
			$inputField.val(x + '% ' + y + '%');
			placeMarker(x, y);
		}

		function parsePosition(pageX, pageY) {
			var parentOffset = $focalpointWrapper.offset();
			var imageWidth = $focalpointWrapper.outerWidth();
			var imageHeight = $focalpointWrapper.outerHeight();
			var posX = pageX-parentOffset.left;
			var posY = pageY-parentOffset.top;

			var precision = Math.pow(10, 2);
			var percentX = Math.round((posX/imageWidth)*100*precision) / precision;
			var percentY = Math.round((posY/imageHeight)*100*precision) / precision;

			percentX = Math.max(0, Math.min(percentX, 100));
			percentY = Math.max(0, Math.min(percentY, 100));

			setValue(percentX, percentY);
		}

		$focalpointWrapper.on('click', function (e) {
			parsePosition(e.pageX, e.pageY);
		});
		
		$marker.on('mousedown', function (e) {
			isDragging = true;
		});
		
		$marker.on('mouseup', function (e) {
			isDragging = false;
		});
		
		$focalpointWrapper.on('mouseleave', function (e) {
			isDragging = false;
		});
		
		$(window).on('mousemove', function (e) {
			if (isDragging) {
				parsePosition(e.pageX, e.pageY);
			}
		});
		
		if ($focalpointWrapper.length>0) {
			$focalpointWrapper.waitForImages(function () {
				if ($inputField.val() != '') {
					parseValue($inputField.val());
				}
			});
		}
  };
})(window);
