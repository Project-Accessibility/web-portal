#!/bin/sh

# Abort on any error (including if wait-for-it fails).
set -e

# Wait for the backend to be up, if we know where it is.
if [ -n "mysql" ]; then
  ./wait-for-it.sh "mysql:3306" -t 120
fi

# Run the main container command.
exec "$@"

