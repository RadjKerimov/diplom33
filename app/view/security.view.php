<?php $this->layout('body.view', ['title' => 'Безопасность! ', 'auth' => $auth]); ?>

<main id="js-page-content" role="main" class="page-content mt-3">
    <?php echo  flash()->display(); ?>
    <div class="subheader"><h1 class="subheader-title"><i class='subheader-icon fal fa-lock'></i> Безопасность </h1></div>
    
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr"><h2>Обновление эл. адреса и пароля</h2></div>
                        <div class="panel-content">
                            <!-- email -->
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Email</label>
                                <input type="text" name="email" id="simpleinput" class="form-control" value="<?= $getOneUsers['email']?>">
                            </div>

                            <!-- password -->
                            <div class="form-group">
                                <label class="form-label" for="password">Пароль</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <!-- password confirmation-->
                            <div class="form-group">
                                <label class="form-label" for="newPassword">Подтверждение пароля</label>
                                <input type="password" name="newPassword" id="newPassword" class="form-control">
                            </div>


                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-warning">Изменить</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</main>




