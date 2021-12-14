<?php $this->layout('body.view', ['title' => 'Профиль пользывателя! ', 'auth' => $auth]); ?>

<main id="js-page-content" role="main" class="page-content mt-3">
    <div class="subheader">
        <h1 class="subheader-title"><i class='subheader-icon fal fa-user'></i> <?php echo $getOneUsers['username'] . ' ' . $getOneUsers['surname'] ?></h1>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-6 m-auto">
            <!-- profile summary -->
            <div class="card mb-g rounded-top">
                <div class="row no-gutters row-grid">
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center justify-content-center p-4">
                            <img src="img/ava/<?= $this->e($getOneUsers['img']) ?>" class="rounded-circle shadow-2 img-thumbnail" alt="">
                            <h5 class="mb-0 fw-700 text-center mt-3"><?php echo $getOneUsers['username'] . ' ' . $getOneUsers['surname'] ?></h5>
                            <div class="mt-4 text-center demo">
                                <a href="javascript:void(0);" class="fs-xl" style="color:#C13584"><i class="fab fa-instagram"></i></a>
                                <a href="javascript:void(0);" class="fs-xl" style="color:#4680C2"><i class="fab fa-vk"></i></a>
                                <a href="javascript:void(0);" class="fs-xl" style="color:#0088cc"><i class="fab fa-telegram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 text-center">
                            <a href="tel:<?= $this->e($getOneUsers['tel']) ?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mobile-alt text-muted mr-2"></i> <?= $this->e($getOneUsers['tel']) ?></a>
                            <a href="mailto:<?= $this->e($getOneUsers['email']) ?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mouse-pointer text-muted mr-2"></i> <?= $this->e($getOneUsers['email']) ?></a>
                            <address class="fs-sm fw-400 mt-4 text-muted">
                                <i class="fas fa-map-pin mr-2"></i> <?= $this->e($getOneUsers['address']) ?>
                            </address>
                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <a href="/edit/<?= $this->e($getOneUsers['id']) ?>" class="btn btn-warning">Редактировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>