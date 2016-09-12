<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>e-Buyad: Cashless Payment System</title>

    <!-- site css -->
    {{HTML::style('dist/css/site.min.css')}}

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" type="image/x-icon" href="/images/logo.png" />

    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    {{HTML::script('bootflat-admin/js/html5shiv.js')}}
    {{HTML::script('bootflat-admin/js/respond.min.js')}}
    <![endif]-->
    {{HTML::script('dist/js/site.min.js')}}
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #303641;
            color: #C1C3C6;
        }
    </style>
</head>
<body> 
<div class="container" style="background-color:rgba(81, 85, 93, 0.67); padding-bottom:1%">
    <form class="form-signin" role="form" action="{{URL::to('/dashboard')}}">
        <center style="padding-bottom:10%;">
            <span><img src="/images/logo.png"/></span><br>
            <p><strong style="font-family:Kaushan Script; font-size:4.5em; color:#fff"> e-BUYad </strong></p>
            <p style="font-family:Kaushan Script; font-size:2em; color:#fff">Cashless Payment System</p>
        </center>
    
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                </div>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" />
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class=" glyphicon glyphicon-lock "></i>
                </div>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
            </div>
        </div>

        <label class="checkbox">
            <input type="checkbox" value="remember-me"> &nbsp Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div>
<div class="clearfix"></div>
</body>
</html>
