<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title><?=(new Settings)->info('title_web');?></title>

    <meta name="description" content="<?=(new Settings)->info('title_web');?>">
    <meta name="author" content="DUNGA">
    <meta name="robots" content="index, dofollow">

    <meta property="og:title" content="<?=(new Settings)->info('title_web');?>">
    <meta property="og:site_name" content="<?=(new Settings)->info('title_web');?>">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    
    <link rel="shortcut icon" href="<?=(new Settings)->info('favicon');?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?=(new Settings)->info('favicon');?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=(new Settings)->info('favicon');?>">
    <!-- END Icons -->
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
    <!-- <link rel="stylesheet" id="css-main" href="/public/assets/css/dashmix.min.css?v=<?=(new Settings)->info('version');?>"> -->
    <link rel="stylesheet" id="css-main" href="/public/assets/css/custom.css?v=<?=(new Settings)->info('version');?>">
    <link rel="stylesheet" id="css-main" href="/public/assets/css/dashmix.css?v=<?=(new Settings)->info('version');?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://alcdn.msauth.net/browser/2.23.0/js/msal-browser.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css?v=<?=(new Settings)->info('version');?>" rel="stylesheet" type="text/css" />
    <style>
    .sweet-alert {
      background: url('img/bg-pattern.png');
      border-radius: 2px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    }

    body {
      cursor: url('img/click.cur'), progress;
    }

    a:hover,
    button:hover {
      cursor: url('img/hover.cur'), progress;
    }

    .swal-wide {
      width: 1000px !important;
    }
  </style>
</head>