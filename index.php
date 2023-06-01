<?php

// Nomi dei file di log da analizzare
$log_files = array("access.log", "access2.log", "access3.log", "access4.log", "access5.log", "access6.log");

// Inizializza un array per memorizzare gli indirizzi IP
$ips = array();

// Lista di agenti utente noti come crawler
$crawlers = array("Googlebot", "Bingbot", "YandexBot", "Slurp", "DuckDuckBot");

// Analizza ogni file di log
foreach ($log_files as $log_file) {
  // Apri il file in modalità di lettura
  $handle = fopen($log_file, "r");

  // Leggi ogni riga del file
  while (($line = fgets($handle)) !== false) {
    // Estrai l'indirizzo IP e l'agente utente dalla riga
    $ip = explode(" ", $line)[0];
    $user_agent = explode("\"", $line)[5];

    // Verifica se l'agente utente è un crawler noto
    $is_crawler = false;
    foreach ($crawlers as $crawler) {
      if (strpos($user_agent, $crawler) !== false) {
        $is_crawler = true;
        break;
      }
    }

    // Aggiungi l'indirizzo IP all'array solo se non è un crawler noto
    if (!$is_crawler) {
      $ips[] = $ip;
    }
  }

  // Chiudi il file
  fclose($handle);
}

// Calcola e stampa il numero di indirizzi IP
$ips_count = count($ips);
echo "Il numero totale di visitatori (esclusi i crawler)  è: $ips_count\n";

?>
