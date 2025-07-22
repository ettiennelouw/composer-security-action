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

      - name: Install PHP with extensions
        uses: shivammathur/setup-php@2.26.0
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
            action: audit # Default (Optional)
```