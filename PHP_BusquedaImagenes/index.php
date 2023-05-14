<!DOCTYPE html>
<html>

<head>
    <title>Búsqueda dinámica de imágenes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid bg-ligth bg-opacity-75 py-5">

        <div class="container bg-light bg-opacity-75 p-5">

            <div class="container text-center mb-5">
                <h1 class="display-4 font-sans-serif">Búsqueda de imágenes</h1>
            </div>

            <form method="get">
                <div class="form-group">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Ingresa una característica de la imágen a buscar: </span>
                        </div>
                        <input type="text" class="form-control" name="keyword" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Selecciona una categoría</span>
                        </div>
                        <select class="form-control" id="category-select" name="category">
                            <option value="all">Todas</option>
                            <option value="science">Science</option>
                            <option value="education">Education</option>
                            <option value="people">People</option>
                            <option value="feelings">Feelings</option>
                            <option value="computer">Computer</option>
                            <option value="buildings">Buildings</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-info btn-lg mx-auto mt-4 d-block"></i>Buscar</button>

            </form>

            <div class="row mt-4" id="results-container">
                <div class="row mt-4" id="results-container">
                    <?php

                    $pixabayApiKey = '13119377-fc7e10c6305a7de49da6ecb25';

                    // Definir la URL del API de Pixabay
                    $url = 'https://pixabay.com/api/?key=' . $pixabayApiKey;

                    // Obtener los resultados de la solicitud al API de Pixabay
                    $response = file_get_contents($url);

                    // Decodificar la respuesta JSON del API de Pixabay
                    $results = json_decode($response, true);

                    // Obtener la keyword y la categoría desde los parámetros GET
                    $keyword = $_GET['keyword'] ?? '';
                    $category = $_GET['category'] ?? '';

                    // Crear la URL para la búsqueda en Pixabay
                    $searchUrl = 'https://pixabay.com/api/?key=' . $pixabayApiKey;
                    if (!empty($keyword)) {
                        $searchUrl .= '&q=' . urlencode($keyword);
                    }
                    if (!empty($category)) {
                        $searchUrl .= '&category=' . urlencode($category);
                    }

                    // Obtener los resultados de la búsqueda en Pixabay
                    $searchResponse = file_get_contents($searchUrl);

                    // Decodificar la respuesta JSON de la búsqueda en Pixabay
                    $searchResults = json_decode($searchResponse, true); ?>
                    <div class="row">
                        <?php foreach ($searchResults['hits'] as $image) : ?>
                            <div class="col-md-4">
                                <div class="card mb-4 search-result-card">
                                    <img class="card-img-top" src="<?php echo $image['previewURL']; ?>" alt="<?php echo $image['tags']; ?>">
                                    <div class="card-body bg-ligth border">

                                        <p class="card-title tags text-center d-block" style="font-weight: bold;">Ver información</p>

                                        <p class="card-title tags" style="font-weight: bold; display: none; margin: 0;">Tags</p>
                                        <p class="card-text tags" style="display: none; margin: 0; margin-left: 5px;"><?php echo $image['tags']; ?></p>

                                        <p class="card-title views" style="font-weight: bold;display: none; margin: 0;">Vistas</p>
                                        <p class="card-text views" style="display: none; margin: 0; margin-left: 5px;"><?php echo $image['views']; ?></p>

                                        <p class="card-title likes" style="font-weight: bold;display: none; margin: 0;">Me gusta</p>
                                        <p class="card-text likes" style="display: none; margin: 0; margin-left: 5px;"><?php echo $image['likes']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <script>
                        // Agregar controlador de eventos de clic a cada tarjeta de imagen
                        const searchResultCards = document.querySelectorAll('.search-result-card');
                        searchResultCards.forEach((card) => {
                            const image = card.querySelector('.card-img-top');
                            image.addEventListener('click', () => {
                                const tags = card.querySelectorAll('.tags');
                                const views = card.querySelectorAll('.views');
                                const likes = card.querySelectorAll('.likes');
                                tags.forEach((tag) => tag.style.display = 'block');
                                views.forEach((view) => view.style.display = 'block');
                                likes.forEach((like) => like.style.display = 'block');
                            });
                        });
                    </script>
                </div>
            </div>
        </div>

        <form>
            <div class="form-group">
                <blockquote class="blockquote text-center">
                    <p class="mb-3">Stefania Rubiano Cotrino</p>
                    <footer class="blockquote-footer">Prueba técnica - <cite title="Source Title">IT TEAM</cite></footer>
                </blockquote>
            </div>
        </form>
    </div>

</html>