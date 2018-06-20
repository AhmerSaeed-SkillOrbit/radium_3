<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Premier Towels | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?= base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?= base_url(); ?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header">Log In</div>
            <form action="<?= base_url() . 'index.php/login/process' ?>" method="post">
                <div class="body bg-gray">                    
                    <div class="form-group">
                        <h5>
                            <?php
                            if (!is_null($msg)) {
                                echo $msg;
                            }
                            ?>
                        </h5>
                    </div>
                    <div class="form-group">
                        <input id="LoginID" name="LoginID" type="text" class="form-control"  placeholder="Login ID" required>
                    </div>
                    <div class="form-group">
                        <input id="Password" name="Password" type="password" class="form-control" placeholder="Password" required>
                    </div> 
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Log me in</button>  
                </div>
            </form>
        </div>
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>        
    </body>
</html>

