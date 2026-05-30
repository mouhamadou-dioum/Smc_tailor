# Proposition d'Évolution Fonctionnelle — SMC Couture

Ce document détaille les fonctionnalités à forte valeur ajoutée proposées pour amener l'application **SMC Couture** à un niveau professionnel supérieur. Chaque fonctionnalité est présentée sous forme de module indépendant, facilitant ainsi la facturation progressive du client final.

---

## 📅 Synthèse du Plan de Facturation par Fonctionnalités

| Module | Fonctionnalité | Intérêt Client (Valeur Métier) | Complexité | Recommandation |
| :--- | :--- | :--- | :--- | :--- |
| **Module 1** | **Suivi de Production en Temps Réel** | Évite les demandes incessantes des clients sur l'état de leur habit. | Moyenne | **Prioritaire** (Phase 1) |
| **Module 2** | **Exportation PDF des Fiches de Mesures** | Permet à l'atelier de couper le tissu avec une fiche physique claire et professionnelle. | Simple | **Prioritaire** (Phase 1) |
| **Module 3** | **Gestion Financière (Acomptes & Solde)** | Suivi rigoureux de ce que le client a payé (50% acompte) et ce qu'il doit à la livraison. | Moyenne | Phase 2 |
| **Module 4** | **Calendrier & Planning Visuel Atelier** | Permet au tailleur de planifier ses coutures par rapport aux dates limites de livraison. | Élevée | Phase 2 |
| **Module 5** | **Rapports Financiers & Statistiques** | Visibilité pour le propriétaire sur le chiffre d'affaires et les modèles les plus populaires. | Simple | Phase 3 |

---

## 🔍 Détail Technique & Commercial des Modules (Phase 1)

### Module 1 : Suivi de Production (Timeline / Barre de Progression)
* **Description** : Permet au client de visualiser l'état de son vêtement en cours de création via son tableau de bord personnel.
* **Étapes de fabrication suivies** :
  1. 📏 **Mesures** : Mensurations prises et enregistrées à l'atelier.
  2. ✂️ **Coupe** : Le tissu du client a été tracé et découpé.
  3. 🧵 **Couture** : L'assemblage et le montage du vêtement sont en cours.
  4. ✨ **Finitions** : Ajustements finaux, boutonnières, broderie, et repassage.
  5. 🎁 **Prêt** : Le vêtement est fini, emballé et prêt à être récupéré ou livré !
* **Gestion Administrateur** : L'administrateur modifie l'état de fabrication d'un simple clic depuis la page de détails du rendez-vous.

### Module 2 : Fiche de Mesures PDF Professionnelle
* **Description** : Génération d'une fiche A4 optimisée au format PDF contenant l'ensemble des mensurations du client, le nom du modèle choisi, et les photos d'inspiration associées.
* **Fonctionnalités incluses** :
  - Mise en page propre de type "Fiche Atelier" avec entête de l'entreprise.
  - Impression directe en PDF optimisée (masquage des éléments de navigation web, boutons, etc.).
  - Espace de signature pour le client et le couturier.

---

## 🚀 Évolutions Futures (Facturation Complémentaire)

### Module 3 : Suivi Financier & Reçus (Acomptes de 50%)
* **Description** : Interface pour enregistrer les montants facturés, l'acompte obligatoire versé au dépôt du tissu, et le solde restant. Génération automatique d'un reçu d'acompte à envoyer par WhatsApp.

### Module 4 : Calendrier Interactif (Atelier)
* **Description** : Intégration d'un calendrier FullCalendar sur le tableau de bord administrateur affichant les dates limites de livraison (dates de livraison convenues) avec des codes couleur selon l'urgence.

### Module 5 : Statistiques et Chiffre d'Affaires
* **Description** : Graphiques financiers montrant les entrées financières mensuelles, les vêtements les plus rentables et le volume de commandes traitées par saison.
