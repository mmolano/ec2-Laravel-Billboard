# Special Medico モラノ ルイス・ミゲル　|　開発テスト

<table>
<tr>
<td>
  開発者：Luis Miguel Molano
</td>
</tr>
</table>

## Framework

- ![Laravel](https://img.shields.io/badge/laravel-16181D.svg?style=for-the-badge&logo=laravel&logoColor=#191A1A)

## Dependencies

- Tailwind: https://tailwindcss.com/
- Alpine: https://alpinejs.dev/
- Livewire: https://laravel-livewire.com/

## Node & Php
- "node": "^v17"
- "php": "^8.0.2"

EC2ユーザーのSSHターミナルから、次のコマンドを使用して変更できます。

```bash
$ sudo su

# ec2-userとRootはnvmを利用できるため、Nodeを変更できます。
$ nvm use 17
```

## Setup

```bash

# envがない場合
$ cp .env.example .env

# composerをインストールします
$ composer install

$ php artisan key:generate

# データベースを作成します
$ php artisan migrate

# データを追加でき、作成されたすべてのユーザーのパスワードは "Test123"です
$ php artisan db:seed

# CommentControllerの単純なテストがあり、次のようにテストができます
$ php artisan test

# npmをインストールします
$ npm i

# BuildBuildフォルダに生成します
$ npm run build

# Laravel RedisまたはAmazon SESを使用していないため、メールシステムを利用する場合はQueue workerを起動する必要があります。
$ php artisan queue:work

```
## Env

```bash

# メールにはQueueシステムを使用しているため、メーラー（mailtrap）を設定する必要があります。
$ MAIL_MAILER=
$ MAIL_HOST=
$ MAIL_PORT=
$ MAIL_USERNAME=
$ MAIL_PASSWORD=
$ MAIL_ENCRYPTION=

# Databaseを設定必要があります (Amazon RDS)
$ DB_CONNECTION=mysql
$ DB_HOST=
$ DB_PORT=
$ DB_DATABASE=examLaravel
$ DB_USERNAME=
$ DB_PASSWORD=

```



