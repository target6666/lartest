<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="/">{{ config('app.name', 'Laravel') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav mr-auto">
      
      <!--customers-->
      <li class="nav-item">
        <a class="nav-link" href="/customers">Kunden <span class="sr-only">(current)</span></a>
      </li>

      <!--Artikel Dropdown Button-->
      <div class="btn-group">
        <a type="button" class="btn btn-primary" href="/articles">Artikel</a>
        <a type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"  href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="sr-only">Toggle Dropdown</span>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/articles/create">neuer Artikel</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/categories/">Artikelgruppen</a>
        </div>
      </div>




      <!--Orders-->
      <li class="nav-item">
        <a class="nav-link" href="/orders">Bestellungen</a>
      </li>
      <!--Einkauf-->          
      <li class="nav-item">
          <a class="nav-link" href="/purchase">Einkauf</a>
      </li>
      <!--./
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Artikel</a>
        <div class="dropdown-menu" aria-labelledby="dropdown04">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      -->
    </ul>
    <form class="form-inline my-2 my-md-0">
      <input class="form-control" type="text" placeholder="Search">
    </form>
  </div>
</nav>