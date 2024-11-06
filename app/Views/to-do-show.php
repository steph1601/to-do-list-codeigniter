<?= $this->extend('layouts/main') ?>

<!-- TITLE -->
<?= $this->section('title') ?> TO DO LIST APP<?= $this->endSection() ?>

<!-- MAIN-CONTENT -->
<?= $this->section('content') ?>

    <div class="container">

        <div class="d-flex justify-content-start pt-4">
            <a href="/todo" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-arrow-left me-2"></i>Return</a>
        </div>
        <div class="position-absolute top-50 start-50 translate-middle bg-warning-subtle pt-4 w-25">
        <div class="container text-end text-secondary-emphasis">
          <small>  
            <?= esc($task['date']) ?> <br>
            <?= esc($task['time']) ?> <br>
          </small> 
        </div>

        <hr class="border border-primary border-1 opacity-50">
        <hr class="border border-primary border-1 opacity-50">

        <div class="container">
            <span class="badge rounded-pill <?= esc($task['badge_class']) ?> text-uppercase"><?= esc($task['status_name']) ?></span>
        </div>

        <hr class="border border-primary border-1 opacity-25">

        <div class="container">
            <span class="fw-bold"><?= esc($task['task']) ?></span>
        </div>
    
        <hr class="border border-primary border-1 opacity-25">

        <div class="container">
            <span class="text-secondary fst-italic"><?= esc($task['description']) ?></span>
        </div>

        <hr class="border border-primary border-1 opacity-50">
        <hr class="border border-primary border-1 opacity-50">

        <div class="container pt-3"></div>
        </div>
       
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>


<?= $this->endSection() ?>