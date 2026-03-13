<?php
$port = getenv('PORT') ?: 8000;
echo "Starting PHP server on port $port...\n";
exec("php -S 0.0.0.0:$port -t public");
