<?php

renderFlavoredMarkdown($argv[1]);

function renderFlavoredMarkdown(string $filename): void
{
    $json = file_get_contents($filename);
    $data = json_decode($json, true);

    echo renderAdvisories($data['advisories']);
}

/**
 * @param array<string, array<array{name: string, direct-dependency: boolean, homepage: ?string, source: string, version: string, release-age: string, release-date: string, latest: string, latest-status: string, latest-release-date: string, description: string, abandoned: bool}>> $advisories
 * @return string
 */
function renderAdvisories(array $advisories): string
{
    $output = <<<MARKDOWN
## :exclamation: :exclamation: Outdated Security Vulnerabilities

MARKDOWN;

    if (empty($advisories)) {
        $output .= 'No outdated vulnerability advisories found.';
        return $output;
    }

    $output .= <<<MARKDOWN
| Package | Version | Release Age | Latest | Status | Abandoned |
| ------- | ------- | ----------- | ------ | ------ | --------- |
MARKDOWN;

    foreach ($advisories as $issues) {
        foreach ($issues as $issue) {
            $output .= sprintf(
                "\n| %s | %s |",
                $issue['name'],
                $issue['version'],
                $issue['release-age'],
                $issue['latest'],
                $issue['latest-status'],
                $issue['abandoned'] ? 'Yes' : 'No'
            );
        }
    }

    return $output;
}