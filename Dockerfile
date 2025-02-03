FROM node:18-alpine 

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .

RUN apt-get update && apt-get install -y libssl1.0-dev

RUN npm run build