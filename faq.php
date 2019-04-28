<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/app.css">
    <title></title>
  </head>
  <body>

    <div class="container">

      <header class="main-header">

        <nav class="main-nav">
          <ul>
            <li><a href="#">Iniciar Sesión</a></li>
            <li><a href="#">Registrarse</a></li>
            <li><a href="profile.php"><i class="fas fa-user-alt"></i></a></li>
            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
          </ul>
        </nav>

        <div class="logo">
        <a href="index.php">
          <h1>DIGITAL <span>STORE</span></h1>
        </a>

        </div>

        <div class="banner">

          <div class="slogan">

            <h2>Un <span>deseo</span>. Un <span>click</span>.<br> Nunca antes fue tan <span>fácil</span>.</h2>

          </div>

          <nav class="sociales">
            <a href="#"><img src="images/facebook.png" alt="icono facebook"></a>
            <a href="#"><img src="images/instagram.png" alt="icono instagram"></a>
            <a href="#"><img src="images/twitter.png" alt="icono twitter"></a>
          </nav>

        </div>

      </header>

      <main>

        <section class="section-container">

          <h2>Preguntas Frecuentes</h2>

          <div id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    ¿Cómo me registro?
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body faq-text">
                  Para darse de alta como usuario de Digital Store, se debe hacer click en la opción “Registrarse” ubicada en la parte superior del menú. Se accede al Formulario de Registro donde se deben completar los datos requeridos.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    ¿Cómo ver el estado de mi pedido?
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body faq-text">
                  Una vez logueado, se debe ingresar en "Mi cuenta", ubicado en la parte superior de la barra de menú. Haciendo click en este lugar se accede a “Mis pedidos realizados”, donde se puede observar el estado de avance de cada artículo y su estatus actual.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    ¿Cómo hago seguimiento de mi pedido?
                  </button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body faq-text">
                  Al momento, el sistema de compra no tiene habilitado un sistema de tracking o seguimiento de su pedido, te mantedremos informado por email del estado del mismo.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFour">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    ¿Cómo realizo un cambio?
                  </button>
                </h5>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body faq-text">
                  Para productos comprados en Digital Store, el cambio se puede realizar dentro de los 10 días corridos contados a partir de la entrega del producto.

                  Para realizar el cambio, el producto debe estar en perfecto estado de uso, completo, con embalaje original, factura de compra o ticket de regalo. Una vez recibido el producto, se verificará y solo si cumple con los requisitos se procederá al cambio.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFive">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    ¿Quién puede recibir la compra?
                  </button>
                </h5>
              </div>
              <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                <div class="card-body faq-text">
                  Podrá recibir la compra cualquier persona mayor de 18 años, mostrando DNI.
                  Es importante que quien recibe, firme el remito de entrega y verifique el estado del producto.
                </div>
              </div>
            </div>
          </div>

          <a href="index.php">Inicio</a>

        </section>


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
