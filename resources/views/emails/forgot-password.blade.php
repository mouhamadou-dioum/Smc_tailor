<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de votre mot de passe</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f7;
            color: #51545e;
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-text-size-adjust: none;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f4f7;
            padding: 30px 0;
        }
        .email-content {
            max-width: 570px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #e8e8f0;
        }
        .email-header {
            background-color: #1a1a2e;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            color: #c9a959;
            margin: 0;
            font-family: 'Georgia', serif;
            font-size: 24px;
            letter-spacing: 2px;
        }
        .email-body {
            padding: 40px;
        }
        .email-body h2 {
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
            color: #1a1a2e;
        }
        .email-body p {
            font-size: 15px;
            line-height: 1.6;
            color: #51545e;
            margin-bottom: 25px;
        }
        .btn-container {
            text-align: center;
            margin: 30px 0;
        }
        .btn-primary {
            background-color: #c9a959;
            color: #ffffff !important;
            display: inline-block;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            font-size: 15px;
            box-shadow: 0 4px 10px rgba(201,169,89,0.3);
        }
        .email-footer {
            padding: 30px 40px;
            background-color: #f9fafb;
            border-top: 1px solid #e8e8f0;
            font-size: 12px;
            text-align: center;
            color: #9ea2a9;
        }
        .link-break {
            word-break: break-all;
            font-size: 12px;
            color: #9ea2a9;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Header -->
            <div class="email-header">
                <h1>SMC COUTURE</h1>
            </div>
            
            <!-- Body -->
            <div class="email-body">
                <h2>Bonjour,</h2>
                <p>Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte client sur l'application <strong>SMC Couture</strong>.</p>
                
                <div class="btn-container">
                    <a href="{{ $resetLink }}" class="btn-primary" target="_blank">Réinitialiser le mot de passe</a>
                </div>
                
                <p>Ce lien de réinitialisation du mot de passe expirera dans <strong>60 minutes</strong>.</p>
                <p>Si vous n'avez pas demandé cette réinitialisation, aucune autre action n'est requise de votre part.</p>
                <p>Cordialement,<br>L'équipe SMC Couture</p>
                
                <div class="link-break">
                    Si le bouton ci-dessus ne fonctionne pas, copiez et collez l'URL suivante dans votre navigateur :<br>
                    <a href="{{ $resetLink }}" style="color: #c9a959;">{{ $resetLink }}</a>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="email-footer">
                &copy; {{ date('Y') }} SMC Couture. Tous droits réservés.<br>
                Dakar, Sénégal.
            </div>
        </div>
    </div>
</body>
</html>
