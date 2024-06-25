#!/bin/bash

cd "$(dirname "$0")"

docker-compose up -d --build

docker-compose exec app composer install

echo "Setup completed successfully! Your application is running on http://localhost:8000"

