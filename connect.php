<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jobs@bluezinfo.com'; // Your Gmail
        $mail->Password   = 'rwgf tawt hfoj gviu';    // App password from Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender and recipient
        $mail->setFrom('your-email@gmail.com', 'Candidate Form');
        $mail->addAddress('jobs@bluezinfo.com'); // Where to send the form details

        // Form fields
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $gender = $_POST["occupation"];
        
        $phone = $_POST["phone"];
        $degree = $_POST["degree"];
        $position = $_POST["position"];
        $experience = $_POST["experience"];
        $year_of_experience = $_POST["year_of_experience"];
        

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Interview Candidate Application';
        $mail->Body    = "
            <h3>Candidate Details</h3>
            Name: $firstname $lastname<br>
            Email: $email<br>
            Gender: $gender<br>
            
            Phone: $phone<br>
            Degree: $degree<br>
            Position: $position<br>
            Experience: $experience<br>
            Year of experience: $year_of_experience<br>
            
        ";

        // Attachment
        if (isset($_FILES['upload']) && $_FILES['upload']['error'] == 0) {
            $mail->addAttachment($_FILES['upload']['tmp_name'], $_FILES['upload']['name']);
        }

        $mail->send();
        echo "Application submitted successfully!";
    } catch (Exception $e) {
        echo "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
