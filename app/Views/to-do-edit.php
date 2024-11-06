<?= $this->extend('layouts/main') ?>

<!-- TITLE -->
<?= $this->section('title') ?> TO DO LIST APP | CREATE <?= $this->endSection() ?>

<!-- MAIN-CONTENT -->
<?= $this->section('content') ?>

    <div class="container">
    <div class="d-flex justify-content-start pt-4 mb-4">
            <a href="/todo" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-arrow-left me-2"></i>Return</a>
        </div>
        <div class="card border-black border-2  bg-warning-subtle">
            <div class="card-header bg-white border-black  bg-warning-subtle">
                <h5>Please Insert the information needed.</h5>
            </div>
            <div class="card-body">
            <form action="/todo/update" method="PUT" id="edit_task" novalidate>
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3 fw-bold">
                            Edit Status:
                            <select id="status" name="status" select class="form-select" aria-label="Default select example">
                                <?php foreach ($statuses as $status): ?>
                                    <option value="<?= esc($status['id']) ?>" <?= $status['id'] == $task['status'] ? 'selected' : '' ?>>
                                        <?= esc($status['status_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="text" id="id" name="id" hidden value="<?= $task['id']?>">
                        <div class="mb-3 fw-bold">
                            <label for="task" class="form-label">Task Name</label>
                            <input type="text" class="form-control border-black" id="task" placeholder="Create a website" name="task" value="<?= esc($task['task']) ?>">
                        </div>
                        <div class="mb-3 fw-bold">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control border-black" id="description" rows="3" name="description" value="<?= esc($task['description']) ?>"><?= esc($task['description']) ?></textarea>
                        </div>

                    <button type="submit" class="btn btn-lg btn-primary btn-large w-100">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
     
     $( "#edit_task" ).on( "submit", function( event ) {
     
     event.preventDefault();
     var id = $(this).find('input[name="id"]').val();

    //  var formE = $(this).serialize();

    //  console.log(formE);
    

     $.ajax({
            method: 'PUT',
            url: `/todo/update/${id}`,
            data: { 
                task: $('#task').val(),
                description: $('#description').val(),
                status: $('#status').val(),
            },
            success: function(response) {
                if(response.status === "success") {
                    Swal.fire({
                    icon: "success",
                    title: response.message,
                    willClose: () => {
            window.location.href = "/todo";
        }
                });
                
            } else {
                Swal.fire({
                    icon: "error",
                    title: response.message,
                });
            }
            },
            error: function(xhr, status, error) {
            console.log("ERROR" + xhr.responseText);
        }
        });



 });
</script>

<?= $this->endSection() ?>