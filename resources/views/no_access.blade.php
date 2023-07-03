
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>No Access</title>
    <style>
        body{
            display:flex;
            align-items:center;
            justify-content:center;
            height: 100vh;
            font-family:Arial, Helvetica, sans-serif;
        }
        .main{
            text-align:center;

        }
        .main img{
            width:200px;
        }
        .main a{
            background-color:#c23c3c;
            text-decoration:none;
            padding:10px 20px;
            color:#fff;
            border-radius:3px;
            margin-top:15px;
            display:inline-block;
            transition:all .3s ease;
        }
        .main a:hover{
            background-color:#e94444;
        }
    </style>
</head>
<body>

<div class="main">
    <img src="{{ asset('adminassets/img/forbidden.png') }}" alt="">
    <h2>You Don't have access to this page</h2>
    <a href="{{ url('/') }}">Go Home</a>
</div>

</body>
</html>

