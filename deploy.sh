#!/bin/bash

set -e

ssh 51.178.29.136 "sudo su - www-dieterenzoetrouwen;cd /home/www-dieterenzoetrouwen/web; bash ./build.sh"

exit