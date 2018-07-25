FROM alpine:3.6

MAINTAINER: 'Laurent BERTON <lolosambo2@gmail.com>'

RUN apk add --no-cache varnish

COPY conf/default.vcl /etc/varnish/default.vcl
COPY ./start.sh /usr/local/bin/docker-app-start

RUN chmod +x /usr/local/bin/docker-app-start

EXPOSE 80

CMD ["docker-app-start"]
