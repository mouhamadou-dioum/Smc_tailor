<?php
$hash = '$2y$12$kHTGqtDu1udn/xhGa/6lweXho4gtPNv23X1Ngs4BAUZtgpjNS2odC';
$passwords = [
    'admin123',
    'admin',
    'password',
    '123456',
    '12345678',
    'couture123',
    'smccouture',
    'smc123',
    'loufadioum2004',
    'couture',
    'smc'
];

foreach ($passwords as $p) {
    if (password_verify($p, $hash)) {
        echo "MATCH: " . $p . "\n";
        exit;
    }
}
echo "NO MATCH\n";
