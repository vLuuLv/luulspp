<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css">
    <link href="css/sidenav.css" rel="stylesheet">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title); ?></title>
</head>

<body>
    <?php echo $__env->make('sidenav.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <section class="home-section">
      <div class="text ms-4">
        <h3>Welcome back, <b><?php echo e(auth()->user()->username); ?></b></h3>
        <div class="container mt-3">
            <div class="row g-2">
              <div class="col-6">
                <div class="container mt-2">
                    <div class="row">
                      <div class="col">
                       <div style="font-size: 20px"><b>Packages Order</b></div>
                      </div>
                      <div class="col">
                        <div style="font-size: 15px" class="text-end"><a href="">See All</a></div>
                      </div>
                    </div>
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative rounded-3 m-1 ms-5" style="background-color: #faf7f79d;width:90%;">
                            <div class="col-auto d-none d-lg-block p-2 rounded-3">
                              <svg class="bd-placeholder-img rounded-3 mt-1" width="120" height="150" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    
                            </div>
                            <div class="col p-3 d-flex flex-column position-static">
                              <strong class="d-inline-block text-dark mt-2">Name Package</strong>
                              <p class="text-dark mb-2 mt-1" style="font-weight: 400;font-size: 15px;">Jenis pakaian</small>
                              <div class="mb-0 mt-2 text-muted text-end" style="font-size:17px;">Price</div>
                              <h3 class="mb-0 text-end">33$</h3>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                  </div>
              </div>
              <div class="col-6">
                <div class="p-3">Custom column padding</div>
              </div>
              <div class="col-6">
                <div class="p-3">Custom column padding</div>
              </div>
              <div class="col-6">
                <div class="p-3">Custom column padding</div>
              </div>
            </div>
          </div>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script-unopen.js"></script>
</body>

</html><?php /**PATH C:\Users\KinG\Downloads\Project\laundry\resources\views/home.blade.php ENDPATH**/ ?>