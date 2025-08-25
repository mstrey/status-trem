# Usa uma imagem base PHP com CLI e Alpine para ser leve
FROM php:8.2-cli-alpine

# Define o diretório de trabalho dentro do container
WORKDIR /app

# Copia os arquivos do projeto para o diretório de trabalho no container
COPY . .

# Torna o script de execução principal executável
RUN chmod +x ./run.sh

# Comando padrão para iniciar o container, executando o script run.sh
CMD ["./run.sh"]
