<?php

  $title = 'Digital Store - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');
  require_once'partials/banner.php';

?>

  <main>
    <form class="text-center" action="jsonToBd.php" method="get">
      <button class="btn btn-lg btn-warning" type="submit" name="import" value="true">IMPORTAR USUARIOS</button>
    </form>

    <nav class="products-nav">
      <ul>
        <li><a href="#"><i class="fas fa-mobile-alt"></i>Celulares</a></li>
        <li><a href="#"><i class="fas fa-laptop"></i>Notebooks</a></li>
        <li><a href="#"><i class="fas fa-tv"></i>TVs y Monitores</a></li>
        <li><a href="#"><i class="fas fa-tablet-alt"></i>Tablets</a></li>
        <li><a href="#"><i class="far fa-clock"></i>Smartwatches</a></li>
        <li><a href="#"><i class="fas fa-plus"></i>Otras Categorías</a></li>
      </ul>
    </nav>

    <!-- Carousel  -->


        <div class="row no-gutters">
          <div class="container-oferta col-12 col-lg-12 col-md-12">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="images/summer-tech-wide.jpg" alt="First slide">
                  <div class="carousel-caption d-md-block">
                    <h5>SUMMER SALE</h5>
                    <p>Descuentos de verano!</p>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="images/outlet-tech-small-wide.jpg" alt="Second slide">
                  <div class="carousel-caption d-md-block">
                    <h5>OUTLET</h5>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="images/sales-img-small-wide.jpg" alt="Third slide">
                  <div class="carousel-caption d-md-block">
                    <h5>SUMMER SALE</h5>
                    <p>Descuentos de verano!</p>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
           </div>

          </div>

        </div>

        <section class="section-ofertas">

          <div class="row no-gutters" id="container-oferta">
            <div class="container-oferta col-12 col-lg-8 col-md-8 col-sm-12">
              <div class="oferta1">
                <h2>OFERTA 1</h2>
                <h3>$1500</h3>
                <button class="button-oferta" type="button" name="button">SHOP NOW</button>
              </div>
            </div>

            <div class="container-oferta col-12 col-lg-4 col-md-4 col-sm-12">
              <div class="oferta2">
                <h3>40% SALE</h3>
                <h2>OFERTA 2</h2>
                <button class="button-oferta" type="button" name="button">SHOP NOW</button>
              </div>
            </div>
          </div>

        </section>
        <!-- Fin SECTION OFERTAS -->

        <section class="section-articulos" id="section-articulos">
          <h2>Productos destacados</h2>
          <div class="row no-gutters">
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
              <article class="articulo">
                <img src="https://http2.mlstatic.com/monitores-D_NP_592925-MLA25521012722_042017-Q.jpg" alt="foto del producto">
                <h4>Articulo Nombre</h4>
                <h3>$9999</h3>
                <a href="detalle.php" class="button-buy-now">Shop Now!</a>
              </article>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
              <article class="articulo">
                <img src="https://http2.mlstatic.com/monitores-D_NP_592925-MLA25521012722_042017-Q.jpg" alt="foto del producto">
                <h4>Articulo Nombre</h4>
                <h3>$9999</h3>
                <a href="detalle.php" class="button-buy-now">Shop Now!</a>
              </article>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
              <article class="articulo">
                <img src="https://http2.mlstatic.com/monitores-D_NP_592925-MLA25521012722_042017-Q.jpg" alt="foto del producto">
                <h4>Articulo Nombre</h4>
                <h3>$9999</h3>
                <a href="detalle.php" class="button-buy-now">Shop Now!</a>
              </article>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
              <article class="articulo">
                <img src="https://http2.mlstatic.com/monitores-D_NP_592925-MLA25521012722_042017-Q.jpg" alt="foto del producto">
                <h4>Articulo Nombre</h4>
                <h3>$9999</h3>
                <a href="detalle.php" class="button-buy-now">Shop Now!</a>
              </article>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
              <article class="articulo">
                <img src="https://http2.mlstatic.com/monitores-D_NP_592925-MLA25521012722_042017-Q.jpg" alt="foto del producto">
                <h4>Articulo Nombre</h4>
                <h3>$9999</h3>
                <a href="detalle.php" class="button-buy-now">Shop Now!</a>
              </article>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
              <article class="articulo">
                <img src="https://http2.mlstatic.com/monitores-D_NP_592925-MLA25521012722_042017-Q.jpg" alt="foto del producto">
                <h4>Articulo Nombre</h4>
                <h3>$9999</h3>
                <a href="detalle.php" class="button-buy-now">Shop Now!</a>
              </article>
            </div>
          </div>
        </section>
        <!-- FIN SECTION ARTICULOS -->

  </main>

<?php

  require_once('./partials/footer.php');

?>
