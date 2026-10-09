<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? 'Yeni Mesaj');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $subject, $message]);
            
            echo "<script>alert('Mesajınız başarıyla gönderildi!'); window.location.href='contact.html';</script>";
        } catch (PDOException $e) {
            echo "Hata oluştu: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Lütfen gerekli alanları doldurun.'); window.history.back();</script>";
    }
}