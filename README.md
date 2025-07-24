# Composer Security

## Composer Audit

```yaml
jobs:
  composer-security:
    runs-on: ubuntu-latest
    name: Composer audit
    steps:
      - name: "Checkout code"
        uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          coverage: "none"
          php-version: 8.2
          tools: composer:v2

      - name: "Composer install"
        uses: "ramsey/composer-install@2.2.0"
        with:
          composer-options: "--prefer-dist"

      - name: Run composer security
        uses: ../
        with:
            attribute: audit # Default (Optional)
```