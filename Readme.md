# LaboData - La fiche de référence

Pour les pharmacies et les parapharmacies en ligne et bien plus encore.


## Documentation de l'API JSON

L'API utilise des requêtes au format **POST** ou **GET**. L'API ne peut être consulté que par une seule adresse IP serveur.

Chaque requête doit utiliser en paramètre l'adresse `email` du compte et la clé privée `secret` fournie sur le site labodata.com
Nous vous déconseillons de faire des appels directement en Javascript (côté client) du fait de la restriction par IP.



### Test de la connexion, contrôle du compte et crédits disponibles

Cette requête permet de tester si la connexion est bien établie et la clé privée est correcte. Vous trouverez la clé privée dans votre zone mon compte sur https://www.labodata.com

Requête *(gratuite)* :
```
https://www.labodata.com/api/v1/account.json?email=YOUR@EMAIL&secret=YOUR_KEY
```

Réponse : Voir le fichier `account.json`



### Lien de connexion automatique au site LaboData.com sans identification

Cette requête délivre un jeton d'identification permettant de se connecter automatiquement au site LaboData.com sans passer par le formulaire d'identification.
Important: Ce jeton est à usage unique et à durée de vie de 10 minutes.

Requête *(gratuite)* :
```
https://www.labodata.com/api/v1/autoconnect.json?email=YOUR@EMAIL&secret=YOUR_KEY
```

Réponse : Voir le fichier `autoconnect.json`



#### Lien de connexion automatique au site LaboData.com sans identification et amenant à la zone de paiement

Cette requête délivre un jeton d'identification permettant de se connecter automatiquement au site LaboData.com sans passer par le formulaire d'identification.
Une fois sur le site LaboData, l'utilisateur arrivera sur l'interface de paiement **Approvisionner**.
En fin de paiement, si le paramètre `redirect` est précisé, l'utilisateur sera redirigé vers cette page ( pensez à utiliser une fonction du type http://php.net/urlencode ).
```
https://www.labodata.com/api/v1/autopay.json?email=YOUR@EMAIL&secret=YOUR_KEY&redirect=https%3A%2F%2Fwww.apotekisto.fr%2Fadministration%3F...
```

Réponse : Voir le fichier `autopay.json`



### Liste des marques disponibles

Cette requête vous permet de lister les marques disponibles dans LaboData et le nombre de fiches produits disponibles.
Ajouter le paramètre `all=1` pour voir les marques vides.

Requête *(gratuite)* :
```
https://www.labodata.com/api/v1/category/brand.json?email=YOUR@EMAIL&secret=YOUR_KEY
```

Réponse : Voir le fichier `category/brand.json`



### Liste des critères disponibles

Cette requête vous permet d'obtenir l'intégralité de la nomenclature des fiches produits.
Ajouter le paramètre `all=1` pour voir les critères vides.

Requête *(gratuite)* :
```
https://www.labodata.com/api/v1/category/criteria.json?email=YOUR@EMAIL&secret=YOUR_KEY
```

Réponse : Voir le fichier `category/criteria.json`



### Liste des arborescences disponibles

Cette requête vous permet d'obtenir l'intégralité des arborescences des fiches produits.
Ajouter le paramètre `all=1` pour voir les arborescences vides.

Requête *(gratuite)* :
```
https://www.labodata.com/api/v1/category/tree.json?email=YOUR@EMAIL&secret=YOUR_KEY
```

Réponse : Voir le fichier `category/tree.json`



### Rechercher une ou plusieurs fiches produits

Cette requête vous permet de rechercher dans la base de données LaboData. Vous pouvez rechercher par code(s) cip, par marque, ou par texte libre.
Chaque résultat retournera au maximum **50** éléments. Pour les résultats suivants, vous devez utiliser le paramètre `page` (avec un maximum de 50 pages).
*A noter : les liens images ont une durée de vie d'une heure maximum.*

