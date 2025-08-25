<?php
$empresas = [
    new Trensurb(),
    new CPTM(),
    new MetroSP(),
];

// Loop para verificar o status de cada empresa
foreach ($empresas as $empresa) {
    $empresa->checarStatus();
}
