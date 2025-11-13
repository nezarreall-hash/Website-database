<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Original+Surfer&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <background src="Activiteiten.jpg" alt="achtergrond afbeelding">
    <header class="header">
<nav class="navigatie navbar navbar-expand-lg  shadow-sm fixed-top pt-3 pb-3 h4  ">
    <div class="container">
        <a class="navbar-brand fw-bold  pl-5" href="activiteiten.php"> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-dark" id="navbarNav">
            <ul class="navbar-nav ms-auto ">
                <li class=" px-2 nav-item"><a class="nav-link active" href="activiteiten.php">Activiteiten</a></li>
                <li class=" px-2 nav-item"><a class="nav-link" href="Score overzicht.php">Score Overzicht</a></li>
                <li class="px-2 nav-item"><a class="nav-link" href="indexilia.php">Activiteiten Toevoegen</a></li>
                <li class="px-2 nav-item"><a class="nav-link" href="indextristan.php" >Reacties</a></li>
                <li class="px-2 nav-item"><a class="nav-link" href="indexomar.php" >Beheer Activiteiten</a></li>
                <li class="px-2 nav-item"><a class="nav-link" href="login.php"> Login</a></li>
                <li class="nav-item"><a class="nav-link " href="register.php"> Register</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="top-section">
    <div class="searchbar">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <form>
                        <input type="text" class="form-control" placeholder="Search..">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bottom-section">
</div>
    </header>
    <section class="hero">
        <h2>Zoek een activiteit</h2>
        <input type="text" placeholder="Zoek een activiteit...">
        <div class="sort">
            <button>A-Z</button>
            <button>Z-A</button>
        </div>
    </section>

    <section class="activiteiten">
        <div class="card">
            <img src="zwemmen.jpg" alt="Zwemmen">
            <h3>Zwemmen</h3>
            <p>Zwemmen is een sport waarbij je verschillende slagen gebruikt om je door het water voort te bewegen. Het is goed voor je conditie, kracht en uithoudingsvermogen.</p>
        </div>

        <div class="card">
            <img src="voetbalen.jpg" alt="Voetbal">
            <h3>Voetballen</h3>
            <p>Voetbal is een teamsport waarbij spelers proberen te scoren door de bal in het doel van de tegenstander te schieten. Het draait om teamwork, snelheid en techniek.</p>
        </div>
        <div class="card">
            <img src="basketbalen.jpg" alt="Basketbal">
            <h3>basketbalen</h3>
            <p>Basketbal is een teamsport waarbij spelers proberen de bal in de ring van de tegenstander te gooien om punten te scoren.
</p>
    </section>
</body>
</html>

