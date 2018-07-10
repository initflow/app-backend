#!/usr/bin/env bash
FUNCTION=
if [ ! -z $1 ]; then
    FUNCTION="$1"
fi

platform='unknown'
unmaster=`uname`

if [[ $unmaster == 'Linux' ]]; then
   platform='linux'
elif [[ $unmaster == 'MINGW64_NT-10.0' ]]; then
    platform='windows'
elif [[ $unmaster == 'Darwin' ]]; then
   platform='mac'
fi




show-help() {
    echo 'Functions:'
    echo './app.sh [start] [stop] [restart] [build]'
}

start() {
    
    echo 'Stop all containert'
    docker stop $(docker ps -a -q)
    echo ''
    echo 'Start containers'
    docker-compose up -d
    echo ''
}

stop() {
    echo 'Stop all containert'
    docker stop $(docker ps -a -q)
}

restart() {
    start
}


build() {
    echo 'Build containers'
   docker-compose build --no-cache app
}


case "$1" in
-h|--help)
    show-help
    ;;
*)
    if [ ! -z $(type -t $FUNCTION | grep function) ]; then
        $1
    else
        show-help
    fi
esac
