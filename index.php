<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Hotel EX</title>
</head>
<body>
    <h1>Hotel</h1>

    <?php
    // Array contenente tutti gli hotel con le loro caratteristiche
    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];
    ?>

    <div class="container mt-5">
        <!-- Form per i filtri di ricerca -->
        <form action="" method='GET'>
            <!-- Slider per filtrare per voto minimo (da 1 a 5) -->
            <label for="">VOTO</label>
            <input type="range" min="1" max="5" name="vote" id="vote" value="<?php echo $_GET['vote'] ?>">
            <!-- Checkbox per filtrare solo hotel con parcheggio -->
            <label for="">Parcheggio</label>
            <input type="checkbox" name="parking" id="parking" <?php echo $_GET['parking'] ?? null ? 'checked' : ''; ?>>
            <!-- Pulsante per applicare i filtri -->
            <button type='submit'>Filtra</button>
        </form>
        
        <div class="table">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Parcheggio</th>
                        <th>Voto</th>
                        <th>Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                    // SISTEMA DI FILTRI
                    // Inizializziamo con tutti gli hotel disponibili
                    $filtered_hotels = $hotels;
                    
                    // FILTRO PER VOTO MINIMO
                    // Se l'utente ha selezionato un voto, mostra solo hotel con voto >= al valore selezionato
                    if($_GET['vote'] ?? null) {
                        $min_vote = $_GET['vote']; // Prende il valore dal form
                        $filtered_hotels = array_filter($filtered_hotels, function($hotel) use ($min_vote) {
                            return $hotel['vote'] >= $min_vote; // Mantiene solo hotel con voto sufficiente
                        });
                    }
                    
                    // FILTRO PER PARCHEGGIO
                    // Se la checkbox è spuntata, mostra solo hotel che hanno il parcheggio
                    if($_GET['parking'] ?? null) {
                        $filtered_hotels = array_filter($filtered_hotels, function($hotel) {
                            return $hotel['parking'] === true; // Mantiene solo hotel con parcheggio
                        });
                    }
                    
                    // Ciclo attraverso gli hotel filtrati per mostrarli nella tabella
                    foreach ($filtered_hotels as $hotel) { ?>
                <tr>
                    <td><?php echo $hotel['name']; ?></td>
                    <td><?php echo $hotel['description']; ?></td>
                    <td><?php echo $hotel['parking'] ? 'Sì' : 'No'; ?></td>
                    <td><?php echo $hotel['vote']; ?>/5</td>
                    <td><?php echo $hotel['distance_to_center']; ?></td>
                </tr>
                <?php } ?>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>