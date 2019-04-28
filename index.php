<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/app.css">
    <title></title>
  </head>
  <body>

    <div class="main-container">

      <header class="main-header">

        <nav class="main-nav">
          <ul>
            <li><a href="#">Iniciar Sesión</a></li>
            <li><a href="#">Registrarse</a></li>
            <li><a href="profile.php"><span>Mi Cuenta </span><i class="fas fa-user-alt"></i></a></li>
            <li><a href="#"><span>Mi Carrito </span><i class="fas fa-shopping-cart"></i></a></li>
          </ul>
        </nav>

        <div class="logo">
        <a href="index.php">
          <h1>DIGITAL <span class="orange">STORE</span></h1>
        </a>

        </div>

        <div class="banner">

          <div class="slogan">

            <h2>Un <span class="orange">deseo</span>. Un <span class="orange">click</span>.<br> Nunca antes fue tan <span class="orange">fácil</span>.</h2>

          </div>

          <nav class="sociales">
            <a href="#"><img src="images/facebook.png" alt="icono facebook"></a>
            <a href="#"><img src="images/instagram.png" alt="icono instagram"></a>
            <a href="#"><img src="images/twitter.png" alt="icono twitter"></a>
          </nav>

        </div>

      </header>

      <main>

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

      </main>

      <footer class="main-footer">

        <nav class="nav-footer">
          <ul>
            <li><a href="#"><i class="fas fa-envelope"></i> Contacto</li></a>
            <li><a href="faq.php"><i class="fas fa-question"></i> Preguntas Frecuentes</li></a>
          </ul>
        </nav>

        <p> &copy; Todos los derechos reservados</p>

      </footer>

    </div> <!-- Fin .container -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>
