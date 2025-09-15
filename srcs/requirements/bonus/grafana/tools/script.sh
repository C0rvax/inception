#!/bin/bash

export GF_SECURITY_ADMIN_PASSWORD=$(cat "$GF_SECURITY_ADMIN_PASSWORD__FILE")
export GF_DATABASE_PASSWORD=$(cat "$GF_DATABASE_PASSWORD__FILE")

exec /usr/share/grafana/bin/grafana-server --homepath=/usr/share/grafana
