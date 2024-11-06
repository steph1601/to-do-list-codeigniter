<?= $this->extend('layouts/main') ?>

<!-- TITLE -->
<?= $this->section('title') ?> TO DO LIST APP <?= $this->endSection() ?>

<!-- MAIN-CONTENT -->
<?= $this->section('content') ?>

<div class="my-5 pt-4">
        <section>
            <h4>
                <?= $page_title ?>
            </h4>
        </section>

        <section>
        <?php if(!empty($tasks)): ?>
            <div class="row row-cols-1 row-cols-md-3 g-3">
                <?php foreach ($tasks as $todo): ?>
                    <div class="col">
                        <div class="card h-100 border-black">
                            <div class="card-body"> 
                                <p class="card-text">
                                    <span class="badge rounded-pill <?= esc($todo['badge_class']) ?> text-uppercase"><?= esc($todo['status_name']) ?></span>
                                </p>
                                <h5 class="card-title"><?= esc($todo['task']) ?></h5>   
                                <a href="/todo/show/<?= $todo['id'] ?>" class="btn btn-success"><i class="fa-regular fa-eye"></i></a>
                                <button class="btn btn-danger delete-task" data-id="<?= $todo['id'] ?>"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                            <div class="card-footer text-body-secondary text-center">
                                <?= $todo['date'] ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
          
            <?php else: ?>
                <div class="d-flex justify-content-center mt-5">
                    <span><h1 class="text-secondary">No Completed Task Yet</h1></span>                  
                </div>
            <?php endif; ?>

        </section>
    </div>

   
<?= $this->endSection() ?>

 

<?= $this->section('scripts') ?>
    
<script>
    $(document).on('click', '.delete-task', function() {
        var taskId = $(this).data('id');

        console.log(taskId);

        Swal.fire({
            title: 'Are you sure?',
            text: "This task will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
               
                $.ajax({
                    url: `/todo/delete/${taskId}`,
                    type: 'DELETE',
                    data: {
                        csrf_test_name: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                willClose: () => {
                                    location.reload();
                                }
                            });
                        } else {
                            // Show error message if delete fails
                            Swal.fire({
                                icon: 'error',
                                title: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("ERROR: " + xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!'
                        });
                    }
                });
            }
        });
    });

</script>

<?= $this->endSection() ?>

