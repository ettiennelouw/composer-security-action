FROM composer:latest

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

COPY jsonToOutput.php /jsonToOutput.php

ENTRYPOINT ["/entrypoint.sh"]