Requête *(gratuite)* :
```
https://www.labodata.com/api/v1/product/search.json?email=YOUR@EMAIL&secret=YOUR_KEY&code=CIP1,CIP2,CIP3...
https://www.labodata.com/api/v1/product/search.json?email=YOUR@EMAIL&secret=YOUR_KEY&brand=BRAND_NAME
https://www.labodata.com/api/v1/product/search.json?email=YOUR@EMAIL&secret=YOUR_KEY&q=TEXTE_LIBRE
https://www.labodata.com/api/v1/product/search.json?email=YOUR@EMAIL&secret=YOUR_KEY& ... &page=1
https://www.labodata.com/api/v1/product/search.json?email=YOUR@EMAIL&secret=YOUR_KEY& ... &order=title-asc&page=1
https://www.labodata.com/api/v1/product/search.json?email=YOUR@EMAIL&secret=YOUR_KEY& ... &order=date-desc&page=1
https://www.labodata.com/api/v1/product/search.json?email=YOUR@EMAIL&secret=YOUR_KEY& ... &order=id-desc&page=1
https://www.labodata.com/api/v1/product/search.json?email=YOUR@EMAIL&secret=YOUR_KEY& ... &order=purchase-desc&page=1
```

Réponse : Voir le fichier `product/search.json`



### Visualiser le détail d'une fiche produit complète ( textes + images )

Cette requête permet de visualiser une fiche produit complète.
*A noter : les liens images et documents ont une durée de vie d'une heure maximum.*

Requête *(payante >> 1.5 crédit)* :
```
https://www.labodata.com/api/v1/product/full.json?email=YOUR@EMAIL&secret=YOUR_KEY&id=999
```

Réponse : Voir le fichier `product/full.json`



### Visualiser UNIQUEMENT les contenus textuels d'une fiche produit

Cette requête permet de visualiser les textes d'une fiche produit.
*A noter : les documents ont une durée de vie d'une heure maximum.*

Requête *(payante >> 1 crédit)* :
```
https://www.labodata.com/api/v1/product/content.json?email=YOUR@EMAIL&secret=YOUR_KEY&id=999
```

Réponse : Voir le fichier `product/content.json`



### Visualiser UNIQUEMENT les contenus visuels d'une fiche produit

Cette requête permet de consulter les visuels d'une fiche produit.
*A noter : les liens images ont une durée de vie d'une heure maximum.*

Requête *(payante >> 1 crédit)* :
```
https://www.labodata.com/api/v1/product/image.json?email=YOUR@EMAIL&secret=YOUR_KEY&id=999
```

Réponse : Voir le fichier `product/image.json`



### Soumettre une fiche produit

Cette requête vous permet de soumettre une fiche produit au format POST et de gagner des crédits si votre fiche est validée par notre équipe.

Requête *(gratuite)* :
```
https://www.labodata.com/api/v1/product/suggest.json
```

Structure POST :
```
[
    email   : "YOUR@EMAIL"
    secret  : "YOUR_KEY"
    product : [
        private              : "0"
        brand_id             : "2"
        sale_start           : "2016-01-01"
        sale_end             : "2020-01-01"
        type                 : "normal"
        code                 : "0000011122222"
        additional_code      : [
            "0000011122222"
            "0011122"
            "..."
        ]
        cis_code             : "61234567"
        minimum_age          : "2M"
        life_after_first_use : "7J"
        ability_to_drive     : "3"
        seen_tv              : "0"
        bio                  : "0
        http_ansm1           : "http://your-url..."
        http_ansm2           : ""
        http_other1          : "http://your-url..."
        http_other2          : ""
        max_quantity         : "0"
        weight               : "90"
        volume               : "20 g"
        unit                 : "1"
        comment              : null

        title_fr   : "Title"
        content_fr : "<p>Content...</p>"
        google_category_fr : "Santé et beauté > ... > ..."
        additional_content : [
            [
                title_fr   : "Title"
                content_fr : "<p>Content...</p>"
            ]
            [
                title_fr   : "Title"
                content_fr : "<p>Content...</p>"
            ]
        ]
        retail_price : [
            value    : "120.0"
            currency : "EUR"
            vat      : "20.0"
        ]
        categories_ids : [
            "10"
            "20"
            "30"
            "40"
        ]
        images : [
            "https://your-website/assets/image1.jpg"
            "https://your-website/assets/image2.jpg"
            "https://your-website/assets/image3.png"
        ]
        documents : [
            "https://your-website/assets/document1.doc"
            "https://your-website/assets/document2.pdf"
        ]
    ]
]
```

Réponse : voir le fichier `product/suggest.json`

