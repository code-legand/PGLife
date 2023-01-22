<div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login-Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="login-Label">Login with PGLife</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="login-form" class="form" role="form" method="post" action="api/login_submit.php">
                <div class="container">
                    <div class="row pb-3">
                        <div class="col-2 m-auto">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="col-10 p-0">    
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-2 m-auto">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="col-10 p-0">    
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary border border-0" style="background-color: #50c4bc;">Login</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#signup-modal" style="color: #50c4bc;">Click here</a> to register a new account
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
        </div>
        </div>
    </div>
</div>
