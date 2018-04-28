<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Chat</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chatbox.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	
    <!-- All the files that are required -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	
	<!-- jQuery UI -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<div class="container-fluid">

<div class="row text-center">
	<div class="chatbox-main-style">

		<h2>ChatBOX</h2>
		
		<div class="row">
			<p class="display-name-p">You are: @placeholder</p>&nbsp;&nbsp;&nbsp;&nbsp;<p class="display-name-p">[Group: @placeholder]</p>
		</div>
	
	</div>
</div>

<div class="row">
		
	<div class="col-md-3">
	</div>
	
	<div class="col-md-6">
	
		<div id="message-container" class="container-fluid message-area-index" style="">
			<?php
			for ($i = 0; $i < 100; ++ $i) {
			?>
			
			<div class="container-fluid individual-message-box">
				<p class="individual-name">@User: </p>
				<p class="individual-message">Message</p>
			</div>
			
			<?php
			}
			?>
		</div>

	</div>
			
	<div class="col-md-3">
	</div>
		
</div>

<div class="row">
	<div class="col-md-3">
	</div>
	
	<div class="col-md-6">
		<form id="send-message-area">
			<textarea class="textarea-index form-control" maxlength = '100'></textarea>
			<div class="pull-right" style="">
			
				<input class="chatbox-send-button" type="submit" value="Send">
				
				<!--<label for="file-upload" class="custom-file-upload">
					<span id="file-label" class="glyphicon glyphicon-paperclip"></span>
				</label>-->
			</div>
			
			<input id="file-upload" class="" type="file" value="Attach">
			
		</form>
	</div>
	
	<div class="col-md-3">
	</div>
</div>

</div>
</body>