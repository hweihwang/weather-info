FROM node:alpine AS build

WORKDIR /app

COPY /frontend/package.json /frontend/package-lock.json ./

RUN npm install

COPY /frontend/ ./

RUN npm run build-only

FROM node:alpine

WORKDIR /app

COPY --from=build /app/dist /app/dist

RUN npm install -g serve

CMD serve -s /app/dist
