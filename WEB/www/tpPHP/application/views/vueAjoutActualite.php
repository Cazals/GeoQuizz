<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
</head>
<body>

<form class="form-horizontal" action="<?php echo base_url("index.php/Actualite/newadd"); ?>" method="post">

		<div class="form-group">
		  <label class="control-label col-sm-2" for="Title">Title:</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" id="Title" placeholder="Enter Title" name="Title">
		  </div>
		</div>
		
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="UrlImg">UrlImg:</label>
		  <div class="col-sm-10">          
			<input type="text" class="form-control" id="UrlImg" placeholder="Enter UrlImg" name="UrlImg">
		  </div>
		</div>
		
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="Content">Content:</label>
		  <div class="col-sm-10" style="min-height=200px">          
			<input type="text" class="form-control" id="Content" placeholder="Enter Content" name="Content">
		  </div>
		</div>
		
		
		<div class="form-group">
		  <label class="control-label col-sm-2" for="pwd">Date:</label>
		  <div class="col-sm-10">          
			<input type="date" class="form-control" id="DateActu" placeholder="Enter Date" name="DateActu">
		  </div>
		</div>
		

		  </div>
		</div>
		<div class="form-group">        
		  <div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Submit</button>
		  </div>
		</div>
</form>

</body>
</html>



