<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to xml-blog</title>
	<base href="http://localhost:81/blog-with-xml/blog-with-xml/">
	<script src="http://code.jquery.com/jquery-latest.js"></script>	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/blog.js"></script>

</head>
<body>
	<div class="modal logout_form hide fade">
	    <div class="modal-body">
	    	<center>
	    		<img src="img/loading.gif" alt="">
	    	</center>
	    </div>
	</div>
	<div class="modal login_form hide fade">
	    <div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    	<h3>Login</h3>
	    </div>
	    <div class="modal-body">
	    	    <form class="form-horizontal">
				    <div class="control-group">
					    <label class="control-label" for="inputUser">Username</label>
					    <div class="controls">
					    	<input type="text" id="inputUser" placeholder="Username">
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="inputPassword">Password</label>
					    <div class="controls">
					    	<input type="password" id="inputPassword" placeholder="Password">
					    </div>
					</div>
				</form>
	    </div>
	    <div class="modal-footer">
	    	<button class="btn btn-primary">Login</button>
	    </div>
    </div>
	<div class="container">
		<div class="hero-unit" style="padding-bottom: 5px;padding-top: 5px;">
			<h1>Welcome to xml-blog</h1>
			<p>
				What we use to Developed THAT!
				<p>
					XML,MVC,BOOTSTRAP,JQUERY
				</p>
			</p>
			<p>
				 <a href="" class="btn btn-primary btn-large">
				Home Page
				</a>
			</p>
		</div>
	
		
		<div class="row">
			{blog_entries}
	        <div class="well" style="margin-left: 20px;" id="blog_entry_{id}">
	          <h2>{title}</h2>
	          <p>
	          	<span> {sender_id}</span>
				    <p>{body}</p>
	          </p>
	          <p>
	          	<a class="btn btn-primary" href="blogentry/{id}">View details &raquo;</a>
	          </p>
	        </div>
	        {/blog_entries}
    	</div>
    	<div class="well navbar-fixed-bottom">
			<a href="javascript:;" class="show login">Login</a>
			<a href="javascript:;" class="hide admin logout">Logout</a>
		</div>
	</div>
	

		
		
</body>
</html>