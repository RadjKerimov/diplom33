<?php $this->layout('body.view', ['title' => 'Добавить пользователя!', 'auth' => $auth]); ?>



<main id="js-page-content" role="main" class="page-content mt-3">
    <?php echo flash()->display() ?>
    <div class="subheader">
        <h1 class="subheader-title"><i class='subheader-icon fal fa-plus-circle'></i> Добавить пользователя</h1>
    </div>


    <form action="<?= $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data" method="POST">
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
                                <input type="text" name="username" id="username" class="form-control">
                            </div>

                            <!-- surname -->
                            <div class="form-group">
                                <label class="form-label" for="surname">Фамилия</label>
                                <input type="text" name="surname" id="surname" class="form-control">
                            </div>

                            <!-- title -->
                            <div class="form-group">
                                <label class="form-label" for="works">Место работы</label>
                                <input type="text" name="works" id="works" class="form-control">
                            </div>

                            <!-- tel -->
                            <div class="form-group">
                                <label class="form-label" for="tel">Номер телефона</label>
                                <input type="text" name="tel" id="tel" class="form-control">
                            </div>

                            <!-- address -->
                            <div class="form-group">
                                <label class="form-label" for="address">Адрес</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <section class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Безопасность и Медиа</h2>
                        </div>
                        <div class="panel-content">
                            <!-- email -->
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>

                            <!-- password -->
                            <div class="form-group">
                                <label class="form-label" for="password">Пароль</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>


                            <!-- status -->
                            <div class="form-group">
                                <label class="form-label" for="status">Выберите статус</label>
                                <select name="status" class="form-control" id="status">
                                    <?php foreach ($status as $key => $value) : ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <!-- <input type="hidden" name="deleteImg" value="" /> -->
                                <label class="form-label" for="img">Загрузить аватар</label>
                                <input type="file" name="img" id="img" class="form-control-file">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3  mb-4 mr-4 d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                </div>
            </section>
        </div>
    </form>
</main>