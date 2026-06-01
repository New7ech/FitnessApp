# Guide - Parcours client et paiement

Ce document resume la logique fonctionnelle mise en place dans le projet.

## Parcours complet

```text
Client arrive sur le site
-> consulte le catalogue public
-> ajoute un ou plusieurs articles au panier
-> verifie les quantites
-> renseigne ses informations
-> choisit un mode de paiement
-> confirme la commande
-> une facture est creee
-> le stock est mis a jour
-> le PDF de facture est disponible
```

## Pages publiques

```text
/              Catalogue public
/panier        Panier client
/commande      Finalisation et paiement
```

## Regles metier

- Un produit doit etre visible, disponible et en stock pour etre vendu.
- Le panier est conserve en session.
- Une quantite a 0 dans le panier retire l'article.
- La commande utilise le meme service que les factures internes.
- Le stock est diminue seulement quand la commande est confirmee.
- Le PDF est genere depuis la facture creee.

## Paiements

```text
mobile_money  -> facture payee
carte         -> facture payee
especes       -> facture impayee
virement      -> facture impayee
cheque        -> facture impayee
```

Les paiements `especes`, `virement` et `cheque` restent a regulariser dans le module de gestion.

## Administration

Les factures publiques apparaissent aussi dans :

```text
/gestion/factures
```

Depuis cette page, l'administrateur peut :

- voir la facture ;
- modifier la facture ;
- telecharger le PDF ;
- supprimer la facture si necessaire.

