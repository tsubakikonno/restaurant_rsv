# ベースイメージを指定
FROM php:8.0-apache

# 追加のパッケージやツールのインストールなど、必要な設定を行う
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

# プロジェクトのファイルをコンテナ内にコピーする
COPY . /var/www/html

# コンテナがリッスンするポートを指定
EXPOSE 80
