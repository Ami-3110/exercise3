# exercise3

git clone git@github.com:Ami-3110/exercise3.git

DockerDesktopアプリを立ち上げる。
docker-compose up -d --build
MacのM３チップのPCの場合、no matching manifest for linux/arm64/v8 in the manifest list entriesのメッセージが表示されビルドができないことがあります。 エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください。

mysql:
    image: mysql:8.0.26
    platform: linux/x86_64(この文追加)
    environment:

Laravel環境構築
docker-compose exec php bash
composer install
「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
.envに以下の環境変数を修正
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

アプリケーションキーの作成
php artisan key:generate
マイグレーションの実行
php artisan migrate
シーディングの実行
php artisan db:seed
シンボリックリンクの作成
php artisan storage:link