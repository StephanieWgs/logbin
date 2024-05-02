<!-- navbar -->
<header class="navbar sticky-top p-0">
    <nav class="bg-white container-xxl p-0">
        <div class="container-fluid shadow-sm p-2">
            <div class="row">
                <div class="col">
                    <button class="navbar-toggler ms-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h4 class="offcanvas-title" id="offcanvasNavbarLabel">What are you looking for?</h4>
                            <button type="button" class="btn-close me-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="home.php">
                                            <img src="assets/img/home.svg">
                                            <h6 style="display: inline;" class="align-middle ms-2">Home</h6>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">
                                            <img src="assets/img/setting.svg">
                                            <h6 style="display: inline;" class="align-middle ms-2">Settings</h6>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <!-- Modal Trigger -->
                                        <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#logout">
                                            <img src="assets/img/logout.svg">
                                            <h6 style="display: inline;" class="align-middle ms-2">Logout</h6>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col text-end ">
                    <a class="navbar-brand" href="home.php">
                        <img src="assets/img/logo.svg" width="30" height="24">
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Modal -->
<div class="modal fade" id="logout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col text-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <h5>Are you sure you want to leave us ?</h5>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal"> No ! </button>
                <button type="button" class="btn btn-primary fw-semibold" onclick="window.location.href='logout.php';">Yes :(</button>
            </div>
        </div>
    </div>
</div>

<!-- end of navbar -->