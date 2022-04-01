

<?php $__env->startSection('content'); ?>
    <section class="home-section">
    <div class="container-fluid" style="min-height: calc(100vh - 60px);">
          <div class="content-header">
            <div class="container-fluid">
              <div class="row pb-1 mb-1">
                <div class="col-sm-6">
                  <h2 class="title-mobile mt-4"><b>History</b></h2>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <form action="/history/cari" method="GET" class="d-flex mt-4">
                        <input class="form-control find-i mb-2" type="text" placeholder="Search NISN" name="nisn" value="<?php echo e(request('nisn')); ?>">
                        <button type="submit" value="CARI" class="find p-2 ms-auto me-2 ps-3 pe-3 mb-2"><i class="bi bi-search"></i></button>
                    </form>
                </div>
                <hr class="mt-3 ms-2 mb-1">
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
                <div class="col">
                  <?php if($siswa->count()): ?>
                  <div class="d-flex bd-highlight mt-1 ms-md-1 me-md-1">
                        <div class="flex-grow-1 bd-highlight pd-1">
                            <ol class="list-group list-group-numbered">
                              <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <li class="list-group-item d-flex align-items-center ms-md-2 px-1 px-sm-4">
                                    <span class="text-start text-capitalize"><?php echo e($data->nama_siswa); ?></span>
                                    <div class="p-2 bd-highlight pt-3 md-1 ms-auto me-md-2">
                                      <a href="/history-pembayaran/<?php echo e($data->nisn); ?>" class="badge btn-primary p-2 btn me-md-2" style="text-decoration: none !important;">History</a>
                                  </div>
                              </li>
                              <hr class="mb-2 mt-1 ms-md-3 me-md-2">
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </ol>
                      </div>
                  </div>
                  <?php else: ?>
                  <h5 class="text-center mt-3">Tidak ada data history!.</h5>
                  <?php endif; ?>
              </div>
          </div>
      </div>
    </div>
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel8\sppluul\resources\views/admin/pembayaran/history.blade.php ENDPATH**/ ?>