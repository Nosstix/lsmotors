<?php
// À lancer UNE FOIS pour remplir la table pseudo

require_once __DIR__ . '/BDD/bdd.php';

$prefixes = [
    'Player',
    'Nossti',
    'Shadow',
    'Ghost',
    'Night',
    'LS',
    'Neo',
    'Rogue',
    'Drift',
    'Turbo',
    'Vapor',
    'Nova',
    'Lynx',
    'Falcon',
    'Venom',
    'Echo',
    'Pixel',
    'Glitch',
    'Rider',
    'Blaze'
];

$suffixes = [
    '',
    'RP',
    'LS',
    'FR',
    'V',
    'X',
    '_',
    '-',
    'HD',
    'Pro',
    '15',
    '21',
    '69',
    '92',
    '75',
    '13',
    '77',
    '93',
    '974',
    '2K'
];

try {
    $bdd->beginTransaction();

    $stmt = $bdd->prepare("INSERT IGNORE INTO pseudo (Pseudo) VALUES (:p)");

    $generated = [];
    $count = 0;

    while ($count < 1000) {
        $pref = $prefixes[array_rand($prefixes)];
        $suf = $suffixes[array_rand($suffixes)];
        $num = rand(0, 999);

        $pseudo = $pref . $suf . str_pad((string) $num, 2, '0', STR_PAD_LEFT);

        if (in_array($pseudo, $generated, true)) {
            continue;
        }

        $generated[] = $pseudo;
        $stmt->execute([':p' => $pseudo]);
        $count++;
    }

    $bdd->commit();

    echo "OK : $count pseudos insérés dans la table pseudo.";

} catch (Exception $e) {
    $bdd->rollBack();
    echo "Erreur : " . $e->getMessage();
}