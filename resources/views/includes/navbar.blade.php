 <!-- Navbar -->
 <div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
        <a href="#" class="navbar-brand">
        <img src="{{url('frontend/images/logo_travellz@2x.png')}}" alt="Logo Travellz">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item mx-md-2">
                    <a href="{{route('home')}}" class="nav-link active">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#" class="nav-link">Paket Travel</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Services</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Link1</a>
                        <a href="#" class="dropdown-item">Link2</a>
                        <a href="#" class="dropdown-item">Link3</a>
                    </div>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#" class="nav-link">Testimonial</a>
                </li>
            </ul>

           @guest
                <!-- Mobile Button -->
            <form action="" method="POST" class="form-inline d-sm-block d-md-none">
                @csrf
            <button class="btn btn-login my-2 my-sm-0 px-4" type="button" 
            onclick="event.preventDefault(); location.href='{{url('login')}}';">
                    Masuk
                </button>
            </form>

            <!-- Desktop Button -->
            <form action="" method="post" class="form-inline my-2 my-lg-0 d-none d-md-block">
                @csrf
                <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" 
                onclick="event.preventDefault(); location.href='{{url('login')}}';">
                    Masuk
                </button>
            </form>
           @endguest

           @auth
           <!-- Mobile Button -->
       <form action="{{url('logout')}}" method="POST" class="form-inline d-sm-block d-md-none">
           @csrf
       <button class="btn btn-login my-2 my-sm-0 px-4" type="submit">
               Keluar
           </button>
       </form>

       <!-- Desktop Button -->
       <form action="{{url('logout')}}" method="post" class="form-inline my-2 my-lg-0 d-none d-md-block">
           @csrf
           <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
               Keluar
           </button>
       </form>
      @endauth
        </div>
    </nav>
</div>
<!-- Akhir Navbar -->