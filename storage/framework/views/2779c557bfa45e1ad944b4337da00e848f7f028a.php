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
            <div class="p-1 d-flex bd-highlight pt-3">
                <form action="/outlet" class="d-inline-flex">
                    <input class="form-control find-i mb-2" type="text" placeholder="Search..." name="find" value="<?php echo e(request('find')); ?>">
                    <button type="submit" class="find p-2 ms-auto me-2 ps-3 pe-3 mb-2"><i class="bi bi-search"></i></button>
                </form>
                    <button type="button" class="create p-2 ms-auto me-1 pe-3 mb-2 d-inline-flex" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-plus-lg me-1"></i>Create</button>
            </div>
        </div>
        <hr class="mt-2 mb-3 ms-4">
        <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show ms-4" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if($outlet->count()): ?>
        <?php $__currentLoopData = $outlet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex bd-highlight mt-1 pt-1 ms-3">
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
        <form class="mt-1" action="/outlet" method="post">
            <div class="modal-dialog">
            <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Outlet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #e4e9f7">
                        <?php echo csrf_field(); ?>
                        <div class="mb-2">
                            <label for="name" class="mb-1 fc">Name</label>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" placeholder="Pondok Jaya" autofocus required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-2">
                            <label for="telp" class="mb-1 fc">Phone Number</label>
                        <input type="tel" name="telp" value="<?php echo e(old('telp')); ?>" class="form-control <?php $__errorArgs = ['telp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="telp" placeholder="0812345678" required>
                        <?php $__errorArgs = ['telp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-2">
                            <label for="address" class="mb-1 fc">Address</label>
                            <textarea class="form-control" name="address" placeholder="Jalan Panda II" id="address" style="height: 100px" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Done</button>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <?php $__currentLoopData = $outlet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="modal " id="modal_<?php echo e($data->id); ?>" tabindex="-1" aria-labelledby="modal_<?php echo e($data->id); ?>Label" aria-hidden="true" >
        
            <div class="modal-dialog">
            <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
                <div class="modal-header">
                <h5 class="modal-title" id="modal_<?php echo e($data->id); ?>Label">Outlet Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #e4e9f7">
                        <?php echo csrf_field(); ?>
                        <div class="mb-2">
                            <label for="name" class="mb-1 fc">Name</label>
                        <input disabled readonly type="text" name="name" value="<?php echo e($data->name); ?>" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" placeholder="Pondok Jaya" autofocus required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-2">
                            <label for="telp" class="mb-1 fc">Phone Number</label>
                        <input disabled readonly type="tel" value="<?php echo e($data->telp); ?>" name="telp" class="form-control" id="telp" placeholder="0812345678" required>
                        </div>
                        <div class="mb-2">
                            <label for="address" class="mb-1 fc">Address</label>
                            <textarea disabled readonly class="form-control" name="address" placeholder="Jalan Panda II" id="address" style="height: 100px" required><?php echo e($data->address); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="/outlet/<?php echo e($data->id); ?>" method="post" class="me-auto">
                            <?php echo method_field('delete'); ?>
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger me-auto" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEdit_<?php echo e($data->id); ?>">Edit</a>
                    </div>
                </div>
            </div>
        
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = $outlet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="modal fade" id="modalEdit_<?php echo e($data->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit_<?php echo e($data->id); ?>Label" aria-hidden="true" >
        <form class="mt-1" action="/outlet/<?php echo e($data->id); ?>" method="post">
            <div class="modal-dialog">
            <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
                <div class="modal-header">
                <h5 class="modal-title" id="modalEdit_<?php echo e($data->id); ?>Label">Edit Outlet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #e4e9f7">
                    <?php echo method_field('put'); ?>
                        <?php echo csrf_field(); ?>
                        <div class="mb-2">
                            <label for="name" class="mb-1 fc">Name</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $data->name)); ?>" class="form-control" id="name" placeholder="Pondok Jaya" autofocus required>
                        </div>
                        <div class="mb-2">
                            <label for="telp" class="mb-1 fc">Phone Number</label>
                        <input type="tel" value="<?php echo e(old('telp', $data->telp)); ?>" name="telp" class="form-control" id="telp" placeholder="0812345678" required>
                        </div>
                        <div class="mb-2">
                            <label for="address" class="mb-1 fc">Address</label>
                            <textarea class="form-control" name="address" placeholder="Jalan Panda II" id="address" style="height: 100px" required><?php echo e($data->address); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
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

</html><?php /**PATH E:\laravel8\laundry\resources\views/admin/outlet.blade.php ENDPATH**/ ?>