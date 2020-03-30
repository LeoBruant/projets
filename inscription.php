<?php
	require_once('traitement/connexion_bdd.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>insciption</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/inscription.css">
	</head>
	<body>
		<div class="formulaire">
			<h1 class="text-center titre">Inscription</h1>
			<form method="POST" class="text-center">
					<input placeholder="nom d'utilisateur" type="text" name="nom" class="col-3">
					<br>
					<input placeholder="mot de passe" type="password" name="mot_de_passe" class="col-3">
				<div>
					<select name="genre" class="col-3">
						<option value="vide">genre</option>
						<option value="homme">homme</option>
						<option value="femme">femme</option>
						<option value="autre">autre</option>
					</select>
				</div>
				<input placeholder="email" type="email" name="email" class="col-3">
				<br>
				<button type="submit" name="valider" class="col-2">Finaliser l'inscription</button>
			</form>
			<?php
				if(isset($_POST["valider"]) && (empty($_POST["nom"]) || empty($_POST["mot_de_passe"]) || empty($_POST["email"]) || $_POST["genre"] === "vide")){
					echo'<p class="text-center">Veuillez remplir tous les champs</p>';
				}

				if(isset($_POST["valider"]) && (!empty($_POST["nom"]) && !empty($_POST["mot_de_passe"]) && !empty($_POST["email"]) && $_POST["genre"] !== "vide")){
					$query = $connexion->prepare('INSERT INTO profil (Pseudo_profil, Mail_profil, MotDePasse_profil, Genre_profil, Id_role) VALUES (:Pseudo_profil, :Mail_profil, :MotDePasse_profil, :Genre_profil, :Id_role)');

					$query->bindParam(':Pseudo_profil', $Pseudo_profil);
					$query->bindParam(':Mail_profil', $Mail_profil);
					$query->bindParam(':MotDePasse_profil', $MotDePasse_profil);
					$query->bindParam(':Genre_profil', $Genre_profil);
					$query->bindParam(':Id_role', $Id_role);

					$Pseudo_profil = $_POST['nom'];
					$Mail_profil = $_POST['email'];
					$MotDePasse_profil = $_POST['mot_de_passe'];
					$Genre_profil = $_POST['genre'];
					$Id_role = 1;

					$query->execute();
					echo'<p class="text-center">Votre profil a bien été créé</p>';
				}
			?>
		</div>
		<p class="text-center"><a href="index.php">lien vers l'accueil</a></p>
	</body>
</html>