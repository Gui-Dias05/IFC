<?php 
  session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tabelas
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../php/cadProfessor.php">Professor</a></li>
            <li><a class="dropdown-item" href="../php/cadLaboratorio.php">Laboratorio</a></li>
            <li><a class="dropdown-item" href="../php/cadReserva.php">Reserva</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>
<script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>