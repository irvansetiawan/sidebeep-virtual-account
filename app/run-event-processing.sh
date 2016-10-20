#!/usr/bin/env bash

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

rabbitmq-cli-consumer -c "$DIR/../rabbitmq-cli-consumer.conf" -e "$DIR/console service:event:processing --env=prod" -V