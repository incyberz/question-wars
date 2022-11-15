<div id="gallery" class="point_list_right">
	Gallery
</div>



<style type="text/css">
#gallery * {
	box-sizing: border-box;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
	position: relative;
}

/* Hide the images by default */
.mySlides {
	display: none;
	text-align: center;
	/*max-height: 500px;*/
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
	cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
	cursor: pointer;
	position: absolute;
	top: 40%;
	width: auto;
	padding: 16px;
	margin-top: -50px;
	color: white;
	font-weight: bold;
	font-size: 20px;
	border-radius: 0 3px 3px 0;
	user-select: none;
	-webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
	right: 0;
	border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
	background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
	color: #f2f2f2;
	font-size: 12px;
	padding: 8px 12px;
	position: absolute;
	top: 0;
}

/* Container for image text */
.caption-container {
	text-align: center;
	background-color: #222;
	padding: 2px 16px;
	color: white;
}

.row:after {
	content: '';
	display: table;
	clear: both;
}

/* Six columns side by side */
.column {
	float: left;
	width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
	opacity: 0.6;
	height: 100px;
	/*width: 100px;*/
	object-fit: contain;
	width: 100%;
}

.active,
.demo:hover {
	opacity: 1;
}
</style>










<div class="content_list">
	<!-- Container for the image gallery -->
	<div class="container">

		<!-- Full-width images with number text -->
		<div class="mySlides">
			<div class="numbertext">1 / 6</div>
			<img src="img-gallery/gal1.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">2 / 6</div>
			<img src="img-gallery/gal2.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">3 / 6</div>
			<img src="img-gallery/gal3.jpg" style="max-height: 500px;">
		</div>

		<!-- <div class="mySlides">
			<div class="numbertext">4 / 6</div>
			<img src="img-gallery/gal4.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">5 / 6</div>
			<img src="img-gallery/gal5.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">6 / 6</div>
			<img src="img-gallery/gal6.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">1 / 6</div>
			<img src="img-gallery/gal1.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">2 / 6</div>
			<img src="img-gallery/gal2.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">3 / 6</div>
			<img src="img-gallery/gal3.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">4 / 6</div>
			<img src="img-gallery/gal4.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">5 / 6</div>
			<img src="img-gallery/gal5.jpg" style="max-height: 500px;">
		</div>

		<div class="mySlides">
			<div class="numbertext">6 / 6</div>
			<img src="img-gallery/gal6.jpg" style="max-height: 500px;">
		</div> -->


		<!-- Next and previous buttons -->
		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095;</a>

		<!-- Image text -->
		<div class="caption-container">
			<p id="caption"></p>
		</div>

		<!-- Thumbnail images -->
		<div class="row">
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal1.jpg" onclick="currentSlide(1)" alt="The Woods">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal2.jpg" onclick="currentSlide(2)" alt="Cinque Terre">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal3.jpg" onclick="currentSlide(3)" alt="Mountains and fjords">
			</div>
			<!-- <div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal4.jpg" onclick="currentSlide(4)" alt="Northern Lights">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal5.jpg" onclick="currentSlide(5)" alt="Nature and sunrise">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal6.jpg" onclick="currentSlide(6)" alt="Snowy Mountains">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal1.jpg" onclick="currentSlide(7)" alt="The Woods">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal2.jpg" onclick="currentSlide(8)" alt="Cinque Terre">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal3.jpg" onclick="currentSlide(9)" alt="Mountains and fjords">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal4.jpg" onclick="currentSlide(10)" alt="Northern Lights">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal5.jpg" onclick="currentSlide(11)" alt="Nature and sunrise">
			</div>
			<div class="column">
				<img class="demo cursor" src="img-gallery/thumbs/gal6.jpg" onclick="currentSlide(12)" alt="Snowy Mountains">
			</div> -->
		</div>
	</div> 
</div>




<?php
function make_thumb($src, $dest, $desired_width) {

	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);

	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));

	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}

$src="img-gallery/gal4.jpg";
$dest="gal4_thumb.jpg";
$desired_width="200";
make_thumb($src, $dest, $desired_width);


function createThumbnail($filepath, $thumbpath, $thumbnail_width, $thumbnail_height, $background=false) {
	list($original_width, $original_height, $original_type) = getimagesize($filepath);
	if ($original_width > $original_height) {
		$new_width = $thumbnail_width;
		$new_height = intval($original_height * $new_width / $original_width);
	} else {
		$new_height = $thumbnail_height;
		$new_width = intval($original_width * $new_height / $original_height);
	}
	$dest_x = intval(($thumbnail_width - $new_width) / 2);
	$dest_y = intval(($thumbnail_height - $new_height) / 2);

	if ($original_type === 1) {
		$imgt = "ImageGIF";
		$imgcreatefrom = "ImageCreateFromGIF";
	} else if ($original_type === 2) {
		$imgt = "ImageJPEG";
		$imgcreatefrom = "ImageCreateFromJPEG";
	} else if ($original_type === 3) {
		$imgt = "ImagePNG";
		$imgcreatefrom = "ImageCreateFromPNG";
	} else {
		return false;
	}

	$old_image = $imgcreatefrom($filepath);
    $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height); // creates new image, but with a black background

    // figuring out the color for the background
    if(is_array($background) && count($background) === 3) {
    	list($red, $green, $blue) = $background;
    	$color = imagecolorallocate($new_image, $red, $green, $blue);
    	imagefill($new_image, 0, 0, $color);
    // apply transparent background only if is a png image
    } else if($background === 'transparent' && $original_type === 3) {
    	imagesavealpha($new_image, TRUE);
    	$color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
    	imagefill($new_image, 0, 0, $color);
    }

    imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
    $imgt($new_image, $thumbpath);
    return file_exists($thumbpath);
  }

  $src="img-gallery/gal4.jpg";
  $dest="gal4_thumbv2.jpg";
  createThumbnail($src, $dest, 200,200);


  ?>


















  <script type="text/javascript">
  	let slideIndex = 1;
  	showSlides(slideIndex);

	// Next/previous controls
	function plusSlides(n) {
		showSlides(slideIndex += n);
	}

	// Thumbnail image controls
	function currentSlide(n) {
		showSlides(slideIndex = n);
	}

	function showSlides(n) {
		let i;
		let slides = document.getElementsByClassName("mySlides");
		let dots = document.getElementsByClassName("demo");
		let captionText = document.getElementById("caption");
		if (n > slides.length) {slideIndex = 1}
			if (n < 1) {slideIndex = slides.length}
				for (i = 0; i < slides.length; i++) {
					slides[i].style.display = "none";
				}
				for (i = 0; i < dots.length; i++) {
					dots[i].className = dots[i].className.replace(" active", "");
				}
				slides[slideIndex-1].style.display = "block";
				dots[slideIndex-1].className += " active";
				captionText.innerHTML = dots[slideIndex-1].alt;
			} 
		</script>