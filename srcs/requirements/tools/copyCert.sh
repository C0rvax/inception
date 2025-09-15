#!/bin/bash

HOST_TRUST_DIR=/usr/local/share/ca-certificates/
FTP_CERT=/etc/ssl/private/ftp.crt
FTP_LOCAL=ftp.local.crt

sudo mkdir -p "$HOST_TRUST_DIR"

rm -f $FTP_LOCAL

docker cp ftp:$FTP_CERT $FTP_LOCAL
if [ -f $FTP_LOCAL ]; then
	sudo cp $FTP_LOCAL "${HOST_TRUST_DIR}$FTP_LOCAL"
	if [ $? -eq 0 ]; then
		sudo update-ca-certificates
	fi
	rm -f $FTP_LOCAL
fi
