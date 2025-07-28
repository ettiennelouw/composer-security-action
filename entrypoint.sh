#!/bin/sh -l

sh -c "git config --global --add safe.directory $PWD"

if [[ -z "$1" || "$1" == "audit" ]]; then
    composer $1 --format=json --no-scripts --no-plugins --no-interaction > composer-audit-output.json
    # composer audit --format=json --no-scripts --no-plugins --no-interaction > composer-audit-output.json
    cat composer-audit-output.json
    php /jsonAuditToOutput.php composer-audit-output.json >> $GITHUB_STEP_SUMMARY
fi

if [[ "$1" == "outdated" ]]; then
    composer $1 --format=json --no-scripts --no-plugins --no-interaction > composer-audit-output.json
    cat composer-outdated-output.json
    php /jsonOutdatedToOutput.php composer-outdated-output.json >> $GITHUB_STEP_SUMMARY
fi

if [[ "$1" == "validate" ]]; then
    composer $1 --format=json --no-scripts --no-plugins --no-interaction > composer-audit-output.json
    cat composer-validate-output.json
    php /jsonValidateToOutput.php composer-validate-output.json >> $GITHUB_STEP_SUMMARY
fi

# exit $status;