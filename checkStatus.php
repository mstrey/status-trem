<?php
include_once('empresas/Trensurb.php');
include_once('empresas/CPTM.php');
include_once('empresas/MetroSP.php');

$empresas = [
    new Trensurb(),
    new CPTM(),
    new MetroSP(),
];

// Loop para verificar o status de cada empresa
foreach ($empresas as $empresa) {
    $empresa->checarStatus();
}
