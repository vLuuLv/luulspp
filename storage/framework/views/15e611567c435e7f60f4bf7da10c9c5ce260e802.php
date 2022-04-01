
<div class="modal fade" id="tambahKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahKelasLabel" aria-hidden="true" >
    <form class="mt-1" action="/kelas" method="post">
        <div class="modal-dialog">
        <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKelasLabel">Tambah Kelas Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #e4e9f7">
                <?php echo csrf_field(); ?>  
                <div class="mb-3">
                    <label class="form-label">Nama Kelas :</label>
                    <input required type="text" class="form-control text-uppercase" id="nama_kelas" name="nama_kelas">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kompetensi Keahlian :</label>
                    <input required type="text" class="form-control text-capitalize" id="kompetensi_keahlian" name="kompetensi_keahlian">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
            </div>
        </div>
    </form>
</div>

<?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal " id="infoKelas<?php echo e($data->id); ?>" tabindex="-1" aria-labelledby="infoKelas<?php echo e($data->id); ?>Label" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
            <div class="modal-header">
                <h5 class="modal-title" id="infoKelas<?php echo e($data->id); ?>Label">Info Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #e4e9f7">
                <div class="mb-3">
                    <label class="form-label">Nama Kelas :</label>
                    <input disabled readonly type="text" class="form-control text-uppercase" value="<?php echo e($data->nama_kelas); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kompetensi Keahlian :</label>
                    <input disabled readonly type="text" class="form-control text-capitalize" value="<?php echo e($data->kompetensi_keahlian); ?>">
                </div>
            </div>
            <div class="modal-footer">
                <form action="/kelas/<?php echo e($data->id); ?>" method="post" class="me-auto">
                    <?php echo method_field('delete'); ?>
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger me-auto" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                </form>
                <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editKelas<?php echo e($data->id); ?>" data-bs-dismiss="modal">Edit</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal " id="editKelas<?php echo e($data->id); ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editKelas<?php echo e($data->id); ?>Label" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
            <div class="modal-header">
                <h5 class="modal-title" id="editKelas<?php echo e($data->id); ?>Label">Edit Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/kelas/<?php echo e($data->id); ?>" method="post">
                <div class="modal-body" style="background-color: #e4e9f7">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>
                    <div class="mb-3">
                        <label class="form-label">Nama :</label>
                        <input required value="<?php echo e($data->nama_kelas); ?>" type="text" class="form-control text-uppercase" id="nama_kelas" name="nama_kelas">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kompetensi Keahlian :</label>
                        <input required type="text" class="form-control text-capitalize" value="<?php echo e($data->kompetensi_keahlian); ?>" id="kompetensi_keahlian" name="kompetensi_keahlian">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Simpan Perubahan?')">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH E:\laravel8\sppluul\resources\views/admin/kelas/modal.blade.php ENDPATH**/ ?>