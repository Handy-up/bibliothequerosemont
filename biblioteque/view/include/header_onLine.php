<div class="container-fluid head_online">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="index.php" class="logo_red">
                    <img src="image/rosemont_red_logo.png" alt="Logo collège de Rosemont">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">User Name</h5>
<!--                        <img src="image/book.png" class="rounded-circle" alt="...">-->
                        <button type="button" class="btn btn-danger btn-close " data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <?php
                            include "nav.php"
                            ?>
                        </ul>
                        <div class="profile">
                            <span class="text-white">En ligne li i a 15 min  </span>
                            <img src="image/profil.jpeg" class="rounded-circle" tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Dismissible popover" data-bs-content="And here's some amazing content. It's very engaging. Right?" width="54" height="55" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </nav>
</div>
