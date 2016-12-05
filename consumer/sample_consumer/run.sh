#!/usr/bin/env bash

CONSOLE_COMMAND="console:command:name"

SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do
  TARGET="$(readlink "$SOURCE")"
  if [[ $TARGET == /* ]]; then
    SOURCE="$TARGET"
  else
    DIR="$( dirname "$SOURCE" )"
    SOURCE="$DIR/$TARGET"
  fi
done
DIR="$( cd -P "$( dirname "$SOURCE" )" && pwd )"

rabbitmq-cli-consumer -c "$DIR/consumer-config.conf" -e "php $DIR/../../app/console $CONSOLE_COMMAND --env=prod" -V --strict-exit-code