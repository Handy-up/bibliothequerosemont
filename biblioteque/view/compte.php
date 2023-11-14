<?php
require("include/header.php");
?>
<div class="container compte">
    <div class="d-flex justify-content-between w-50 tite_modal">
        <h2>Ma Bibliotèque</h2>
        <button type="button" class="btn btn-dark w-50" data-bs-toggle="modal" data-bs-target="#exampleModal">Nouveau Livre</button>

        <form action="">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send message</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <hr class="my-4 thicker-separator">

    <div class="container w-100 h-auto">
        <div class="container-fluid w-80 h-auto d-flex justify-content-center align-items-center card_list">
            <!--        Cardes-->
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-3 image">
                        <img src="image/book_cover/CoverNotAvailable.jpg" class="img-fluid rounded-start" alt="Couverture">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">Titre Livre</h5>
                            <p class="card-text float-right"><small class="text-body-dark">Mots Clés : pomme boule jeaune</small></p>
                            <p class="card-text">Description : This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago by Username</small></p>
                        </div>
                        <div class="d-flex justify-content-between action_card">
                            <span>Nom Propriétaire</span>
                            <form class="float-end">
                                <button class="btn btn-dark" type="submit">Reserver</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<?php
include("include/footer.php");
?>