

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/datatables.min.css"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="home-section">
    <div class="container-fluid" style="min-height: calc(100vh - 60px);">
          <div class="content-header">
            <div class="container-fluid">
              <div class="row pb-1 mb-1">
                <div class="col-sm-6">
                  <h2 class="title-mobile mt-4"><b>History</b></h2>
                </div>
                <hr class="mt-3 ms-2 mb-1">
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row py-2">
                <div class="col">
                    <div class="card-body p-0 ms-1 mb-5" style="overflow-x: auto;">
                        <table class="table table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Nama Siswa</th>
                                  <th>Kelas</th>
                                  <th>Nisn</th>
                                  <th>Tanggal Bayar</th>
                                  <th>Nama Petugas</th>
                                  <th>Bulan</th>
                                  <th>Tahun</th>
                                  <th>Nominal</th>
                                  <th>Print</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
    <?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/datatables.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  	});
    $(function () {
        var table = $('.yajra-datatable').DataTable({
          dom: 'l<"toolbar">Bfrtip',
            initComplete: function(){
            $("div.toolbar")
                .html('<a type="button" class="create p-2 px-3 mb-2 btn btn-primary ms-2"  href="bayar/<?php echo e($siswa->nisn); ?>"><i class="bi bi-plus-lg text-light"></i><span class="text-light">Tambah</span></a>');           
            },  
          processing: true,
          serverSide: true,
          responsive: true,
          autoWidth: false,
          buttons: [
              {
                extend: 'pdf',
                text: '<i class="fas fa-print fa-fw"></i>',
                title: "<?php echo e($siswa['nama_siswa']); ?> - <?php echo e($siswa['kode_siswa']); ?>",
                className: 'create p-2 btn btn-primary px-3',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                },
                footer: true,
            }
          ],
          ajax: "<?php echo e(route('admin.history.list',$siswa['id'])); ?>",
          columns: [
            {data: 'DT_RowIndex' , name: 'id'},
            {data: 'siswa.nama_siswa', name: 'siswa.nama_siswa'},
            {data: 'siswa.kelas.nama_kelas', name: 'siswa.kelas.nama_kelas'},
            {data: 'siswa.nisn', name: 'siswa.nisn'},
            {data: 'tanggal_bayar', name: 'tanggal_bayar'},
            {data: 'petugas.nama_petugas', name: 'petugas.nama_petugas'},
            {data: 'bulan_bayar', name: 'bulan_bayar'},
            {data: 'tahun_bayar', name: 'tahun_bayar'},
            {data: 'jumlah_bayar', name: 'jumlah_bayar'},
            {data: 'action', name: 'action', orderable: false, searchable: true},
        ]
      });
      
    });
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laravel8\sppluul\resources\views/admin/pembayaran/history-pembayaran.blade.php ENDPATH**/ ?>