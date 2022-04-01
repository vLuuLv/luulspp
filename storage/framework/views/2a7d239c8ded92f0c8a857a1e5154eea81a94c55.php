<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/style.css">
    <link href="css/sidenav.css" rel="stylesheet">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title); ?></title>
</head>

<body>
    <?php echo $__env->make('sidenav.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <section class="home-section pe-5">
        <div class="d-flex bd-highlight mt-2">
            <div class="p-2 flex-grow-1 bd-highlight pd-1">
                <h4 class="ms-4 mt-3"><b>Transaction</b></h4>
            </div>
            <div class="p-1 d-flex bd-highlight pt-3 ">
                <form action="/order" class="d-inline-flex">
                    <input class="form-control find-i mb-2" type="text" placeholder="Search..." name="find" value="<?php echo e(request('find')); ?>">
                    <button type="submit" class="find p-2 ms-auto me-2 ps-3 pe-3 mb-2"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
        <hr class="mt-2 mb-2 ms-4">
        <?php if($transaksi->count()): ?>
        <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex bd-highlight mt-2 pt-2 ms-3">
            <div class="p-2 flex-grow-1 bd-highlight pd-1">
                <ul class="list-group">
                    <li class="list-group-item" data-bs-toggle="modal" data-bs-target="#status_<?php echo e($data->id); ?>">
                        <i class='bx bx-dots-vertical-rounded dots ms-2'></i>
                        <?php echo e($data->invoice_code); ?>

                    </li>
                </ul>
            </div>
            <div class="p-2 d-flex bd-highlight pt-3 md-1">
                <button class="badge btn-primary p-2 btn me-3" <?php echo e(($data->status === "1") ? '' : 'hidden'); ?> type="button" data-bs-toggle="modal" data-bs-target="#status_<?php echo e($data->id); ?>">New</button>
                <button class="badge btn-primary p-2 btn me-3" <?php echo e(($data->status === "2") ? '' : 'hidden'); ?> type="button" data-bs-toggle="modal" data-bs-target="#status_<?php echo e($data->id); ?>">Process</button>
                <button class="badge btn-primary p-2 btn me-3" <?php echo e(($data->status === "3") ? '' : 'hidden'); ?> type="button" data-bs-toggle="modal" data-bs-target="#status_<?php echo e($data->id); ?>">Finish</button>
                <button class="badge btn-primary p-2 btn me-3" <?php echo e(($data->status === "4") ? '' : 'hidden'); ?> type="button" data-bs-toggle="modal" data-bs-target="#status_<?php echo e($data->id); ?>">Taken</button>
            </div>
        </div>
        <hr class="mb-2 mt-1 ms-5 me-2">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <h5 class="text-center mt-5">No transaction found.</h5>
        <?php endif; ?>
    </section>
    <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="modal " id="status_<?php echo e($data->id); ?>" tabindex="-1" aria-labelledby="status_<?php echo e($data->id); ?>Label" aria-hidden="true" >
        
            <div class="modal-dialog">
            <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
                <div class="modal-header">
                <h5 class="modal-title" id="status_<?php echo e($data->id); ?>Label">Order Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0" style="background-color: #e4e9f7">
                    <div class="title mt-3"><?php echo e($data->outlet); ?></div>
                    <hr class="mt-3 mb-1 ms-2">
                    <div class="info">
                        <div class="row">
                            <div class="col-7"> <span id="heading">Date</span><br> <span id="details"><?php echo e($data->date); ?></span> </div>
                            <div class="col-5 pull-right text-end"> <span id="heading">Invoice Code</span><br> <span id="details"><?php echo e($data->invoice_code); ?></span> </div>
                        </div>
                    </div>
                    <div class="pricing">
                        <?php $__currentLoopData = App\Http\Controllers\OrderController::details($data->invoice_code); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col-7"> <span id="name"><?php echo e($data1->name_package); ?></span></div>
                            <div class="col-1"> <span id="qty"><?php echo e($data1->qty); ?></span></div>
                            <div class="col-4 text-end"> <span id="price"><?php echo e("Rp " . number_format($data1->price,2,',','.')); ?></span> </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="total">
                        <div class="row justify-content-between">
                            <div class="col text-end"><big class="text-end"><?php echo e("Rp " . number_format($data1->qty * $data1->price,2,',','.')); ?></big></div>
                        </div>
                    </div>
                    <div class="progress-track">
                        <ul id="progressbar">
                            <?php if($data->status === "1"): ?>    
                            <li class="step0 active" id="step1">New</li>
                            <li class="step0 text-center" id="step2">Process</li>
                            <li class="step0 text-right" id="step3">Finish</li>
                            <li class="step0 text-right" id="step4">Taken</li>
                            <?php endif; ?>
                            <?php if($data->status === "2"): ?>    
                            <li class="step0 active" id="step1">New</li>
                            <li class="step0 active text-center" id="step2">Process</li>
                            <li class="step0 text-right" id="step3">Finish</li>
                            <li class="step0 text-right" id="step4">Taken</li>
                            <?php endif; ?>
                            <?php if($data->status === "3"): ?>    
                            <li class="step0 active" id="step1">New</li>
                            <li class="step0 active text-center" id="step2">Process</li>
                            <li class="step0 active text-right" id="step3">Finish</li>
                            <li class="step0 text-right" id="step4">Taken</li>
                            <?php endif; ?>
                            <?php if($data->status === "4"): ?>    
                            <li class="step0 active" id="step1">New</li>
                            <li class="step0 active text-center" id="step2">Process</li>
                            <li class="step0 active text-right" id="step3">Finish</li>
                            <li class="step0 active text-right" id="step4">Taken</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <input type="hidden" name="invoice_code" id="invoice_code" value="<?php echo e($data->invoice_code); ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script-unopen.js"></script>
</body>

</html><?php /**PATH E:\laravel8\laundry\resources\views/order/order.blade.php ENDPATH**/ ?>