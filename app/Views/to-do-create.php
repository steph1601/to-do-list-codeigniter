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
                <form action="/todo/store" class="needs-validation" method="POST" id="create_task" novalidate>
                <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="task" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="task" placeholder="Create a website" name="task" required/>
                        <div class="valid-feedback">
                            Task Name is Valid!
                        </div>
                        <div class="invalid-feedback">
                            Please provide a Task Name
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control " id="description" rows="3" name="description"></textarea>
                    </div>

                    <button class="btn btn-lg btn-primary btn-large w-100">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    const form = document.querySelectorAll('.needs-validation');

    const inputName = document.querySelector('#task');
    const validName = document.querySelector('.valid-feedback');
    const invalidName = document.querySelector('.invalid-feedback');

    $( "#create_task" ).on( "submit", function( event ) {
        event.preventDefault();
        if(inputName.value === "") {
                ShowValidation(inputName, "is-invalid");
                return;
        } else {
                ShowValidation(inputName, "is-valid");
        }

        var formE = $(this).serialize();

        console.log(formE);

        $.ajax({
            method: 'POST',
            url: '<?= route_to('todo.store') ?>',
            data: formE,
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

    function ShowValidation(tag, value) {
        if(value === "REMOVEALL") {
            if(tag.classList.contains("is-invalid")) {
                tag.classList.remove("is-invalid");
            }
            if(tag.classList.contains("is-valid")) {
                tag.classList.remove("is-valid");
            }
        } else {
            if(value === "is-valid") {
                if(!tag.classList.contains(value)) {
                    tag.classList.add(value);
                }
                if(tag.classList.contains("is-invalid")) {
                    tag.classList.remove("is-invalid");
                }
            } else {
                if(!tag.classList.contains(value)) {
                    tag.classList.add(value);
                }
                if(tag.classList.contains("is-valid")) {
                    tag.classList.remove("is-valid");
                }
            }
        }
    }
  
//});
</script>

<?= $this->endSection() ?>