<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellidos'])) {
    header('location:../../index.html?msg=sinSesion');
}

include('./actualizacion.php');
?>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <div class="container-inicio">
        <div class="content-cards">
            <div class="card-info caja">
                <div class="text">
                    Mesas libres
                    <div class="cantidad">5</div>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-stop"></i>
                </div>
            </div>
            <div class="card-info caja">
                <div class="text">
                    Ganancia
                    <div class="cantidad">S/ 500</div>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
            </div>
            <div class="card-info caja">
                <div class="text">
                    Usuarios
                    <div class="cantidad">112</div>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
        <div class="content-main caja">
            <div class="box-slider">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../../img/slider-01.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://cdn.pixabay.com/photo/2019/02/21/19/00/restaurant-4011989_1280.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://cdn.pixabay.com/photo/2021/02/06/19/29/pancakes-5989136_1280.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
            </div>
            <div class="box-text">
                <div class="logo">
                    <img src="../../img/WhatsApp_Image_2024-06-20_at_11.55.11-removebg-preview.png" alt="">
                </div>
                <div class="info">
                El Restaurante Todo Rico es un amante de las tradiciones de nuestra región y 
              nuestro país, con una mística de servicio y atención a nuestros comensales, pensando siempre en brindar a nuestra clientela
               el mejor ambiente ,comoda y confortable,
               nos hemos esmerado para tener una excelente cocina típica Peruana con sabores de diferentes Regiones del Peru.
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>