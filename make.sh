#!/bin/bash

set -e

if test ! -e ./.env -a ! -L ./.env; then
  echo "Copying the docker config .env"
  cp -f ./.env.dist ./.env
fi

if test ! -e ./api/.env -a ! -L ./api/.env; then
  echo "Copying the application config .env"
  cp -f ./api/.env.dist ./api/.env
fi

docker-compose up -d