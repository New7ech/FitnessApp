# Guide utilisateur - Generer un PDF apres achat

Ce guide explique comment creer une facture et generer son PDF apres une commande publique ou depuis le module de gestion.

## Point important

Le projet a maintenant deux chemins coherents pour generer une facture PDF :

```text
1. Client public : catalogue -> panier -> commande -> paiement -> facture PDF
2. Gestion interne : /gestion/factures -> creer une facture -> PDF
```

Le panier public cree maintenant une facture apres la confirmation de commande. Le stock est diminue automatiquement et le PDF est disponible sur la page de confirmation.

## Prerequis

Avant de creer une facture PDF, verifiez que :

- l'application Laravel est lancee ;
- la base de donnees est migree ;
- au moins un article existe ;
- l'article vendu a un stock superieur a 0.

Commandes utiles :

```bash
composer install
npm install
php artisan migrate --seed
npm run build
php artisan serve
```

Ensuite, ouvrez l'application :

```text
http://127.0.0.1:8000
```

## Verifier ou creer un article

1. Ouvrez :

```text
http://127.0.0.1:8000/gestion/articles
```

2. Verifiez qu'un article existe avec un stock disponible.

3. Si aucun article n'existe, creez-en un depuis :

```text
http://127.0.0.1:8000/gestion/articles/create
```

Le stock est important : si la quantite demandee est superieure au stock disponible, la facture ne doit pas etre validee.

## Generer le PDF depuis le parcours client

1. Ouvrez le catalogue public :

```text
http://127.0.0.1:8000
```

2. Cliquez sur `Ajouter` sur un produit disponible.

3. Ouvrez le panier :

```text
http://127.0.0.1:8000/panier
```

4. Verifiez les quantites.

5. Cliquez sur :

```text
Finaliser le paiement
```

6. Remplissez les informations client :

- nom complet ;
- telephone ;
- adresse de livraison ;
- email si disponible.

7. Choisissez le mode de paiement.

Les modes `Mobile Money` et `Carte bancaire` enregistrent la facture comme payee. Les modes `Paiement a la livraison`, `Virement bancaire` et `Cheque` enregistrent la facture comme impayee.

8. Cliquez sur :

```text
Confirmer la commande
```

Apres validation :

- la facture est creee ;
- le stock est diminue ;
- le panier est vide ;
- la page de confirmation affiche le bouton `Telecharger la facture PDF`.

## Generer le PDF depuis la gestion interne

1. Ouvrez la liste des factures :

```text
http://127.0.0.1:8000/gestion/factures
```

2. Cliquez sur le bouton :

```text
Creer une Facture
```

3. Remplissez les informations du client.

Le champ obligatoire est :

```text
Nom du client
```

4. Dans la partie Articles, selectionnez l'article vendu.

5. Indiquez la quantite vendue.

La quantite doit etre superieure a 0 et inferieure ou egale au stock disponible.

6. Ajoutez d'autres lignes si la vente contient plusieurs articles.

7. Choisissez le mode de paiement et le statut du paiement.

8. Cliquez sur :

```text
Enregistrer la Facture
```

Apres validation :

- la facture est enregistree ;
- le stock des articles est diminue automatiquement ;
- le fichier PDF de la facture est telecharge automatiquement par le navigateur.

## Telecharger de nouveau le PDF d'une facture

Si la facture existe deja, vous pouvez retelecharger son PDF.

1. Ouvrez :

```text
http://127.0.0.1:8000/gestion/factures
```

2. Dans la colonne Actions, cliquez sur l'icone PDF.

Vous pouvez aussi ouvrir directement une URL de ce type :

```text
http://127.0.0.1:8000/gestion/factures/1/pdf
```

Remplacez `1` par l'identifiant de la facture.

## Si le PDF ne se telecharge pas

Verifiez les points suivants :

- le navigateur ne bloque pas les telechargements ;
- un article est bien selectionne dans la facture ;
- la quantite est valide ;
- le stock disponible est suffisant ;
- le bouton `Enregistrer la Facture` n'est pas desactive ;
- la facture apparait bien dans `/gestion/factures` apres validation.

Si la facture apparait dans la liste mais que le PDF ne s'est pas telecharge automatiquement, utilisez l'icone PDF dans la colonne Actions.

## Routes utiles

```text
/
/panier
/commande
/commande/succes/{id}
/commande/factures/{id}/pdf
/gestion
/gestion/articles
/gestion/articles/create
/gestion/factures
/gestion/factures/create
/gestion/factures/{id}/pdf
```

## Note technique

La generation PDF utilise le package Laravel DomPDF.

Le flux public principal est :

```text
CartController -> CheckoutController -> FactureService -> DomPDF
```

Le flux de gestion interne est :

```text
FactureController@store
```

Cette action cree la facture, met a jour le stock, puis retourne directement le PDF en telechargement.

Le telechargement d'une facture existante passe par :

```text
FactureController@genererPdf
```
