# Usa uma imagem base PHP com CLI e Alpine para ser leve
FROM php:8.2-cli-alpine

# Instala busybox-suid, que inclui o crond para agendamento de tarefas
RUN apk add --no-cache busybox-suid

# Define o diretório de trabalho dentro do container
WORKDIR /app

# Copia todos os arquivos do projeto para o diretório de trabalho
COPY . .

# Copia o script de entrada e o torna executável
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Define o ponto de entrada do container. Este script cria o cron job.
ENTRYPOINT ["docker-entrypoint.sh"]

# Comando principal para o container: roda o cron em modo foreground
CMD ["crond", "-f"]
