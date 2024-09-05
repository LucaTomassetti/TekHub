<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UEMailer {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);

        // Carica le configurazioni da un file esterno o da variabili d'ambiente
        $config = $this->loadConfig();

        // Configurazione del server
        $this->mailer->isSMTP();
        $this->mailer->Host = $config['smtp_host'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $config['smtp_username'];
        $this->mailer->Password = $config['smtp_password'];
        $this->mailer->SMTPSecure = $config['smtp_secure'];
        $this->mailer->Port = $config['smtp_port'];

        // Impostazioni del mittente
        $this->mailer->setFrom($config['from_email'], $config['from_name']);
    }

    private function loadConfig() {
        /** Nel file configMailer.php, va configurato il servizio di mail come segue
         * (nel nostro caso, abbiamo usato MailTrap, servizio online che ci permette di testare l'invio delle mail)
         * <?php

            return [
                'smtp_host' => 'sandbox.smtp.mailtrap.io',
                'smtp_username' => 'il_tuo_username',
                'smtp_password' => 'la_tua_password',
                'smtp_secure' => 'tls',
                'smtp_port' => 2525,
                'from_email' => 'admin@gmail.com',
                'from_name' => 'TekHub Admin',
            ];
         */
        return include __DIR__ .'/../../config/configMailer.php';
    }

    public function sendAccountDeletionEmail($userEmail) {
        try {
            $this->mailer->addAddress($userEmail);
            $this->mailer->Subject = 'Il tuo account TekHub e\' stato eliminato';
            $this->mailer->Body = 'Il tuo account e\' stato eliminato dall\'amministratore di TekHub.';

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Errore nell'invio dell'email: " . $this->mailer->ErrorInfo);
            return false;
        }
    }
}