<?php


//reference from https://www.formget.com/php-checkbox/


// delete logic
if(isset($_POST['delete'])){
	if(!empty($_POST['check_list'])) {
		
		$checked_count = count($_POST['check_list']);
		foreach($_POST['check_list'] as $selected) {
			
			include 'connect.php';
		
			//delete from table
			$q = 'DELETE FROM photos WHERE photolink = :photolink;';
			$query = $conn->prepare($q);
			$query->bindValue(':photolink', $selected);
			$query->execute();
			
			//delete from oss
			include 'uploads/php_sdk_delete.php';
			
		}
		
	}
	else{
		
		echo "<script
				type='text/javascript'>alert('Please select at least one photo item to delete');
				window.location= \"edit.php\";
				
			  </script>";
	}
}
// delete logic end


if(isset($_POST['download'])){
	if(!empty($_POST['check_list'])) {
		
		// Counting number of checked checkboxes.
		$checked_count = count($_POST['check_list']);
		$download_link = 'img_tmp/' . $_COOKIE['name'] . '/' . 'download.zip';
		
		@unlink($download_link);
		
		
		$zip = new ZipArchive;
		$res = $zip->open($download_link, ZipArchive::CREATE);
		if ($res === TRUE) {

?>



<!-- reference from https://codemyui.com/drag-image-slider-with-water-distortion-effect-using-webgl/ -->

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Marathon-fyp</title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta charset="utf-8"/>
	<meta name="description" content="Author: Lee ">
	<meta name="theme-color" content="#317EFB"/>
	<link rel="apple-touch-icon" href="#">
	
	<link rel="stylesheet" href="css/search.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js"></script>
	<script src="https://www.curtainsjs.com/build/curtains.min.js"></script>

</head>

<meta charset="utf-8"/>
<body>

	<!-- div that will hold our WebGL canvas -->
	<div id="canvas"></div>

	
	<div id="content">

		<a id="title" href="<?php echo $download_link ?>">Download</a>

		<!-- drag slider -->
		<div id="planes">
<?php 
			foreach($_POST['check_list'] as $selected) {
				
				$link = 'img_tmp/' . $_COOKIE['name'] . '/' . $selected;
				$zip->addFile($link);
?>		
			<div class="plane-wrapper">
				<span class="plane-title"></span>
				<div class="plane">
					<img src="<?php echo $link ?>" data-sampler="planeTexture"alt="Photo by Simon Zhu on Unsplash" crossorigin />
				</div>
			</div>





<?php		

			}
		
			$zip->close();
		} else {
			
		}
		
	}
	else{
		
		$message = "Please select at least one photo item";
		  echo "<script
				type='text/javascript'>alert('$message'); 
				window.location= \"error.php\";
				 </script>";
		
	}
	
}
elseif(!isset($_POST['delete'])){
	
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
}
else{
	echo "<script
				type='text/javascript'>alert('Deleted {$checked_count} item');
				window.location= \"edit.php\";
				
			  </script>";
}
?>

		</div>

		<div id="drag-tip">
			Drag to explore
		</div>
		
	</div>

	<!-- WebGL stuff -->
	<script id="slider-planes-vs" type="x-shader/x-vertex">
		#ifdef GL_ES
		precision mediump float;
		#endif

		// default mandatory attributes
		attribute vec3 aVertexPosition;
		attribute vec2 aTextureCoord;

		// those projection and model view matrices are generated by the library
		// it will position and size our plane based on its HTML element CSS values
		uniform mat4 uMVMatrix;
		uniform mat4 uPMatrix;

		// this is generated by the library based on the sampler name we provided
		// it will be used to map adjust our texture coords so the texture will fit the plane
		uniform mat4 planeTextureMatrix;

		// texture coord varying that will be passed to our fragment shader
		varying vec2 vTextureCoord;

		void main() {
			// apply our vertex position based on the projection and model view matrices
			gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition, 1.0);

			// varying
			// use texture matrix and original texture coords to generate accurate texture coords
			vTextureCoord = (planeTextureMatrix * vec4(aTextureCoord, 0.0, 1.0)).xy;
		}
	</script>
	<script id="slider-planes-fs" type="x-shader/x-fragment">
		#ifdef GL_ES
		precision mediump float;
		#endif

		// our texture coords varying
		varying vec2 vTextureCoord;

		// our texture sampler (see how its name matches the data-sampler attribute on our image tags)
		uniform sampler2D planeTexture;
		// our opacity uniform that goes from 0 to 1
		uniform float uOpacity;

		void main( void ) {
			// map our texture to the varying texture coords
			vec4 finalColor = texture2D(planeTexture, vTextureCoord);

			// the distance from this point to the top edge is a float from 0 to 1
			float distanceToTop = distance(vec2(vTextureCoord.x, 1.0), vTextureCoord);

			// calculate an effect that goes from 0 to 1 depenging on uOpacity and distanceToTop
			float spreadFromTop = clamp((uOpacity * (1.0 - distanceToTop) - 1.0) + uOpacity * 2.0, 0.0, 1.0);

			// handle pre-multiplied alpha on rgb values and use spreadFromTop as alpha.
			finalColor = vec4(vec3(finalColor.rgb * spreadFromTop), spreadFromTop);

			// this is it
			gl_FragColor = finalColor;
		}
	</script>


	<script id="distortion-vs" type="x-shader/x-vertex">
		#ifdef GL_ES
		precision mediump float;
		#endif

		// default mandatory attributes
		attribute vec3 aVertexPosition;
		attribute vec2 aTextureCoord;

		// our displacement texture matrix uniform
		uniform mat4 displacementTextureMatrix;

		// mouse position and direction uniforms
		uniform vec2 uMousePos;
		uniform float uDirection;

		// custom varyings
		varying vec2 vTextureCoord;
		varying vec2 vDispTextureCoord;
		varying vec2 vMouseTexCoords;

		void main() {
			gl_Position = vec4(aVertexPosition, 1.0);

			// varyings
			vTextureCoord = aTextureCoord;
			vDispTextureCoord = (displacementTextureMatrix * vec4(aTextureCoord, 0.0, 1.0)).xy;

			// we will handle our mouse coords here for better performance
			// get our texture coords for both directions
			vec2 mouseHorizontalTexCoords = (uMousePos + 1.0) / 2.0;
			mouseHorizontalTexCoords.y = 0.5;

			vec2 mouseVerticalTexCoords = (uMousePos + 1.0) / 2.0;
			mouseVerticalTexCoords.x = 0.5;

			// use the right value for the right direction
			vMouseTexCoords = mix(mouseHorizontalTexCoords, mouseVerticalTexCoords, uDirection);
		}
	</script>
	<script id="distortion-fs" type="x-shader/x-fragment">
		#ifdef GL_ES
		precision mediump float;
		#endif

		// varyings
		varying vec2 vTextureCoord;
		varying vec2 vDispTextureCoord;
		varying vec2 vMouseTexCoords;

		// our render texture is basically what's being drawn in our canvas
		uniform sampler2D renderTexture;
		// the displacement texture we've loaded into our shader pass
		uniform sampler2D displacementTexture;

		// all our uniforms
		uniform float uDragEffect;
		uniform vec2 uMousePos;
		uniform vec2 uOffset;
		uniform float uDirection;
		uniform vec3 uBgColor;

		void main( void ) {
			vec2 textureCoords = vTextureCoord;

			// repeat and offset our displacement map texture coords for both slider directions
			vec2 horizontalPhase = fract(vec2(vDispTextureCoord.x + uOffset.x, vDispTextureCoord.y + (uOffset.y / 3600.0)) / vec2(1.0, 1.0));
			vec2 verticalPhase = fract(vec2(vDispTextureCoord.x * (uOffset.x / 3600.0), vDispTextureCoord.y + uOffset.y) / vec2(1.0, 1.0));

			// use the correct repeated and offseted texture coords
			vec2 phase = mix(horizontalPhase, verticalPhase, uDirection);
			vec4 displacement = texture2D(displacementTexture, phase);

			// use our varying mouse texture coords
			vec2 mouseTexCoords = vMouseTexCoords;

			float distanceToMouse = distance(mouseTexCoords, textureCoords);

			// calculate an effect that goes from 0 to 1 depenging on uDragEffect and distanceToMouse
			float spreadFromMouse = clamp((uDragEffect * (1.0 - distanceToMouse) - 1.0) + uDragEffect * 2.0, 0.0, 1.0);

			// calculate our fish eye like distortions
			vec2 fishEye = (vec2(textureCoords - mouseTexCoords).xy) * pow(distanceToMouse, 3.0);

			// add a displacement based on our map and our time uniform
			float displacementEffect = displacement.r * 1.25;

			// spread our fish eye and displacement effects from our mouse
			// calculate for both directions
			vec2 horizontalTexCoords = textureCoords;
			horizontalTexCoords.x -= spreadFromMouse * fishEye.x * displacementEffect / 2.0;
			horizontalTexCoords.y += spreadFromMouse * fishEye.y * displacementEffect * 3.0;

			vec2 verticalTexCoords = textureCoords;
			verticalTexCoords.x += spreadFromMouse * fishEye.x * displacementEffect * 3.0;
			verticalTexCoords.y -= spreadFromMouse * fishEye.y * displacementEffect / 2.0;

			// use the right value for the right direction
			textureCoords = mix(horizontalTexCoords, verticalTexCoords, uDirection);


			// get our final colored and BW vec4
			vec4 finalColor = texture2D(renderTexture, textureCoords);
			float grey = dot(finalColor.rgb, vec3(0.299, 0.587, 0.114));
			vec4 finalGrey = vec4(vec3(grey), 1.0);

			// mix our both vec4 based on our spread value
			finalColor = mix(finalColor, finalGrey, spreadFromMouse * finalColor.a);

			float spreadFromMouseAdjusted = spreadFromMouse / sqrt(2.0);

			// apply a grey background where we don't have nothing to draw
			finalColor = mix(vec4(uBgColor.r * spreadFromMouseAdjusted / 255.0, uBgColor.g * spreadFromMouseAdjusted / 255.0, uBgColor.b * spreadFromMouseAdjusted / 255.0, spreadFromMouseAdjusted), finalColor, finalColor.a);

			gl_FragColor = finalColor;
		}
	</script>
	
	<script type="text/javascript" src="js/search.js">
	
	</script>