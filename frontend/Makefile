.PHONY: build run

run: build
	docker run --rm -p 8080:80 frontend:latest

build:
	docker build . -t frondend:latest
