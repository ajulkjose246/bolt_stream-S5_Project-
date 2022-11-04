<nav class="navbar navbar-expand-lg bg-color">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="./img/logo.png"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#hero">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Movies
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#new_mov">New Movies</a></li>
            <li><a class="dropdown-item" href="#mal_mov">Malayalam Movies</a></li>
            <li><a class="dropdown-item" href="#tam_mov">Tamil Movies</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex mx-5" role="search">
      <a href="./movie_search.php" class="btn btn-outline-primary">Search <i class="bi bi-search" style="color:blue ;"></i></a>
      </form>
      <form action="#" method="POST">
        <a href="signin.php" class="log-btn scrollto">Login</a>
        <div class="profile-menu">
          <div class="action">
            <img class="usr_pro_pic" src="images/profile.png" />
          </div>
          <div class="menu">
            <div class="profile">
              <img class="usr_pro_pic" src="images/profile.png" />
              <div class="info">
                <h2 class="user_name"></h2>
                <p class="username">@</p>
              </div>
            </div>
            <ul>
              <li>
                <i class="bi bi-person"></i>
                <a href="user_profile.php"> Account</a>
              </li>
              <li>
                <i class="bi bi-box-arrow-in-right"></i>
                <button class="log_out" name="log_out"> Log out</button>
              </li>
            </ul>
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>