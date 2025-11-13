<html lang="en">
<head>
    <title>Bootstrap 5 Example</title>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Original+Surfer&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-image: url('images/clean.jpg'); background-size: cover; background-attachment: fixed; background-position: center;">
<nav class="navigatie navbar navbar-expand-lg  shadow-sm fixed-top pt-3 pb-3 h4  ">
    <div class="container">
        <a class="navbar-brand fw-bold  pl-5" href="activiteiten.php">
            Sprint-3
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-dark" id="navbarNav">
            <ul class="navbar-nav ms-auto ">
                <li class=" px-2 nav-item"><a class="nav-link" href="activiteiten.php">Activiteiten</a></li>
                <li class=" px-2 nav-item"><a class="nav-link" href="indexberat.php">Score Overzicht</a></li>
                <li class="px-2 nav-item"><a class="nav-link" href="indexilia.php">Activiteiten Toevoegen</a></li>
                <li class="px-2 nav-item"><a class="nav-link" href="indextristan.php" >Reacties</a></li>
                <li class="px-2 nav-item"><a class="nav-link" href="indexomar.php" >Beheer Activiteiten</a></li>
                <li class="px-2 nav-item"><a class="nav-link " href="login.php"> Login</a></li>
                <li class=nav-item"><a class="nav-link active" href="register.php"> Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<form class="formlogin shadow-sm width-auto">
    <div class="text-center">
        <h3>Register</h3>
    </div>
    <br>
    <div class="form-group ">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control m-auto" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
        <br>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Wachtwoord">
    </div>
    <br>
    <div class="form-group">
        <label for="exampleInputPassword1"> Repeat Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Wachtwoord">
    </div>
    <br>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Onthou mij</label>
    </div>
    <br>
    <button type="submit" class="btn btn-primary ">Submit</button>
</form>
</body>
