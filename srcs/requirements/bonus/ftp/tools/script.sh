#!/bin/bash

FTP_PWD=$(cat "$FTP_PWD_FILE")

mkdir -p /var/run/vsftpd/empty

if ! id "$FTP_USER" &>/dev/null; then
    adduser --home /home/$FTP_USER --disabled-password --gecos "" $FTP_USER
    echo "$FTP_USER:$FTP_PWD" | /usr/sbin/chpasswd
    echo "$FTP_USER" | tee -a /etc/vsftpd.userlist

    openssl req -x509 -nodes -newkey rsa:2048 \
    -keyout $FTP_KEY \
    -out $FTP_CERT \
    -subj "/C=FR/ST=IDF/L=Paris/O=42/CN=ftp.local" \
    -addext "subjectAltName = DNS:ftp.local,DNS:localhost"

    echo "
    ssl_enable=YES
    rsa_cert_file=$FTP_CERT
    rsa_private_key_file=$FTP_KEY" >> /etc/vsftpd.conf

    usermod -aG www-data $FTP_USER
fi

exec /usr/sbin/vsftpd /etc/vsftpd.conf
