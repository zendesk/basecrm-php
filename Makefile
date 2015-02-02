.PHONY: docs dist

docs:
	phpdoc run -d src/ -t docs

test:
	vendor/bin/phpunit

dist:
	@echo "<?php\nnamespace BaseCrm;\n" > dist/basecrm.php && cat src/Response.php src/Scope.php src/Client.php | grep -E "^(namespace|use|<\?php)" -i -v >> dist/basecrm.php
