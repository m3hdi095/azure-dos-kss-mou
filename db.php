<?php
if (file_exists(__DIR__ . '/.env')) {
    foreach (file(__DIR__ . '/.env') as $line) {
        $line = trim($line);
        if ($line && !str_starts_with($line, '#')) {
            putenv($line);
        }
    }
}

$host   = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user   = getenv('DB_USER');
$pass   = getenv('DB_PASS');

// Certificat CA Azure MySQL (DigiCert) — télécharge sur :
// https://dl.cacerts.digicert.com/DigiCertGlobalRootCA.crt.pem
$sslCa = __DIR__ . '/DigiCertGlobalRootCA.crt.pem';

try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    if (file_exists($sslCa)) {
        $options[PDO::MYSQL_ATTR_SSL_CA]                 = $sslCa;
        $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
    }

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass,
        $options
    );
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>