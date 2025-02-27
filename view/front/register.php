<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/styles/style.css">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-90 pt-3">
        <div class="col-md-6">
            <div class="card shadow-lg p-4 h-90 overflow-auto">
                <h2 class="text-center mb-4">Inscription</h2>

                <form action="../../index.php?action=register" method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-2">
                        <label for="avatar" class="form-label">Photo de profil</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom" required>
                    </div>

                    <div class="mb-2">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Votre prénom" required>
                    </div>

                    <div class="mb-2">
                        <label for="mail" class="form-label">Email</label>
                        <input type="email" id="mail" name="mail" class="form-control" placeholder="Votre email" required>
                    </div>

                    <div class="mb-2">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Votre mot de passe" required>
                    </div>

                    <div class="mb-2">
                        <label for="droits" class="form-label">Droits</label>
                        <select name="droits" id="droits" class="form-select">
                            <option value="2">Utilisateur</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-info">S'inscrire</button>
                    </div>
                </form>

                <p class="text-center mt-3">
                    Vous avez déjà un compte ? <a href="../../index.php" class="text-decoration-none">Connectez-vous</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
