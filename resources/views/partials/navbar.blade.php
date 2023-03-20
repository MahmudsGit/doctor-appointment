<div class="container-fluid bg-dark">
  <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <nav class="navbar navbar-expand-lg  pl-5 pr-5 doctor-container">
          <div class="container-fluid">
            <a class="navbar-brand text-info ml-4" href="{{ url('/') }}">Doctor Appointment</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-menu">
              <div class="collapse navbar-collapse mr-2" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link text-secondary" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-secondary" href="{{ route('doctor.index') }}">Doctor</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-secondary" href="#">Appointment</a>
                    </li>
                  </ul>
                </div>
            </div>
          </div>
        </nav>
      </div>
  </div>
</div>
