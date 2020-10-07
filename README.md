1. Création le projet avec la commande 

  1.1 $ symfony new   videotheque

2. Installer le package Doctrine :

  2.1 $ composer require doctrine  // installation 

  2.2  modification URL de database   .env  

3. Installer un serveur de développement

  3.1 $ composer req server


4. Lancer le serveur :

  4.1 $ php bin/console server:run  ||    symfony server:start

5. Modifier le charset de database (Mysql ) en cas il'a une erreur de commande SQL:

    5.1 Modifier le fichier    config\packages\doctrine.yaml

           remplacer le code suivant :

             charset: utf8mb4
            default_table_options:
                               collate: utf8mb4_unicode_ci


           par :

            charset: utf8
            default_table_options:
                          collate: utf8_unicode_ci                    

6. installer le composant symfony/twig-bundle :

     6.1 $ composer require symfony/twig-bundle  


7. Activer les annotations  :

     7.1 installer    $ composer require symfony/validator

     7.2 installer  $ composer require symfony/security-bundle 

8. Error : You have requested a non-existent service "form.factory".

   8.1 Change the following line in your services.yml

              services:
                       public: false 

               par

              services:
                      public: true

9. Error :   Class "Symfony\Component\Form\AbstractType" not found

         9.1 $ composer req symfony/form    #  This package requires php ^7.4.10


       