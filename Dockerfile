FROM composer:latest

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

COPY jsonAuditToOutput.php /jsonAuditToOutput.php
COPY jsonOutdatedToOutput.php /jsonOutdatedToOutput.php
COPY jsonValidateToOutput.php /jsonValidateToOutput.php

ENTRYPOINT ["/entrypoint.sh"]