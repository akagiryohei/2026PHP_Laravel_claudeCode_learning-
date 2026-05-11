#!/bin/bash
set -e

echo "=== Step 1: Docker インストール ==="
sudo apt-get update -q
sudo apt-get install -y ca-certificates curl gnupg

sudo install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
sudo chmod a+r /etc/apt/keyrings/docker.gpg

echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

sudo apt-get update -q
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-compose-plugin

echo "=== Step 2: dockerグループにユーザーを追加 ==="
sudo usermod -aG docker $USER

echo "=== Step 3: PHP / Composer インストール ==="
sudo apt-get install -y php8.1 php8.1-cli php8.1-mbstring php8.1-xml php8.1-curl php8.1-zip php8.1-mysql unzip

curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

echo "=== Step 4: Laravelプロジェクト作成 ==="
cd /home/ubuntu/projects/my-app
composer create-project laravel/laravel task-app

echo ""
echo "=============================="
echo " セットアップ完了！"
echo "=============================="
echo ""
echo "次のコマンドを実行してください:"
echo "  cd /home/ubuntu/projects/my-app/task-app"
echo "  php artisan serve"
