# Codes d'erreur de l'API JSON

* `100` : L'identification a échoué ( email et/ou token absent et/ou incorrect, ip non autorisée, compte bloqué... )
* `101` : L'adresse ip du serveur n'est pas autorisée
* `104` : L'API demandé est introuvable

* `200` : L'identifiant de la fiche produit est introuvable
* `201` : Le compte ne dispose pas de crédit insuffissant pour accéder à cette fiche produit


# Codes d'erreur de suggestion de produit

* `300` : Votre fiche produit n'a pas été intégré, voir le détail du/des message(s).


# Codes d'erreur des images et des documents en téléchargement

* `401` : Authentification refusée (le jeton de téléchargement est incorrect ou a expiré).
* `402` : L'image n'est pas disponible dans votre bibiothèque (vous devez acheter la fiche produit au préalable avec l'api correspondante).
* `404` : L'image demandée est introuvable ou n'existe plus.
