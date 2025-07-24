#!/bin/sh -l

sh -c "git config --global --add safe.directory $PWD"

if [[ -z "$1" || "$1" == "audit" ]]; then
    # composer $1 --format=json --no-scripts --no-plugins --no-interaction > composer-audit-output.json
    composer audit --format=json --no-scripts --no-plugins --no-interaction > composer-audit-output.json
    status=$?

    cat composer-audit-output.json

    php /jsonToOutput.php composer-audit-output.json >> $GITHUB_STEP_SUMMARY
fi

if [[ "$1" == "test" ]]; then
    # composer $1 --format=json --no-scripts --no-plugins --no-interaction > composer-audit-output.json
    composer audit --format=json --no-scripts --no-plugins --no-interaction > composer-audit-output.json
    status=$?

    cat composer-audit-output.json

    php /jsonToOutput.php composer-audit-output.json >> $GITHUB_STEP_SUMMARY
fi

exit $status;