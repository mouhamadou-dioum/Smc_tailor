<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Couture — Rendez-vous</title>
</head>
<body style="font-family: Georgia, 'Times New Roman', serif; line-height: 1.6; color: #333; max-width: 560px; margin: 0 auto; padding: 24px;">
    <p style="font-size: 1.05rem;">{{ $message }}</p>
    @isset($waLink)
        <p style="margin-top: 1.5rem;">
            <a href="{{ $waLink }}" style="display: inline-block; background: #25D366; color: #fff; text-decoration: none; padding: 12px 20px; border-radius: 6px; font-weight: 600;">
                Ouvrir WhatsApp avec ce message
            </a>
        </p>
        <p style="font-size: 0.85rem; color: #666;">Si le message WhatsApp n’apparaît pas sur votre téléphone, utilisez ce bouton.</p>
    @endisset
    <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 2rem 0;">
    <p style="font-size: 0.8rem; color: #888;">Couture App — message automatique, merci de ne pas répondre à cet e-mail si la boîte n’est pas surveillée.</p>
</body>
</html>
