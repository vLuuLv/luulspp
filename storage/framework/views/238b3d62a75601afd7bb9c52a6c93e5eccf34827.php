
<div class="modal fade" id="tambahSpp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahSppLabel" aria-hidden="true" >
    <form class="mt-1" action="/spp" method="post">
        <div class="modal-dialog">
        <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSppLabel">Tambah Spp Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #e4e9f7">
                <?php echo csrf_field(); ?>  
                <div class="mb-3">
                    <label class="form-label">Tahun :</label>
                    <input required type="text" class="form-control" id="tahun" name="tahun">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nominal :</label>
                    <input required type="text" class="form-control" id="nominal" name="nominal">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Done</button>
            </div>
            </div>
        </div>
    </form>
</div>

<?php $__currentLoopData = $spp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal " id="infoSpp<?php echo e($data->id); ?>" tabindex="-1" aria-labelledby="infoSpp<?php echo e($data->id); ?>Label" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
            <div class="modal-header">
                <h5 class="modal-title" id="infoSpp<?php echo e($data->id); ?>Label">Info Spp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #e4e9f7">
                <div class="mb-3">
                    <label class="form-label">Tahun :</label>
                    <input disabled readonly type="text" class="form-control" value="<?php echo e($data->tahun); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nominal :</label>
                    <input disabled readonly type="number" class="form-control" value="<?php echo e($data->nominal); ?>">
                </div>
            </div>
            <div class="modal-footer">
                <form action="/spp/<?php echo e($data->id); ?>" method="post" class="me-auto">
                    <?php echo method_field('delete'); ?>
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger me-auto" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                </form>
                <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editSpp<?php echo e($data->id); ?>" data-bs-dismiss="modal">Edit</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = $spp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal " id="editSpp<?php echo e($data->id); ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editSpp<?php echo e($data->id); ?>Label" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
            <div class="modal-header">
                <h5 class="modal-title" id="editSpp<?php echo e($data->id); ?>Label">Edit Spp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/spp/<?php echo e($data->id); ?>" method="post">
                <div class="modal-body" style="background-color: #e4e9f7">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>
                    <div class="mb-3">
                        <label class="form-label">Tahun :</label>
                        <input required type="text" value="<?php echo e($data->tahun); ?>" class="form-control" id="tahun" name="tahun">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nominal :</label>
                        <input required type="text" value="<?php echo e($data->nominal); ?>" class="form-control" id="nominal" name="nominal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Simpan Perubahan?')">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH F:\laravel8\sppluul\resources\views/admin/spp/modal.blade.php ENDPATH**/ ?>