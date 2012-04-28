<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to xml-blog</title>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
        <base href="http://localhost/denemeler/blog-with-xml/"/>
	<script type="text/javascript">
	function send_article()
	{
		alert($("#entry_title").val());
                alert($("#entry_body").val());
	}
	$(document).ready(function(){
			var count = 1;
			var size=60;
			$("#loginFormLink").click(function(){
				$("#login").fadeTo("slow",1);
			});
			$.post("operations/log_check", { username: $("#LoginUsername").val() , password: $("#LoginPassword").val() },
	                    function(data) {
	                        if(data=="1")
	                        {
	                        	$("#admin_panel").fadeTo(750,1);
	                        	$("#login").fadeTo(750,0);
	                        	$("#loginfooter").fadeTo(750,0);
	                        }
	                    });
           $("#loginBtn").click(function(){
	           	$.post("operations/login_prompt", { username: $("#LoginUsername").val() , password: $("#LoginPassword").val() },
	                    function(data) {
	                        if(data=="1")
	                        {
	                        	alert("login complete");
	                        	$("#admin_panel").fadeTo(750,1);
	                        	$("#login").fadeTo(750,0);
	                        }
	                    });
           });
           $("#sayfa_ekle").click(function(){
           size=500;
           	$.post("operations/add_page_get_contents", {  },
	                    function(data) {
	                        $("#area").html(data);
	                    });
           	$("#admin_panel").animate({
				    height:size +"px"
				    }, 750 );
					$("body").animate({
					  "margin-top":size +"px"
					}, 750 );
					
           });
           $("#panel_slider").click(function(){
           		if(count % 2 == 1)
           		{
           			$("#admin_panel").animate({
				    height:size+"px"
				    }, 750 );
					$("body").animate({
					  "margin-top":size+"px"
					}, 750 );
					$("#panel_menu").fadeTo(750,1);
					$(".editblog").fadeTo(750,1);
                                        $("#area").fadeTo(750,1,function()
                                        {
                                            $("#area").show();
                                        });
					$(this).html('-');
           		}
           		else
           		{
           			$("#admin_panel").animate({
				    height:"20px"
				    }, 1500 );
					$("body").animate({
					  "margin-top":"20px"
					}, 1500 );
					$("#panel_menu").fadeTo(750,0);
					$(".editblog").fadeTo(750,0);
					$("#area").fadeTo(750,0,function(){
                                            $("#area").hide();
                                        });
                                        
					$(this).html('+');
				}
           		count++;
           });
        });
	</script>
	<style type="text/css">


	input,textarea{
	border-radius: 1.5em;
	-webkit-box-shadow: 0 0 8px lightblue;
	}
	body {
		
		background-color: #fff;
		margin: 20px;
		/*margin-top:100px;*/
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	.body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	.container,	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	/*Login Template*/
	div#login{
	 	width: 300px;
	 	background-color: #333333;
	 	border-bottom-left-radius:1.5em;
	 	border-bottom-right-radius:1.5em;
	 	padding-left:10px;
	 	top:0px;
	 	color:white;
	 	position: absolute;
	 	margin:auto;
	 	left:1%;
	 	right:1%;
	 	display:none;
	}
	div#area{
	 	
	 	display:none;
	}
	
	/*Login Template*/
	/*Admin Panel*/
	div#admin_panel{
	top:0px;
	background: #333333;

	height:20px;
	left:20px;
	right:20px;
	margin-left:10px;
	margin-right:10px;
	border-bottom-left-radius: 1.5em;
	border-bottom-right-radius:1.5em;
	padding-left:10px;
	position: absolute;
	display:none;
	color:white;
	}
	div#admin_panel a{
		color:white;
		text-decoration: none;
	}
	div#admin_panel a:hover{
		text-decoration: underline;
		
	}
	div#admin_panel a:visited{
		text-decoration: line-through;
		
	}
	/*Admin Panel*/
	</style>
</head>
<body>
	<div id="admin_panel"><a href="#" id="panel_slider" style="color:white;text-decoration: none;">+</a> 
		<p id="panel_menu" style="display: none;"><a id="sayfa_ekle" href="#">Sayfa ekle</a>  <a href="#">Kullanıcılar</a> <a href="#">Çıkış</a></p>
		<div id="area">
			
		</div>
	</div>
	
	<div id="login">  
	
		<p style="text-align: center;">Please Login</p>
		<p>
		<form action="#" onsubmit="return false;" >
			<table>
				<tr>
					<td>Username:
					</td>
					<td>
					<input type="text" id="LoginUsername" placeholder="Username" />
					</td>
				</tr>
				<tr>
					<td>Password:
					</td>
					<td>
					<input type="password" id="LoginPassword" placeholder="Password" />
					</td>
				</tr>
			</table>
			<input id="loginBtn" type="submit" value="Login" />
			</form>
		</p>
	</div>
	<div id="container" >
		<h1><a href="">Welcome to xml-blog</a></h1>
		<div id="body">
                    {blog_entries}
			<div class="container" id="blog_entry_{id}">
			    <h1>
			    <a href="blogentry/{id}">{title}</a> 
			    <small><font style="text-align: right; font-size: 11px;" color="gray">{date}</font></small> 
			    <a href="#" style="display: none;" class="editblog">Edit</a>
			    </h1>
			    <div class="body">
				    <span> {sender_id}</span>
				    <p>{body}</p>
			    </div>
			</div>
	{/blog_entries}
		</div>
		
		
	</div>
	<p class="footer"> Page rendered in <strong>{elapsed_time}</strong> seconds</p>
		<span id="loginfooter">Blog With Xml <a href="javascript:;" id="loginFormLink">login</a></span>
</body>
</html>