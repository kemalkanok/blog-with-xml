<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    <title>Welcome to xml-blog</title>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript">
        function showblogentry( a)
        {
            $(".container").fadeTo(750,0);
            var string = $("#blog_entry_"+a).html();
            string.replace("<a href=\"javascript:showblogentry('+a+');\">","");
            string.replace("</a>","");
            $("#container").html(string);
            //$("#container").fadeTo(750,1);
        }
        $(document).ready(function(){
            var count = 1;
            $("#loginFormLink").click(function(){
                $("#login").fadeTo("slow",1);
            });
			
            $("#loginBtn").click(function(){
                $.post("operations/login_prompt", { username: $("#LoginUsername").val() , password: $("#LoginPassword").val() },
                function(data) {
                    if(data=="1")
                    {
                        alert("login complete");
                    }
                });
            });
            $("#panel_slider").click(function(){
                if(count % 2 == 1)
                {
                    $("#admin_panel").animate({
                        height:"60px"
                    }, 750 );
                    $("body").animate({
                        "margin-top":"60px"
                    }, 750 );
                    $("#panel_menu").fadeTo(750,1);
                    $(".editblog").fadeTo(750,1);
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
                    $(this).html('+');
                }
                count++;
            });
        });
    </script>
    <style type="text/css">


        input{
            border-radius: 2em;
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
            border-radius: 2em;
            padding-left:10px;
            color:white;
            position: absolute;
            margin:auto;
            left:1%;
            right:1%;
            display:none;
        }

        /*Login Template*/
        /*Admin Panel*/
        div#admin_panel{
            top:0px;
            background: #333333;

            width:100%;
            height:20px;
            position: fixed;

            border-bottom-left-radius: 2em;
            border-bottom-right-radius: 2em;
            padding-left:10px;


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
    <p id="panel_menu" style="display: none;"><a href="#">Sayfalar</a>  <a href="#">Kullanıcılar</a> <a href="#">Çıkış</a></p>
</div>
<div id="login">  
    <p style="text-align: center;">Please Login</p>
    <p>
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
    <input id="loginBtn" type="button" value="Login" />
</p>
</div>
<div id="container" >
    <h1><a href="../">Welcome to xml-blog</a></h1>
    <div id="body">
        {blog_entries}
        <div class="container" id="blog_entry_{id}">
            <h1>
                {title} 
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
Blog With Xml <a href="javascript:;" id="loginFormLink">login</a>
</body>
</html>