<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModalLabel">Login to iDiscuss</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="partials/_handlelogin.php" method="post" >
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-secondary ">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>