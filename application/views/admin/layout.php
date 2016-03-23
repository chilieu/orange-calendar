<html>

<head>
    <title>Orange Church Master Calendar</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>" >
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-datetimepicker.css'); ?>" >

     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
    <script type="text/javascript" src="<?php echo base_url('public/js/jquery-2.1.1.min.js'); ?>"></script>


    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="<?php echo base_url('public/js/moment-with-locales.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/bootstrap-datetimepicker.js'); ?>"></script>


    <script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>

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
            setTimeout(function() { $('.growl').fadeOut('slow', function() { $(this).remove(); }); }, 5000)
            $('.growl-close').click(function() {
                    $('.growl').fadeOut('slow', function() { $(this).remove(); });
            });
    }
    </script>

</head>

<body>
<?=$this->load->view('admin/includes/header')?>
    <div class="container">
    <?=@$_body?>
    </div><!-- /.container -->

</body>

</html>