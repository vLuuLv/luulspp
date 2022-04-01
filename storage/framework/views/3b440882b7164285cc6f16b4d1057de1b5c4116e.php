<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/login.css" rel="stylesheet">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title); ?></title>
</head>

<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <?php echo $__env->make('sidenav.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <section class="home-section pe-5">
        <div class="d-flex bd-highlight mt-2">
            <div class="p-2 flex-grow-1 bd-highlight pd-1">
                <h4 class="ms-4 mt-3"><b>Outlet</b></h4>
            </div>
            <div class="p-1 d-flex bd-highlight pt-3 ">
                <form action="/outlets" class="d-inline-flex">
                    <input class="form-control find-i mb-2" type="text" placeholder="Search..." name="find" value="<?php echo e(request('find')); ?>">
                    <button type="submit" class="find p-2 ms-auto me-2 ps-3 pe-3 mb-2"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
        <hr class="mt-2 mb-2 ms-4">
        <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show ms-4" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if($outlet->count()): ?>
        <?php $__currentLoopData = $outlet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex bd-highlight mt-2 pt-2 ms-3">
            <div class="p-2 flex-grow-1 bd-highlight pd-1">
                <ul class="list-group">
                    <li class="list-group-item" data-bs-toggle="modal" data-bs-target="#modal_<?php echo e($data->id); ?>">
                        <i class='bx bx-dots-vertical-rounded dots ms-2'></i>
                        <?php echo e($data->name); ?>

                    </li>
                </ul>
            </div>
        </div>
        <hr class="mb-2 mt-1 ms-5 me-2">
        
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <h5 class="text-center mt-5">No outlet found.</h5>
        <?php endif; ?>
    </section>
    <?php $__currentLoopData = $outlet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="modal " id="modal_<?php echo e($data->id); ?>" tabindex="-1" aria-labelledby="modal_<?php echo e($data->id); ?>Label" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modal_<?php echo e($data->id); ?>Label">Outlet Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0" style="background-color: #e4e9f7">
                        <div class="container p-0 py-3 d-flex justify-content-center">
                            <div class="card">
                                <div class="card-body py-4 px-4 pb-2">
                                    <h2 class="text"><?php echo e($data->name); ?></h2>
                                    <p class="card-text text-muted"><?php echo e($data->address); ?></p> <a href="<?php echo e(url('product/'.$data->name)); ?>" class="btn btn-dark">Check Product</a>
                                    <footer class="footer text-muted pt-2">
                                        <p class="mytext mt-3">Phone :<br><?php echo e($data->telp); ?></p>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">      
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script-unopen.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
         
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                $(this).remove(); 
            });
        }, 1000);
         
        });
        </script>
</body>

</html><?php /**PATH C:\Users\KinG\Downloads\Project\laundry\resources\views/outlet/outlet.blade.php ENDPATH**/ ?>