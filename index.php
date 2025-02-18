<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body class="container mt-4">

    <h2 class="text-center">Menu Principal</h2>

    <div class="row justify-content-center">
        <!-- Card para navegar para a página de Autores -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Autores</h5>
                    <p class="card-text">Gerenciar autores</p>
                    <a href="views/autores.php" class="btn btn-primary">Ir para Autores</a>
                </div>
            </div>
        </div>

        <!-- Card para navegar para a página de Livros -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Livros</h5>
                    <p class="card-text">Gerenciar livros</p>
                    <a href="views/livros.php" class="btn btn-primary">Ir para Livros</a>
                </div>
            </div>
        </div>

        <!-- Card para navegar para a página de Edições -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Edições Especiais</h5>
                    <p class="card-text">Gerenciar edições especiais.</p>
                    <a href="views/edicao.php" class="btn btn-primary">Ir para Edições</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
