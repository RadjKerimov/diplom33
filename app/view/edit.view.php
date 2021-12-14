<?php $this->layout('body.view', ['title' => 'Редактировать профиль! ', 'auth' => $auth]); ?>

<main id="js-page-content" role="main" class="page-content mt-3">
    <div class="subheader">
        <h1 class="subheader-title"><i class='subheader-icon fal fa-plus-circle'></i> Редактировать</h1>
    </div>
    <?php echo flash()->display() ?>

    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="row">
            <section class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Общая информация</h2>
                        </div>

                        <div class="panel-content">
                            <!-- username -->
                            <div class="form-group">
                                <label class="form-label" for="username">Имя</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?= $this->e($getOneUsers['username']) ?>">
                            </div>

                            <div class="form-group">
                                <!-- surname -->
                                <label class="form-label" for="surname">Фамилия</label>
                                <input type="text" name="surname" id="surname" class="form-control" value="<?= $this->e($getOneUsers['surname']) ?>">
                            </div>

                            <!-- works -->
                            <div class="form-group">
                                <label class="form-label" for="works">Место работы</label>
                                <input type="text" name="works" id="works" class="form-control" value="<?= $getOneUsers['works'] ?>">
                            </div>

                            <!-- tel -->
                            <div class="form-group">
                                <label class="form-label" for="tel">Номер телефона</label>
                                <input type="tel<?= $getOneUsers['works'] ?>" name="tel" id="tel" class="form-control" value="<?= $getOneUsers['tel'] ?>">
                            </div>

                            <!-- address -->
                            <div class="form-group">
                                <label class="form-label" for="address">Адрес</label>
                                <input type="text" name="address" id="address" class="form-control" value="<?= $getOneUsers['address'] ?>">
                            </div>

                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-warning">Редактировать</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </form>
</main>