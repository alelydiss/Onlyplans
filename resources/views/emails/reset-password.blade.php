<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer Contraseña</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: 'Segoe UI', 'Helvetica Neue', sans-serif; color: #333;">
  <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #f4f4f7;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; margin: 40px auto; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
          <tr>
            <td align="center" style="background-color: #6C63FF; padding: 32px;">
              <img src="https://i.postimg.cc/XXMMsB8V/logo.png" alt="Logo" width="110" style="display: block;" />
            </td>
          </tr>
          <tr>
            <td style="padding: 40px 30px; text-align: center;">
              <h2 style="font-size: 22px; color: #222;">🔐 Solicitud de cambio de contraseña</h2>
              <p style="font-size: 15px; line-height: 1.6; margin: 20px 0;">
                Recibimos una solicitud para restablecer la contraseña de tu cuenta. Si no realizaste esta acción, puedes ignorar este correo.
              </p>
              <table role="presentation" cellpadding="0" cellspacing="0" align="center" style="margin: 25px auto;">
                <tr>
                  <td bgcolor="#6C63FF" style="border-radius: 8px;">
                    <a href="{{ $url }}" style="display: inline-block; padding: 14px 26px; font-size: 15px; color: #fff; text-decoration: none; font-weight: bold;">
                      Restablecer Contraseña
                    </a>
                  </td>
                </tr>
              </table>
              <p style="font-size: 14px; margin-top: 30px;">
                Este enlace expirará en <strong>60 minutos</strong>.
              </p>
            </td>
          </tr>
          <tr>
            <td style="background-color: #f8f8fb; padding: 20px 30px; font-size: 13px; color: #555; text-align: center;">
              <p style="margin-bottom: 10px;">¿Tienes problemas con el botón?</p>
              <p style="word-break: break-all;">
                <a href="{{ $url }}" style="color: #6C63FF;">{{ $url }}</a>
              </p>
            </td>
          </tr>
          <tr>
            <td style="padding: 16px; text-align: center; font-size: 12px; color: #999;">
              © {{ date('Y') }} OnlyPlans. Todos los derechos reservados.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
