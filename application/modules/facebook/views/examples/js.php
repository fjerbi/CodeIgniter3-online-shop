<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Facebook PHP SDK for CodeIgniter - Javascript SDK login example</title>

	<style>
		body {
			padding: 0;
			margin: 0;
			font-family: Helvetica, Sans-serif;
			font-size: 16px;
			color: #333;
			line-height: 1.5;
		}

		.wrapper {
			width: 800px;
			margin: 60px auto;
			border: 1px solid #eee;
			background: #fcfcfc;
			padding: 0 20px 20px;
			box-shadow: 1px 1px 2px rgba(0,0,0,0.1);
		}

		h1, h3 {
			text-align: center;
		}

		.login,
		.form {
			text-align: center;
		}

		.login button,
		input[type="submit"] {
			border: none;
			background: #2F5B85;
			color: #fff;
			font-size: 18px;
			padding: 10px 20px;
			margin: 20px auto;
			cursor: pointer;

			transition: background .6s ease;
		}

		.login button:hover,
		input[type="submit"]:hover {
			background: #999;
		}

		textarea {
			width: 96%;
			height: 200px;
			background: #fff;
			border: 1px solid #ccc;
			padding: 2%;
		}

		.form {display:none;}

		.note {
			font-size: 12px;
			color: #888;
		}
	</style>
</head>
<body>

<div class="wrapper">

	<h1>Facebook PHP SDK for CodeIgniter</h1>
	<h3>Javascript SDK login example</h3>

	<p>Simple example how you can use the Facebook PHP SDK for CodeIgniter together with the Facebook Javascript SDK and the login to Facebook functionality.</p>

	<p><strong>For this example to work, make sure you have set 'facebook_login_type' as 'js' in the config file and have <i>publish_actions</i> permissions!</strong></p>

	<p>
		This example code do 4 things
		<ol>
			<li>Check if the user is logged in to Facebook on page load.</li>
			<li>If user are logged in, display form to user to publish to their wall.</li>
			<li>If user is not logged in, display login button.</li>
			<li>Display the form after login and publish to users wall when subbmitting form without any page refresh</li>
		</ol>
	</p>

	<div class="login">
		<button>Login</button>
	</div>

	<div class="form">
		<form class="post-to-wall">
			<textarea name="message" placeholder="Type some text here and submit to post to your wall"></textarea>
			<input type="submit" name="submit" value="Post" />
		</form>
	</div>

	<p class="note"><i>Note: You can publish text posts to a users wall using only the Javascript SDK. This is ONLY an example on how the Javascript SDK can work togheter with the PHP SDK to publish and/or read information and content.</i></p>


</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
	// Initiate Facebook JS SDK
	window.fbAsyncInit = function() {
		FB.init({
			appId   : '<?php echo $this->config->item('facebook_app_id'); ?>', // Your app id
			cookie  : true,  // enable cookies to allow the server to access the session
			xfbml   : false,  // disable xfbml improves the page load time
			version : 'v2.5', // use version 2.4
			status  : true // Check for user login status right away
		});

		FB.getLoginStatus(function(response) {
			console.log('getLoginStatus', response);
			loginCheck(response);
		});
	};

	// Check login status
	function statusCheck(response)
	{
		console.log('statusCheck', response.status);
		if (response.status === 'connected')
		{
			$('.login').hide();
			$('.form').fadeIn();
		}
		else if (response.status === 'not_authorized')
		{
			// User logged into facebook, but not to our app.
		}
		else
		{
			// User not logged into Facebook.
		}
	}

	// Get login status
	function loginCheck()
	{
		FB.getLoginStatus(function(response) {
			console.log('loginCheck', response);
			statusCheck(response);
		});
	}

	// Here we run a very simple test of the Graph API after login is
	// successful.  See statusChangeCallback() for when this call is made.
	function getUser()
	{
		FB.api('/me', function(response) {
			console.log('getUser', response);
		});
	}

	$(function(){
		// Trigger login
		$('.login').on('click', 'button', function() {
			FB.login(function(){
				loginCheck();
			}, {scope: '<?php echo implode(",", $this->config->item('facebook_permissions')); ?>'});
		});

		$('.form').on('submit', '.post-to-wall', function(e) {
			e.preventDefault();

			var formdata = $(this).serialize();

			$.ajax({
				url: '/example/post',
				data: formdata,
				type: 'POST',
				dataType: 'json',
				success: function(response) {
					console.log(response);
					if (response.id)
					{
						$('.form').html('<p>Post submitted successfully.</p>');
					}
					else
					{
						$('.form').html('<p>Something happened, please try again!.</p>');
					}
				}

			})
		});
	});

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>
