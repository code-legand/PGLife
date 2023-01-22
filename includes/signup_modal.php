<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signup-heading" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="signup-heading">Signup with PGLife</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="signup-form" class="form" role="form" method="post" action="api/signup_submit.php">
                    <div class="container">
                        <div class="row pb-3">
                            <div class="col-2 m-auto">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="col-10 p-0">    
                                <input type="text" class="form-control" name="full_name" placeholder="Full Name" maxlength="30" required>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-2 m-auto">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="col-10 p-0">    
                                <input type="text" class="form-control" name="phone" placeholder="Phone Number" maxlength="10" minlength="10" required>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-2 m-auto">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="col-10 p-0">    
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-2 m-auto">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="col-10 p-0">    
                                <input type="password" class="form-control" name="password" placeholder="Password" minlength="6" required>
                            </div>
                        </div>


                        <div class="row pb-3">
                            <div class="col-2 m-auto">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="col-10 p-0">    
                                <input type="text" class="form-control" name="college_name" placeholder="College Name" maxlength="150" required>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-2 m-auto">
                                I'm a
                            </div>
                            <div class="col-10 p-0">
                                <input type="radio" id="gender-male" name="gender" value="male" />
                                <label for="gender-male">Male</label>
                                <span class="pe-3" ></span>
                                <input type="radio" id="gender-female" name="gender" value="female" />
                                <label for="gender-female">Female</label>
                            </div>
                        </div>

                        <div class="row">
                            <button type="submit" class="btn btn-block btn-primary border border-0" style="background-color: #50c4bc;">Create Account</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- <div class="modal-footer">
                <a class="nav-link" href="#" data-bs-dismiss="modal" data-toggle="modal" data-target="#login-modal" style="color: #50c4bc;"></a>
            </div> -->
            <div class="modal-footer">
                Already have an account?<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#login-modal" style="color: #50c4bc;">Login</a>
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Understood</button> -->
            </div>
        </div>
    </div>
</div>
