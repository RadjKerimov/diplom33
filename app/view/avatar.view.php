<?php $this->layout('body.view', ['title' => 'Загрузить изображение!', 'auth' => $auth]); ?>

    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title"> <i class='subheader-icon fal fa-image'></i> Загрузить аватар</h1>
        </div>
        <?php echo flash()->display(); ?>
        
        
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr"><h2>Текущий аватар</h2></div>
                            <div class="panel-content">
                                <div class="form-group">
                                    <img src="/img/ava/<?= $getOneUsers['img'] ?>" alt="" class="img-responsive" width="150">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Выберите аватар</label>
                                    <input type="file" name="img" id="example-fileinput" class="form-control-file">
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse"><button type="submit" class="btn btn-warning">Загрузить</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>


 
