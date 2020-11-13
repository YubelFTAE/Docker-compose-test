#!/bin/bash
SOURCE_CODE_DIR=$PWD/src

mkdir -p ${SOURCE_CODE_DIR}

MICROSERVICES=(
    "bom_api"
    "vt_manager_bom"
)

DOMAINS=(
    "kientnbn"
    "bachbanhbao"
)

# Default is development
GITHUB_BRANCH=master
#===============================================================================
#                GIT PROTOCOL SELECTION
#===============================================================================
GIT_AUTH_PROTOCOL="git@github.com:"
#===============================================================================
#                   Clone all source code
#===============================================================================
echo "Clone all microservices source code"
cd ${SOURCE_CODE_DIR}
USE_HTTPS=true

# Get git user name and password
if [ "${USE_HTTPS}" = true ]; then

    echo "Security note: Your Github credential will be stored on each cloned repo at .git/config"
    echo "Security note: Please keep your workstation safe from unauthorized access"
    echo "Security note: Please change your github password after your work are done"

    read -p 'Github username: ' GIT_USERNAME
    read -sp 'Github password: ' GIT_PASSWORD
    GIT_AUTH_PROTOCOL="https://${GIT_USERNAME}:${GIT_PASSWORD}@github.com/"

else
    GIT_AUTH_PROTOCOL="git@github.com:"
fi

NUMBER_OF_SERVICE=${#MICROSERVICES[@]}

for ((i = 0; i < ${NUMBER_OF_SERVICE}; i++)); do
    SERVICE=${MICROSERVICES[$i]}
    DOMMAIN=${DOMAINS[$i]}

    GIT_URL=${GIT_AUTH_PROTOCOL}${DOMMAIN}/${SERVICE}.git

    if [ ! -d $SERVICE ]; then
        git clone ${GIT_URL} $SERVICE
    else
        cd $SERVICE
#        git pull ${GIT_URL}
        git pull
        git checkout $GITHUB_BRANCH
    fi

    CURRENT_COMMIT_ID=$(git show HEAD | sed -n 1p | cut -d " " -f 2)
    echo "Clone $SERVICE completed with current commit ID = ${CURRENT_COMMIT_ID}"
done
