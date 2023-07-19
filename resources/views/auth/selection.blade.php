<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('assets/css/cardstyle.css')}}" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">
    <link rel="icon" href="{{URL::asset('assets/img/graduation-cap.png')}}" type="image/x-icon"/>
    <title>SchoolMax</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="face face1">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-user-secret" aria-hidden="true"></i> 
                    </div>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                        <a class="btn btn-default col-lg-3" title="Admin" href="{{route('login.show','admin')}}">
                            LOGIN AS ADMIN
                        </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="face face1">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                    <a class="btn btn-default col-lg-3" title="Student" href="{{route('login.show','student')}}">
                        LOGIN AS STUDENT
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="face face1">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i> 
                    </div>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                    <a class="btn btn-default col-lg-3" title="Teacher" href="{{route('login.show','teacher')}}">
                        LOGIN AS TEACHER
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="face face1">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i> 
                    </div>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                    <a class="btn btn-default col-lg-3" title="Parent" href="{{route('login.show','parent')}}">
                        LOGIN AS PARENT
                    </a>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
