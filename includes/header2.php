<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav mb-2 mb-lg-0 text-center">
        <li class="navbar-text mx-lg-2 d-flex my-auto mx-auto">
            <span class="mx-2"><b>Hi, <?= $_SESSION['user_name'] ?></b></span>
        </li>
        <li class="nav-item d-flex mx-auto">
            <i class="fas fa-user d-flex align-items-center px-2"></i>
            <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <div class="d-flex mx-4 bg-dark d-none d-lg-block" style="width: 1px;">
            <div class="vr w-4"></div>
        </div>
        <li class="nav-item mx-2 d-flex mx-auto">
            <i class="fas fa-sign-out-alt d-flex align-items-center px-2"></i>
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    </ul>
</div>