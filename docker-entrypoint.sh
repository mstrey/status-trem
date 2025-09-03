#!/bin/sh

if [ "$CHECK_INTERVAL_MINUTES" -lt 1 ]; then
  CHECK_INTERVAL_MINUTES=60
fi

CRON_FILE="/etc/crontabs/status"

echo "*/${CHECK_INTERVAL_MINUTES} * * * * statususer php /app/checkStatus.php > /proc/1/fd/1 2>/proc/1/fd/2" > "$CRON_FILE"

chmod 0644 "$CRON_FILE"

echo "Cron job agendado para rodar a cada ${CHECK_INTERVAL_MINUTES} minuto(s)."

# Executa o comando principal (crond -f para rodar em foreground)
exec "$@"
