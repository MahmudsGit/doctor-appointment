<nav class="navbar navbar-expand-lg bg-dark pl-5 pr-5 doctor-container">
    <div class="container-fluid">
      <a class="navbar-brand text-info" href="#">Doctor Appointment</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-menu">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link text-secondary active" aria-current="page" href="#">Home</a>
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