<?php

  $title = 'Mi Cuenta - DS';
  require_once('./partials/head.php');
  require_once('./partials/header.php');

?>

  <main>

    <section class="section-container">

      <h2>Datos de mi cuenta</h2>

      <h3>Datos personales</h3>

        <ul>
          <li>Usuario: Pepito</li>
          <li>Nombre: Pepe</li>
          <li>Apellido: Fantoche</li>
          <li>Documento: 37007618</li>
        </ul>

      <h3>Datos contacto</h3>

        <ul>
          <li>Teléfono fijo: 4444-4444</li>
          <li>Celular: 15-4444-4444</li>
          <li>E-mail: pepito@gmail.com</li>
        </ul>

      <h3>Domicilio entrega</h3>

      <ul>
        <li>Lima 1111, Capital Federal, Argentina.</li>
      </ul>

      <a href="index.php">Inicio</a>

    </section>
    <!--FIN SECTION CONTAINER -->
  </main>

<?php

  require_once('./partials/footer.php');

?>
