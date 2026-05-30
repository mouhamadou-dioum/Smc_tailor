<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de Mesures — {{ $client->prenom }} {{ $client->nom }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --dark: #1a1a2e;
            --primary: #c9a959;
            --gray-200: #e5e7eb;
            --gray-500: #6b7280;
            --gray-800: #1f2937;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--gray-800);
            background: #fff;
            line-height: 1.5;
            padding: 20px;
            font-size: 14px;
        }

        /* Container designed to fit A4 */
        .print-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid var(--gray-200);
            padding: 30px;
            border-radius: 12px;
            background: #fff;
            position: relative;
        }

        /* Ribbon / Badge */
        .print-badge {
            position: absolute;
            top: 30px;
            right: 30px;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 5px 15px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Playfair Display', serif;
        }

        /* Header */
        .header {
            margin-bottom: 25px;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 20px;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .header h1 span {
            color: var(--primary);
        }

        .header p {
            color: var(--gray-500);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        /* Main Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid var(--gray-200);
        }

        .info-section h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 10px;
            border-bottom: 1px solid var(--gray-200);
            padding-bottom: 5px;
        }

        .info-row {
            display: flex;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .info-label {
            font-weight: 600;
            color: var(--gray-500);
            width: 120px;
            flex-shrink: 0;
        }

        .info-value {
            color: var(--dark);
        }

        /* Measurements Section */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            color: var(--dark);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: var(--primary);
        }

        .measures-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .measures-table th, .measures-table td {
            border: 1px solid var(--gray-200);
            padding: 10px 15px;
            text-align: left;
        }

        .measures-table th {
            background-color: #f3f4f6;
            color: var(--dark);
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .measures-table td.value-cell {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--dark);
        }

        .measures-table td.unit {
            color: var(--gray-500);
            font-size: 0.8rem;
            width: 50px;
        }

        /* Images section */
        .images-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 45px;
        }

        .image-card {
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background: #fff;
        }

        .image-card h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: var(--dark);
            margin-bottom: 10px;
            border-bottom: 1px dashed var(--gray-200);
            padding-bottom: 5px;
        }

        .image-card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--gray-200);
        }

        .image-placeholder {
            height: 200px;
            background-color: #f3f4f6;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
            font-size: 0.85rem;
            border: 1px dashed var(--gray-200);
        }

        .image-placeholder i {
            font-size: 2rem;
            margin-bottom: 8px;
            opacity: 0.5;
        }

        /* Signatures */
        .signatures {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-200);
        }

        .sig-block {
            text-align: center;
        }

        .sig-title {
            font-weight: 600;
            color: var(--gray-500);
            margin-bottom: 60px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sig-line {
            width: 180px;
            margin: 0 auto;
            border-top: 1px solid var(--gray-500);
        }

        /* Floating buttons for web interface */
        .no-print-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-print {
            background-color: var(--dark);
            color: #fff;
            border: none;
        }

        .btn-print:hover {
            background-color: #2a2a4e;
        }

        .btn-close {
            background-color: #fff;
            color: var(--gray-800);
            border: 1px solid var(--gray-200);
        }

        .btn-close:hover {
            background-color: var(--gray-200);
        }

        /* Print Media Styles */
        @media print {
            body {
                padding: 0;
            }

            .print-container {
                border: none;
                padding: 0;
                max-width: 100%;
            }

            .no-print-actions {
                display: none;
            }

            @page {
                size: A4;
                margin: 15mm;
            }
        }
    </style>
</head>
<body>

    <!-- Web actions -->
    <div class="no-print-actions">
        <button onclick="window.print()" class="btn-action btn-print">
            <i class="fas fa-print"></i> Imprimer / Enregistrer en PDF
        </button>
        <button onclick="window.close()" class="btn-action btn-close">
            <i class="fas fa-times"></i> Fermer l'onglet
        </button>
    </div>

    <!-- Printable container -->
    <div class="print-container">
        
        <div class="print-badge">Atelier</div>

        <div class="header">
            <h1>SMC <span>Couture</span></h1>
            <p>Fiche de Mensurations & Modèle</p>
        </div>

        <div class="info-grid">
            <div class="info-section">
                <h3>Client</h3>
                <div class="info-row">
                    <span class="info-label">Prénom & Nom :</span>
                    <span class="info-value"><strong>{{ $client->prenom }} {{ $client->nom }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Téléphone :</span>
                    <span class="info-value">{{ $client->telephone ?? 'Non renseigné' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">E-mail :</span>
                    <span class="info-value">{{ $client->email }}</span>
                </div>
            </div>
            
            <div class="info-section">
                <h3>Détails Fiche</h3>
                <div class="info-row">
                    <span class="info-label">Nom Tenue :</span>
                    <span class="info-value"><strong>{{ $mesure->nom ?? 'Non renseignée' }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date Saisie :</span>
                    <span class="info-value">{{ $mesure->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Modèle choisi :</span>
                    <span class="info-value">{{ $mesure->modele ?? 'Non spécifié' }}</span>
                </div>
            </div>
        </div>

        <h3 class="section-title"><i class="fas fa-ruler-horizontal"></i> Mensurations du Client</h3>
        
        <table class="measures-table">
            <thead>
                <tr>
                    <th>Mesure</th>
                    <th>Valeur</th>
                    <th>Unité</th>
                    <th>Mesure</th>
                    <th>Valeur</th>
                    <th>Unité</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Cou</strong></td>
                    <td class="value-cell">{{ $mesure->cou ?? '—' }}</td>
                    <td class="unit">cm</td>
                    
                    <td><strong>Bras (Tour de bras)</strong></td>
                    <td class="value-cell">{{ $mesure->tourbras ?? '—' }}</td>
                    <td class="unit">cm</td>
                </tr>
                <tr>
                    <td><strong>Épaule</strong></td>
                    <td class="value-cell">{{ $mesure->epaule ?? '—' }}</td>
                    <td class="unit">cm</td>
                    
                    <td><strong>Cuisse</strong></td>
                    <td class="value-cell">{{ $mesure->cuisse ?? '—' }}</td>
                    <td class="unit">cm</td>
                </tr>
                <tr>
                    <td><strong>Manche</strong></td>
                    <td class="value-cell">{{ $mesure->manche ?? '—' }}</td>
                    <td class="unit">cm</td>
                    
                    <td><strong>Longueur Chemise</strong></td>
                    <td class="value-cell">{{ $mesure->longueurChemise ?? '—' }}</td>
                    <td class="unit">cm</td>
                </tr>
                <tr>
                    <td><strong>Hanche</strong></td>
                    <td class="value-cell">{{ $mesure->hanche ?? '—' }}</td>
                    <td class="unit">cm</td>
                    
                    <td><strong>Longueur Boubou</strong></td>
                    <td class="value-cell">{{ $mesure->longueurBoubou ?? '—' }}</td>
                    <td class="unit">cm</td>
                </tr>
                <tr>
                    <td><strong>Longueur Pantalon</strong></td>
                    <td class="value-cell">{{ $mesure->longueurPantalon ?? '—' }}</td>
                    <td class="unit">cm</td>
                    
                    <td style="background-color:#fafafa;">—</td>
                    <td style="background-color:#fafafa;">—</td>
                    <td style="background-color:#fafafa;">—</td>
                </tr>
            </tbody>
        </table>

        <h3 class="section-title"><i class="fas fa-camera"></i> Photos & Visuels</h3>

        <div class="images-grid">
            <div class="image-card">
                <h4>Photo du Tissu</h4>
                @if($mesure->photo_tissu)
                    <img src="{{ $mesure->photo_tissu }}" alt="Tissu">
                @else
                    <div class="image-placeholder">
                        <i class="fas fa-scroll"></i>
                        Aucune photo de tissu
                    </div>
                @endif
            </div>

            <div class="image-card">
                <h4>Photo du Modèle / Inspiration</h4>
                @if($mesure->photo_modele)
                    <img src="{{ $mesure->photo_modele }}" alt="Modèle">
                @else
                    <div class="image-placeholder">
                        <i class="fas fa-tshirt"></i>
                        Aucune photo de modèle
                    </div>
                @endif
            </div>
        </div>

        <div class="signatures">
            <div class="sig-block">
                <p class="sig-title">Signature du Client</p>
                <div class="sig-line"></div>
            </div>
            
            <div class="sig-block">
                <p class="sig-title">Signature du Couturier</p>
                <div class="sig-line"></div>
            </div>
        </div>

    </div>

    <!-- Trigger printing automatically on load -->
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            // Un petit delai pour s'assurer que les styles et images soient charges
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
