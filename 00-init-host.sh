#!/bin/bash

# Enable sudo without password

if sudo grep -q "${USER}" /etc/sudoers; then
    echo ""
else
   echo "$USER ALL=(ALL:ALL) NOPASSWD: ALL" | sudo tee --append /etc/sudoers > /dev/null
fi

sudo apt update 

# Install basic packages
sudo apt-get install curl git  -y

#===============================================================================
#                   Install docker
#===============================================================================
echo "Install docker"

if [ -x "$(command -v docker)" ]; then
    echo  "Docker has been installed. Skip"
else
    # Docker
    wget -qO- https://get.docker.com/ | sh
    sudo usermod -aG docker $USER
    newgrp docker
    sudo update-rc.d docker defaults
    echo 'Waiting for Docker to start...'

sleep 3
fi

#===============================================================================
#                   Install compose
#===============================================================================
echo "Install docker compose"
if [ -x "$(command -v docker-compose)" ]; then
    echo  "Docker compose has been installed. Skip"
else
    COMPOSE_VERSION=`git ls-remote https://github.com/docker/compose | grep refs/tags | grep -oP "[0-9]+\.[0-9][0-9]+\.[0-9]+$" | tail -n 1`
    sudo sh -c "curl -L https://github.com/docker/compose/releases/download/${COMPOSE_VERSION}/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose"
    sudo chmod +x /usr/local/bin/docker-compose
    sudo sh -c "curl -L https://raw.githubusercontent.com/docker/compose/${COMPOSE_VERSION}/contrib/completion/bash/docker-compose > /etc/bash_completion.d/docker-compose"
    echo 'Docker Compose has been installed successfully'
fi
