<?php

renderFlavoredMarkdown($argv[1]);

function renderFlavoredMarkdown(string $filename): void
{
    $json = file_get_contents($filename);
    $data = json_decode($json, true);

    echo renderInstalled($data['installed']);
}

/**
 * @param array<string, array<array{name: string, direct-dependency: boolean, homepage: ?string, source: string, version: string, release-age: string, release-date: string, latest: string, latest-status: string, latest-release-date: string, description: string, abandoned: bool}>> $advisories
 * @return string
 */
function renderInstalled(array $installed): string
{
    $output = <<<MARKDOWN
## :warning: Outdated Packages with Updates

MARKDOWN;

    if (empty($installed)) {
        $output .= 'No outdated advisories found.';
        return $output;
    }

    $output .= <<<MARKDOWN
| Package | Direct | Version | Release Age | Latest | Latest Release Date | Status | Abandoned |
| ------- | ------ |-------- | ----------- | ------ | ------------------- | ------ | --------- |
MARKDOWN;

    foreach ($installed as $issue) {
        $output .= sprintf(
            "\n| %s | %s | %s | %s | %s | %s | %s | %s |",
            $issue['name'],
            $issue['direct-dependency'] ? 'Yes' : 'No',
            $issue['version'],
            $issue['release-age'],
            $issue['latest'],
            DateTime::createFromFormat(DATE_ATOM, $issue['latest-release-date'])->format('Y-m-d H:i:s'),
            $issue['latest-status'],
            $issue['abandoned'] ? ':exclamation: Yes' : 'No'
        );
    }

    return $output;
}