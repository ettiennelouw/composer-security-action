FROM composer:latest

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

COPY jsonAuditToOutput.php /jsonAuditToOutput.php
COPY jsonOutdatedToOutput.php /jsonOutdatedToOutput.php

ENTRYPOINT ["/entrypoint.sh"]