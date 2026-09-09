<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>Código de verificação</title>
</head>

<body style="margin:0; padding:0; background:#f2f5f9; font-family: Helvetica, Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f2f5f9; padding: 32px 0;">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius: 14px; overflow: hidden;">
                    <tr>
                        <td
                            style="background: linear-gradient(135deg, #0f2a4a 0%, #163a60 55%, #1d4a78 100%); padding: 28px 32px;">
                            <span style="color:#ffffff; font-size: 20px; font-weight: bold;">Restaurante Galegos</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 32px;">
                            <p style="font-size: 16px; color:#1a1a1a; margin: 0 0 8px;">Recebemos uma solicitação para
                                redefinir sua senha.</p>
                            <p style="font-size: 14px; color:#555; margin: 0 0 24px;">Use o código abaixo para
                                continuar. Ele expira em {{ $expiresInMinutes }} minutos.</p>

                            <div
                                style="background:#f5f8fc; border: 1px dashed #0f2a4a; border-radius: 10px; padding: 20px; text-align: center; margin-bottom: 24px;">
                                <span
                                    style="font-size: 32px; font-weight: bold; letter-spacing: 8px; color:#0f2a4a;">{{ $code }}</span>
                            </div>

                            <p style="font-size: 13px; color:#888; margin: 0;">Se você não solicitou essa alteração,
                                pode ignorar este e-mail com segurança.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>