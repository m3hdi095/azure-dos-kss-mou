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

$caBundles = [
    '/etc/ssl/certs/ca-certificates.crt',       
    '/etc/pki/tls/certs/ca-bundle.crt',         
    '/etc/ssl/ca-bundle.pem',
];

$caFile = null;
foreach ($caBundles as $path) {
    if (file_exists($path)) { $caFile = $path; break; }
}

try {
    $options = [
        PDO::ATTR_ERRMODE                      => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];
    if ($caFile) {
        $options[PDO::MYSQL_ATTR_SSL_CA] = $caFile;
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