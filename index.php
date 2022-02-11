<?php
require 'Config.php';
require 'Connect.php';

/**
 * Pour cet exercice, vous allez utiliser la base de données table_test_php créée pendant l'exo 189
 * Vous utiliserez également les deux tables que vous aviez créées au point 2 ( créer des tables avec PHP )
 */

try {
    /**
     * Créez ici votre objet de connection PDO, et utilisez à chaque fois le même objet $pdo ici.
     */
    $myconnexion = Connect::dbConnect();

    /**
     * 1. Insérez un nouvel utilisateur dans la table utilisateur.
     */

    // TODO votre code ici.
    $sql = "
        INSERT INTO user (name, first_name, mail, password, address, postal_code, country)
        VALUES ('Dehainaut','Angélique','angelique.dehainaut59@gmail.com','azerty','35 rue francois boussus',59212, 'France')
    ";
    $result = $myconnexion->exec($sql);

    /**
     * 2. Insérez un nouveau produit dans la table produit
     */

    // TODO votre code ici.
    $sql = "
        INSERT INTO products(title, price, short_description, long_description) 
        VALUES ('Mon article',22.90,'ceci est une description de mon article',
                'ceci est une version plus longue de mon article pour avoir un texte plus long')
    ";
    $result = $myconnexion->exec($sql);
    /**
     * 3. En une seule requête, ajoutez deux nouveaux utilisateurs à la table utilisateur.
     */

    // TODO Votre code ici.
    $sql = "
        INSERT INTO user(name, first_name, mail, password, address, postal_code, country) 
        VALUES ('Laurent','Louane','louanelaurent59@gmail.com','1234','35 rue francois boussus',59212,'France'),    
               ('Laurent','Luka','lukalaurent59@gmail.com','azerty','35 rue francois boussus',59212,'France')   
               
    ";
    $result = $myconnexion->exec($sql);
    /**
     * 4. En une seule requête, ajoutez deux produits à la table produit.
     */

    // TODO Votre code ici.
        $sql = "
            INSERT INTO products(title, price, short_description, long_description) 
            VALUES ('article1',19.99,'courte descritpion','il faut une descritpion beaucoup plus longue'),
                   ('article2',5.99,'jeux','cet article est conçu pour les enfants de plus de 10 ans')
        ";
    /**
     * 5. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux utilisateurs dans la table utilisateur.
     */

    // TODO Votre code ici.
    $myconnexion->beginTransaction();
    $insert = 'INSERT INTO user(name, first_name, mail, password, address, postal_code, country) VALUES ';

    $sql1 = $insert ."('Laurent','Timeo','laurenttimeo59@gmail.com','coucou','35 rue francois',59212,'France')";
    $myconnexion->exec($sql1);

    $sql2 = $insert ."('Coco','Timeo','laurenttim9@gmail.com','coucou','35 rue francois',59212,'France')";
    $myconnexion->exec($sql2);

    $sql3 = $insert ."('Dehainaut','Patrick','patrick.dehainaut@gmail.com','coucou','35 rue francois',59600,'France')";
    $myconnexion->exec($sql3);

    $myconnexion->commit();

    /**
     * 6. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux produits dans la table produit.
     */

    $myconnexion->beginTransaction();
    $insert = 'INSERT INTO products(title, price, short_description, long_description) VALUES ';

    $sql4 = $insert ."('ordi',155.99, 'asus', 'ordinateur avec beaucoup de performances pour de meilleurs résultats')";
    $myconnexion->exec($sql4);

    $sql5 = $insert ."('stylo',2.99, 'bic', 'stylo multi couleurs, regardez par vous même la finesse de sa pointe')";
    $myconnexion->exec($sql5);

    $sql6 = $insert ."('télévision',555.99, 'samsung', 'super résolution avec smart tv netflix inclus et de nombreuses options')";
    $myconnexion->exec($sql6);

    $myconnexion->commit();

}
catch (PDOException $e) {
    echo "Erreur: " .$e->getMessage()."<br>";
    $myconnexion->rollBack();
}