<?php

renderFlavoredMarkdown($argv[1]);

function renderFlavoredMarkdown(string $filename): void
{
    $data = file_get_contents($filename);

    echo renderValiditiers($data);
}

/**
 * @param $data<string>
 * @return string
 */
function renderValiditiers($data): string
{
    $output = <<<MARKDOWN
## :warning: Validate composer.json & composer.lock

MARKDOWN;

    if (empty($data)) {
        $output .= 'No validation advisories found.';
        return $output;
    }

    $output .= <<<MARKDOWN
$data
MARKDOWN;

    return $output;
}