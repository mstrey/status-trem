#!/bin/sh

# Valida se o intervalo é pelo menos 1 minuto. Se for menor, define para 1.
if [ "$CHECK_INTERVAL_MINUTES" -lt 1 ]; then
  CHECK_INTERVAL_MINUTES=1
fi

# Cria o arquivo de configuração do cron
CRON_FILE="/etc/cron.d/transporte-status"
echo "*/${CHECK_INTERVAL_MINUTES} * * * * root php /app/checkStatus.php > /proc/1/fd/1 2>/proc/1/fd/2" > "$CRON_FILE"

# Garante que o arquivo cron tenha as permissões corretas
chmod 0644 "$CRON_FILE"

echo "Cron job agendado para rodar a cada ${CHECK_INTERVAL_MINUTES} minuto(s)."

# Executa o comando principal (crond -f para rodar em foreground)
exec "$@"
