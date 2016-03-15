<?php $theme = "login";?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Login Form Template</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url("public/themes/{$theme}/assets/bootstrap/css/bootstrap.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("public/themes/{$theme}/assets/font-awesome/css/font-awesome.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("public/themes/{$theme}/assets/css/form-elements.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("public/themes/{$theme}/assets/css/style.css"); ?>">

        <link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>" >

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url("public/themes/{$theme}/assets/ico/favicon.png"); ?>">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url("public/themes/{$theme}/assets/ico/apple-touch-icon-144-precomposed.png"); ?>">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url("public/themes/{$theme}/assets/ico/apple-touch-icon-114-precomposed.png"); ?>">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url("public/themes/{$theme}/assets/ico/apple-touch-icon-72-precomposed.png"); ?>">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url("public/themes/{$theme}/assets/ico/apple-touch-icon-57-precomposed.png"); ?>">


    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Orange Church</strong></h1>
                            <div class="description">
                              <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                          <div class="form-top">
                            <div class="form-top-left">
                              <h3>Login to Master Calender for Admin</h3>
                                <p>Enter your email and password to log on:</p>
                            </div>
                            <div class="form-top-right">
                              <i class="fa fa-lock"></i>
                            </div>
                            </div>
                            <div class="form-bottom">
                          <form role="form" action="/login/adminLogin/" method="post" class="login-form" id="login-frm">
                            <div class="form-group">
                              <label class="sr-only" for="form-username">Username</label>
                                <input type="text" name="login[username]" placeholder="Username" class="form-username form-control" id="form-username">
                              </div>
                              <div class="form-group">
                                <label class="sr-only" for="form-password">Password</label>
                                <input type="password" name="login[password]" placeholder="Password" class="form-password form-control" id="form-password">
                              </div>
                              <button type="submit" class="btn" id="login-btn" data-loading-text="Logging in ...">Sign in</button>
                          </form>
                        </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <!-- Javascript -->
        <script src="<?php echo base_url("public/themes/{$theme}/assets/js/jquery-1.11.1.min.js"); ?>"></script>
        <script src="<?php echo base_url("public/themes/{$theme}/assets/bootstrap/js/bootstrap.min.js"); ?>"></script>
        <script src="<?php echo base_url("public/themes/{$theme}/assets/js/jquery.backstretch.min.js"); ?>"></script>
        <script src="<?php echo base_url("public/themes/{$theme}/assets/js/scripts.js"); ?>"></script>

        <!--[if lt IE 10]>
            <script src="<?php echo base_url("public/themes/{$theme}/assets/js/placeholder.js"); ?>"></script>
        <![endif]-->


        <script type="text/javascript">
        $(document).ready(function() {
                initGrowls();
        });

        function addGrowlMessage(type, message) {
                var str = '<div class="growl growl-large growl-';
                if (type == 0) {
                        str += 'notice">';
                } else {
                        str += 'error">';
                }
                str += '<div class="growl-close">x</div><div class="growl-title">';
                if (type == 0) {
                        str += 'Success';
                } else {
                        str += 'Error';
                }
                str += '</div>';
                str += '<div class="growl-message">' + message + '</div></div>';
                $('.growl').each(function() { $(this).remove(); });
                $('body').prepend(str);
                initGrowls();
        }

        function initGrowls() {
                $('.growl').fadeIn('slow');
                setTimeout(function() { $('.growl').fadeOut('slow', function() { $(this).remove(); }); }, 4000)
                $('.growl-close').click(function() {
                        $('.growl').fadeOut('slow', function() { $(this).remove(); });
                });
        }
        </script>

        <script type="text/javascript">
            $(document).ready(function() {

                $("#login-btn").click(function(e){
                    e.preventDefault();
                    var frm = $("#login-frm");
                    var btn = $(this);
                    btn.button('loading');

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: frm.attr("action"),
                        data: frm.serialize(), // serializes the form's elements.
                        success: function(data)
                        {
                            console.log(data);
                            console.log(data.status);
                            if(data.status == 1) {
                                addGrowlMessage(data.status, data.message);
                                setTimeout(function(){
                                    btn.button('reset');
                                }, 1000);
                            } else {
                                window.location.href = "/administrator/";
                            }

                        },
                        error: function( jqXHR, textStatus, errorThrown){
                            addGrowlMessage(1, errorThrown);
                            setTimeout(function(){ btn.button('reset'); }, 500);
                        }

                    });

                });

            });
        </script>

    </body>

</html>