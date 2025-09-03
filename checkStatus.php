<?php
include_once('empresas/Trensurb.php');
include_once('empresas/CPTM.php');
include_once('empresas/MetroSP.php');
include_once('empresas/Empresa.php');

$empresas = [
    new Trensurb(),
    new CPTM(),
    new MetroSP(),
];
file_put_contents(Empresa::LOG_FILE, "oi");
// Loop para verificar o status de cada empresa
try {
    foreach ($empresas as $empresa) {
        $empresa->checarStatus();
    }
} catch (\Throwable $th) {
    file_put_contents(Empresa::LOG_FILE, "Exception: {$th->getMessage()}\n" . $th->getTraceAsString());
}
