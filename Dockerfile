FROM mojdigital/wordpress-base:latest

ADD . /bedrock

WORKDIR /bedrock

ARG COMPOSER_USER
ARG COMPOSER_PASS

RUN chmod +x build.sh && \
	sleep 1 && \
	./build.sh
