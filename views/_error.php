<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/logo-fav.png">
    <title>Beagle</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" />
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css" />
    <link rel="stylesheet" href="assets/css/app.css" type="text/css" />
</head>

<body class="be-splash-screen">
    <div class="be-wrapper be-error be-error-404">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="error-container">
                    <p><?php echo $exception->getCode() ?> - <?php echo $exception->getMessage() ?></p>
                    <div class="error-number">404</div>
                    <div class="error-description">The page you are looking for might have been removed.</div>
                    <div class="error-goback-text">Would you like to go home?</div>
                    <div class="error-goback-button"><a class="btn btn-xl btn-primary" href="/">Let's go home</a></div>
                    <div class="footer">&copy; 2022 Your Company</div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
        });
    </script>
</body>


</html>