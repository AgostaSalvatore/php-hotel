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

    $parking_requested = false;

    if(isset($_GET['parking']) && $_GET['parking'] == "on"){
        $parking_requested = true;
    }


    //filtro voto
    $minimum_vote = 0;

    if(isset($_GET['minimum_vote']) && is_numeric($_GET['minimum_vote']) && $_GET['minimum_vote'] > 0 && $_GET['minimum_vote'] <= 5){
        $minimum_vote = (int)$_GET['minimum_vote'];
    }

?>

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

    <div class="container mt-5">
        <!-- Form per i filtri di ricerca -->
         <h2>Filtri</h2>
         <form action="">
             <div class="d-flex mb-3">
    
                 <div class='form-control'>
                         <!-- Checkbox per filtrare solo hotel con parcheggio -->
                         <label for="parking">Parcheggio</label>
                         <input type="checkbox" name="parking" id="parking" <?php echo $_GET['parking'] ?? null ? 'checked' : ''; ?>>
                 </div>
        
                 <div class='form-control'>
                     <input type="number" id='minimum_vote' name="minimum_vote" min=1 max=5>
                     <label for="minimum_vote">Voto Minimo</label>
                 </div>
             </div>

             <button> Applica Filtri</button>
         </form>
        <hr class='mb-3'>
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
                    <?php
                    // Ciclo attraverso gli hotel filtrati per mostrarli nella tabella
                    foreach ($hotels as $hotel) { 

                        if($parking_requested){
                            //controlliamo se l'hotel attuale ha i parcheggi
                            if(!$hotel['parking']){
                                //saltiamo il ciclo se parking e' = null/flase
                                continue; //una sorta di skip
                            }
                        }


                        //controllo anche sul voto
                        //se e' superiore o uguale AL VOTO MINIMO
                        if($hotel['vote'] < $minimum_vote){
                            continue;
                        }
                    ?>
                <tr>
                    <td><?php echo $hotel['name']; ?></td>
                    <td><?php echo $hotel['description']; ?></td>
                    <td><?php echo $hotel['parking'] ? 'Sì' : 'No'; ?></td>
                    <td><?php echo $hotel['vote']; ?>/5</td>
                    <td><?php echo $hotel['distance_to_center']; ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>