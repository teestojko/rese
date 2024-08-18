FROM php:8.3.8-cli

# cronとその他の依存関係をインストールする
RUN apt-get update && apt-get install -y cron

# cronファイルをcron.dディレクトリにコピーする
COPY cron.root /etc/cron.d/cron.root

# cronジョブに実行権限を与える
RUN chmod 0644 /etc/cron.d/cron.root

# cronジョブを適用する
RUN crontab /etc/cron.d/cron.root

# tailコマンドを実行できるようにログファイルを作成する
RUN touch /var/log/cron.log

# コンテナの起動時にコマンドを実行する
CMD cron && tail -f /var/log/cron.log
