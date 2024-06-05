<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
        require_once("connexion.php");

        // Code pour modifier un post
        if (isset($_GET['id_post'])) {
            $id_post = intval($_GET['id_post']);
            if ($id_post > 0) {
                // Récupérer les informations du post à modifier
                $query = "SELECT title, description, image FROM Post WHERE id_Post = $id_post";
                $result = mysqli_query($con, $query);
                $post = mysqli_fetch_assoc($result);

                // Afficher le formulaire de modification
                echo '<div class="card mt-5 mx-auto" style="max-width: 500px;">
                    <div class="card-header">
                        <h4>Modifier le post</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" class="mb-5">
                            <div class="form-group">
                                <label for="title">Titre :</label>
                                <input type="text" id="title" name="title" class="form-control" value="'. htmlspecialchars($post['title']). '">
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea id="description" name="description" class="form-control">'. htmlspecialchars($post['description']). '</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image :</label>
                                <input type="file" id="image" name="image" class="form-control-file">
                            </div>
                            <button type="submit" name="update_post" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>';

                // Traitement du formulaire de modification
                if (isset($_POST['update_post'])) {
                    $title = mysqli_real_escape_string($con, $_POST['title']);
                    $description = mysqli_real_escape_string($con, $_POST['description']);
                    $image = $_FILES['image']['name'];
                    $tmp_image = $_FILES['image']['tmp_name'];

                    // Mettre à jour le post dans la base de données
                    $updateQuery = "UPDATE Post SET title = '$title', description = '$description', image = '$image' WHERE id_Post = $id_post";
                    $updateResult = mysqli_query($con, $updateQuery);

                    // Vérifier si la mise à jour a réussi
                    if ($updateResult) {
                        echo "<script>
                            alert('Le post a été mis à jour avec succès.');
                            window.location.href='index.php';
                        </script>";
                    } else {
                        echo '<p class="text-danger">Erreur lors de la mise à jour du post : '. mysqli_error($con). '</p>';
                    }
                }
            } else {
                echo '<p class="text-danger">ID de post invalide.</p>';
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
