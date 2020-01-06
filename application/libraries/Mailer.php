<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 date_default_timezone_set("Asia/Taipei");
class Mailer {
 
    var $mail;
 
    public function __construct()
    {
        require_once('PHPMailer/class.phpmailer.php');
        require_once('PHPMailer/PHPMailerAutoload.php');
 
        // the true param means it will throw exceptions on errors, which we need to catch
        $this->mail = new PHPMailer(true);
        $this->mail->IsSMTP(); // telling the class to use SMTP
        $this->mail->CharSet = "utf-8";                  // 一定要設定 CharSet 才能正確處理中文
        /* Gmail
        $this->mail->SMTPDebug  = 0;                     // enables SMTP debug information
        $this->mail->SMTPAuth   = true;                  // enable SMTP authentication
        $this->mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $this->mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $this->mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $this->mail->Username   = "qooseven7@gmail.com";// GMAIL username
        $this->mail->Password   = "7317Lsko";       // GMAIL password
        //$this->mail->AddReplyTo('qooseven7@gmail.com', 'YOUR_NAME');
        $this->mail->SetFrom('qooseven7@gmail.com', '系統信件(請勿回覆)');
        */
        $this->mail->CharSet = "utf-8"; 
        $this->mail->SMTPDebug  = 0; 
        $this->mail->SMTPAuth   = false; 
        $this->mail->SMTPSecure = false;  
        $this->mail->SMTPAutoTLS = false;  //MailServer會自動啟用TLS，所以要設定取消打開TLS
        $this->mail->Host       = "mail.cin-phown.com.tw"; 
        $this->mail->Port       = 25; 
        $this->mail->Username   = "una@mail.cin-phown.com.tw";
        $this->mail->Password   = "tre85240";
        $this->mail->SetFrom('noreply@mail.cin-phown.com.tw', '系統信件(請勿回覆)');
    }
 
    public function sendmail($to, $to_name, $subject, $body){
        try{
            $this->mail->AddAddress($to, $to_name);
 
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
 
            $this->mail->Send();
                return "Message Sent OK</p>\n";
 
        } catch (phpmailerException $e) {
            return $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            return $e->getMessage(); //Boring error messages from anything else!
        }
    }
    public function sendmail_mutiple($to, $to_name,$to2,$to_name2, $subject, $body){
        try{
            $this->mail->AddAddress($to, $to_name);
            $this->mail->AddAddress($to2, $to_name2);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
 
            $this->mail->Send();
                return "Message Sent OK</p>\n";
 
        } catch (phpmailerException $e) {
            return $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            return $e->getMessage(); //Boring error messages from anything else!
        }
    }
}
 
/* End of file mailer.php */