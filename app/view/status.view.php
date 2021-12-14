<?php $this->layout('body.view', ['title' => 'Установка текущего статуса!', 'auth' => $auth]); ?>

<main id="js-page-content" role="main" class="page-content mt-3">
    <?php echo flash()->display() ?>
    <div class="subheader">
        <h1 class="subheader-title"><i class='subheader-icon fal fa-sun'></i> Установить статус</h1>
    </div>


    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Установка текущего статуса</h2>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- status -->
                                    <div class="form-group">
                                        <label class="form-label" for="status">Выберите статус</label>

                                        <select name="status" class="form-control" id="status">
                                            <?php foreach ($status as $key => $value) : ?>
                                                <option <?= $getOneUsers['status'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse"><button type="submit" class="btn btn-warning">Set Status</button></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</main>