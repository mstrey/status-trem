#!/bin/sh

echo "Iniciando o verificador de status de transporte..."

# Loop infinito para manter o container rodando e executar o script periodicamente
while true
do
  echo "--- Executando checkStatus.php em $(date) ---"
  
  # Executa o script PHP
  php /app/checkStatus.php
  
  echo "--- Execução concluída. Aguardando $CHECK_INTERVAL_SECONDS segundos... ---"
  
  # Espera o tempo definido antes da próxima execução
  sleep $CHECK_INTERVAL_SECONDS
done
