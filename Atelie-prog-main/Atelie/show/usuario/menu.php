<style>
*{
    margin: 0;
    padding: 0;
}

@font-face {
    font-family: "lato";
    src: url(../font/lato/lato.ttf);
}

@font-face {
    font-family: "tang";
    src: url(../font/tangerine/Tangerine_Regular.ttf);
}

header{
    background-color: #590202;
    color: white;
    opacity: 90%;
    padding: 1% 0% 0.1%;
    font-size: 2em;
}

.menu{
    color: white;
    text-decoration: none;
    display: block;
    padding: 20px 5px;
    cursor: pointer;
    font-family: 'lato';
    font-size: 0.6em;
    font-weight: bold;
    /* margin: 20% 0%; */
}

.menu{
    background-image: linear-gradient(to right, #bc9371, #bc9371 50%, #fff 50%);
    background-size: 200% 100%;
    background-position: -100%;
    display: inline-block;
    padding: 5px 0;
    position: relative;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: all 0.3s ease-in-out;
}
  
.menu:before{
    content: '';
    background: #bc9371;
    display: block;
    position: absolute;
    bottom: -3%;
    left: 0;
    width: 0;
    height: 6%;
    transition: all 0.3s ease-in-out;
}
  
.menu:hover {
   background-position: 0;
}
  
.menu:hover::before{
    width: 100%;
}

ul{
    list-style: none;
    position: absolute;
    top: 10%;
    width: 100%;
}

label{
    left: 25%;
    position: relative;
    display: inline;
}

#check{
    display: none;
}

hr{
    width: 80%;
}

nav{
    left: 80%;
    background-color: #590202;
    width: 20%;
    height: 270%;
    position: absolute;
    display: none;
    animation: fade-in 1s;
}

#check:checked ~ nav{
    display: block;
    animation: fade-in 1s;
}

@keyframes fade-in {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
}
  
  @keyframes fade-out {
    from {
      opacity: 1;
    }
    to {
      opacity: 0;
    }
}
</style>
    <header>
        <p style="margin-right: 48%; font-family: 'tang'; font-size: 1.5em;">Ateliê E.S</p>
        <input type="checkbox" id="check">
            <label for="check">
                <img src="../../img/menu.svg" alt="" style="width: 1em; cursor: pointer;">
            </label>
        <nav>
            <center>
            <ul>
                <li><a href="cadCliente.php" class="menu">Cadastrar Cliente</a></li>
                <li><a href="cadModelo.php" class="menu">Cadastrar Detalhes</a></li>
                <hr>
                <li><a href="tabelaClientes.php" class="menu">Clientes</a></li>
                <li><a href="tabelaMedidas.php" class="menu">Medidas</a></li>
                <li><a href="tabelaModelos.php" class="menu">Detalhes</a></li>
                <hr>
                <li><a href="../../php/controle/controleLogin.php" class="menu">Sair</a></li>
                <li><a href="sobre.php" class="menu">Sobre nós</a></li>
            </ul>
            </center>
        </nav>
    </header>