<!-- credited by Developer Aaron Vanston open source snippets quoted from -- 
https://speckyboy.com/custom-file-upload-fields/ -->
<?php
if (!isset($_COOKIE['id'])){
	echo "<script
			type='text/javascript'>
				window.location= \"error.php\";
				 </script>";
	
}

?>


<style>

body {
  font-family: sans-serif;
  background-color: #eeeeee;
}

.file-upload {
  background-color: transparent;
  width: 85%;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: rgba(168,168,168,0.5);
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #545454;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #9e9998;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #ffffff;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #d4d0cf;
  border: 4px dashed #ffbeb5;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #ffffff;
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: transparent;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #664b47;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #ba948f;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}

</style>


<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


<form method="POST" action="upload.php" class="form-signin" enctype="multipart/form-data">
<br>
<div class="file-upload">
  <!-- <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button> -->
  
  <button class="file-upload-btn" type="submit" name="upload">Add</button>

  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name='file' onchange="readURL(this);" accept="image/*" />
    <div class="drag-text">
      <h3>Drag and drop a file or select add Image</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" onerror="this.src='https://www.parentmap.com/images/article/8868/iStock_000036992964_Medium.jpg'" loading="lazy" />
	<text id="text"></text>
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
</div>

</form>


	<script type="text/javascript">
	
	function readURL(input) {
	  if (input.files && input.files[0]) {

		var reader = new FileReader();
		
		reader.onload = function(e) {
		  $('.image-upload-wrap').hide();
		  
		  $('.file-upload-image').attr('src', e.target.result);
		  $('.file-upload-content').show();

		  $('.image-title').html(input.files[0].name);
		};

		reader.readAsDataURL(input.files[0]);

	  } else {
		removeUpload();
	  }
	}

	function removeUpload() {
	  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
	  $('.file-upload-content').hide();
	  $('.image-upload-wrap').show();
	}
	$('.image-upload-wrap').bind('dragover', function () {
			$('.image-upload-wrap').addClass('image-dropping');
		});
		$('.image-upload-wrap').bind('dragleave', function () {
			$('.image-upload-wrap').removeClass('image-dropping');
	});


	
	</script>