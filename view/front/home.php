<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <link rel="stylesheet" href="../../public/styles/style.css">
</head>
<body>
    <?php 
        session_start(); 
        require_once __DIR__ . '/../../controllers/checkAuth.php'; 
        // verif que la personne a bien un droit
        $droits = isset($_SESSION['droits']) ? $_SESSION['droits'] : null;
        
        if ($droits == 1) {
            include '../template/headerAdmin.php'; 
        } else {
            include '../template/header.php'; 
        }
    ?>
    <?php include '../front/acceuil.php'; ?>
    <?php include '../front/tarifs.php'; ?>  

    <?php 
        if ($droits == 1) {
            include '../template/footerAdmin.php'; 
        } else {
            include '../template/footer.php';; 
        }
     ?>
    <script src="https://kit.fontawesome.com/ab09c2f170.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></body>
</html>
