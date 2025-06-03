<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restablecer Contraseña | OnlyPlans</title>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
    body, html {
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
      font-family: 'Poppins', 'Segoe UI', 'Helvetica Neue', sans-serif;
      color: #333;
      line-height: 1.6;
    }
    .button {
      background-color: #6C63FF;
      border-radius: 8px;
      padding: 14px 26px;
      font-size: 15px;
      color: #fff !important;
      text-decoration: none;
      font-weight: 600;
      display: inline-block;
      transition: all 0.3s ease;
    }
    .button:hover {
      background-color: #5a52e0;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(108, 99, 255, 0.25);
    }
    .footer-link {
      color: #6C63FF;
      text-decoration: none;
      transition: color 0.2s;
    }
    .footer-link:hover {
      color: #5a52e0;
      text-decoration: underline;
    }
    @media only screen and (max-width: 600px) {
      .main-table {
        width: 100% !important;
        border-radius: 0 !important;
      }
      .content-padding {
        padding: 30px 20px !important;
      }
    }
  </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f8f9fa; font-family: 'Poppins', 'Segoe UI', 'Helvetica Neue', sans-serif; color: #333;">
  <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #f8f9fa;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" role="presentation" class="main-table" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; margin: 40px auto; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05); max-width: 100%;">
          <!-- Header -->
          <tr>
            <td align="center" style="background: linear-gradient(135deg, #6C63FF 0%, #8B83FF 100%); padding: 40px;">
              <img src="https://res.cloudinary.com/dkwxybstx/image/upload/v1748940960/logo_q6d6aa.png" alt="OnlyPlans" width="120" style="display: block; height: auto;" />
              <h1 style="color: white; font-size: 24px; font-weight: 600; margin-top: 20px; margin-bottom: 0;">Restablecer contraseña</h1>
            </td>
          </tr>
          
          <!-- Main Content -->
          <tr>
            <td style="padding: 48px 40px;" class="content-padding">
              <h2 style="font-size: 20px; color: #222; font-weight: 600; margin-top: 0; margin-bottom: 24px;">Hola,</h2>
              <p style="font-size: 15px; line-height: 1.6; margin: 0 0 24px;">
                Recibimos una solicitud para restablecer la contraseña de tu cuenta de OnlyPlans. Haz clic en el botón a continuación para continuar con el proceso.
              </p>
              
              <div style="text-align: center; margin: 32px 0;">
                <a href="{{ $url }}" class="button" style="background-color: #6C63FF; border-radius: 8px; padding: 14px 26px; font-size: 15px; color: #fff; text-decoration: none; font-weight: 600; display: inline-block;">
                  Restablecer Contraseña
                </a>
              </div>
              
              <p style="font-size: 14px; color: #666; margin: 24px 0;">
                Si no solicitaste este cambio, puedes ignorar este mensaje con toda seguridad. Tu contraseña permanecerá igual.
              </p>
              
              <div style="background-color: #f8f9fa; border-left: 4px solid #6C63FF; padding: 12px 16px; border-radius: 0 4px 4px 0; margin: 32px 0 0;">
                <p style="font-size: 13px; color: #555; margin: 0;">
                  ⏳ Este enlace expirará en <strong>60 minutos</strong> por motivos de seguridad.
                </p>
              </div>
            </td>
          </tr>
          
          <!-- Fallback Link -->
          <tr>
            <td style="background-color: #f8f9fb; padding: 24px 40px; font-size: 13px; color: #555; text-align: center;" class="content-padding">
              <p style="margin: 0 0 12px;">¿Tienes problemas con el botón? Copia y pega esta URL en tu navegador:</p>
              <p style="word-break: break-all; margin: 0;">
                <a href="{{ $url }}" class="footer-link" style="color: #6C63FF; text-decoration: none;">{{ $url }}</a>
              </p>
            </td>
          </tr>
          
          <!-- Footer -->
          <tr>
            <td style="padding: 24px; text-align: center; font-size: 12px; color: #999; background-color: #ffffff; border-top: 1px solid #eee;">
              <p style="margin: 0 0 8px;">© {{ date('Y') }} OnlyPlans. Todos los derechos reservados.</p>
              <p style="margin: 0;">
                <a href="#" class="footer-link" style="color: #6C63FF; text-decoration: none;">Política de Privacidad</a> • 
                <a href="#" class="footer-link" style="color: #6C63FF; text-decoration: none;">Términos de Servicio</a> • 
                <a href="#" class="footer-link" style="color: #6C63FF; text-decoration: none;">Ayuda</a>
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>