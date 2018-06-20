#!/bin/bash

while : ; do
  if [ "$(php ../artisan db:is-available)" = "true" ]; then
    break 
  fi
  
  echo "MySql is unavailable - sleeping"
  sleep 1
done

echo "MySql is up"