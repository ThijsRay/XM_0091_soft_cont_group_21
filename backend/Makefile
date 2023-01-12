.PHONY: build run

run: build
	docker run --rm -p 8081:80 backend:latest

build:
	docker build . -t backend:latest
