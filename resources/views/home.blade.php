<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Mail To Code</title>
    <link rel="stylesheet" href="homeAssets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="77" style="background-color:white;" >
    <nav class="navbar navbar-light navbar-expand-md fixed-top" id="mainNav" style="background-color: transparent;">
        <div class="container"><a class="navbar-brand" href="{{route('home')}}">Mail To code</a>
            <button data-bs-toggle="collapse" class="navbar-toggler navbar-toggler-right" data-bs-target="#navbarResponsive" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" value="Menu" style="color: white;">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    
                      <li class="nav-item nav-link"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                      <li class="nav-item nav-link"><a class="nav-link" href="{{route('register')}}">Register</a></li>
     
                    
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="height: 100%;background: linear-gradient(45deg, rgb(2, 105, 164), red) ;">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h1 class="brand-heading">Mail To Code</h1>
                        <p class="intro-text">A new concept to prevent spam email.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!--<ul class="navbar-nav ms-auto">
    <Link v-if="$page.props.user" :href="route('dashboard')" class="nav-link">
        Dashboard
    </Link>
    <template v-else>
        <li class="nav-item nav-link">
            <Link :href="route('login')" class="nav-link">
                Log in
            </Link>
        </li>
        <li class="nav-item nav-link">
            <Link v-if="canRegister" :href="route('register')" class="nav-link">
                Register
            </Link>
        </li>
    </template>
</ul>-->