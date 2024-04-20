#アプリケーション名
アプリケーション名:Rese（リーズ）
ある企業のグループ会社の飲食店予約サービスで、

## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたいため。

##アプリケーションURL

×

##機能一覧
会員登録　
ログイン　
ログアウト　
ユーザー情報取得　
ユーザー飲食店お気に入り一覧取得
ユーザー飲食店予約情報取得
飲食店一覧取得　
飲食店詳細取得　
飲食店お気に入り追加
飲食店お気に入り削除
飲食店予約情報追加
飲食店予約情報削除
エリアで検索する　
ジャンルで検索する　
店名で検索する　

予約変更機能 
評価機能　
バリデーション　
レスポンシブデザイン  
管理画面　
リマインダー
QRコード
決済機能
環境の切り分け

##使用技術(実行環境)
Laravel　8.83.27
CSS
HTML
Javascript

##テーブル設計

genres
+------------+---------------------+------+-----+---------+----------------+
| Field      | Type                | Null | Key | Default | Extra          |
+------------+---------------------+------+-----+---------+----------------+
| id         | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| image_path | varchar(255)        | YES  |     | NULL    |                |
| image_name | varchar(255)        | YES  |     | NULL    |                |
| name       | varchar(255)        | YES  |     | NULL    |                |
| created_at | timestamp           | YES  |     | NULL    |                |
| updated_at | timestamp           | YES  |     | NULL    |                |
+------------+---------------------+------+-----+---------+----------------+


favorite_restaurants
+---------------+---------------------+------+-----+---------+----------------+
| Field         | Type                | Null | Key | Default | Extra          |
+---------------+---------------------+------+-----+---------+----------------+
| id            | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| user_id       | bigint(20) unsigned | NO   | MUL | NULL    |                |
| restaurant_id | bigint(20) unsigned | NO   | MUL | NULL    |                |
| created_at    | timestamp           | YES  |     | NULL    |                |
| updated_at    | timestamp           | YES  |     | NULL    |                |
+---------------+---------------------+------+-----+---------+----------------+

managers
+---------------+---------------------+------+-----+---------+----------------+
| Field         | Type                | Null | Key | Default | Extra          |
+---------------+---------------------+------+-----+---------+----------------+
| id            | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| user_id       | bigint(20) unsigned | NO   | MUL | NULL    |                |
| restaurant_id | bigint(20) unsigned | NO   | MUL | NULL    |                |
| created_at    | timestamp           | YES  |     | NULL    |                |
| updated_at    | timestamp           | YES  |     | NULL    |                |
+---------------+---------------------+------+-----+---------+----------------+

reservations
+------------------+---------------------+------+-----+---------+----------------+
| Field            | Type                | Null | Key | Default | Extra          |
+------------------+---------------------+------+-----+---------+----------------+
| id               | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| user_id          | bigint(20) unsigned | NO   | MUL | NULL    |                |
| restaurant_id    | bigint(20) unsigned | NO   | MUL | NULL    |                |
| reservation_date | date                | NO   |     | NULL    |                |
| reservation_time | time                | NO   |     | NULL    |                |
| number           | int(11)             | NO   |     | NULL    |                |
| qr_code          | varchar(100)        | YES  |     | NULL    |                |
| rating           | tinyint(4)          | YES  |     | NULL    |                |
| comment          | text                | YES  |     | NULL    |                |
| created_at       | timestamp           | YES  |     | NULL    |                |
| updated_at       | timestamp           | YES  |     | NULL    |                |
+------------------+---------------------+------+-----+---------+----------------+

super_admins
+-------------------+---------------------+------+-----+---------+----------------+
| Field             | Type                | Null | Key | Default | Extra          |
+-------------------+---------------------+------+-----+---------+----------------+
| id                | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name              | varchar(255)        | NO   |     | NULL    |                |
| email             | varchar(255)        | NO   | UNI | NULL    |                |
| email_verified_at | timestamp           | YES  |     | NULL    |                |
| password          | varchar(255)        | NO   |     | NULL    |                |
| remember_token    | varchar(100)        | YES  |     | NULL    |                |
| created_at        | timestamp           | YES  |     | NULL    |                |
| updated_at        | timestamp           | YES  |     | NULL    |                |
+-------------------+---------------------+------+-----+---------+----------------+

restaurants
+------------+---------------------+------+-----+---------+----------------+
| Field      | Type                | Null | Key | Default | Extra          |
+------------+---------------------+------+-----+---------+----------------+
| id         | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name       | varchar(255)        | YES  |     | NULL    |                |
| area       | varchar(255)        | YES  |     | NULL    |                |
| outline    | text                | YES  |     | NULL    |                |
| genre_id   | bigint(20) unsigned | YES  | MUL | NULL    |                |
| created_at | timestamp           | YES  |     | NULL    |                |
| updated_at | timestamp           | YES  |     | NULL    |                |
+------------+---------------------+------+-----+---------+----------------+

users
+---------------------------+---------------------+------+-----+---------+----------------+
| Field                     | Type                | Null | Key | Default | Extra          |
+---------------------------+---------------------+------+-----+---------+----------------+
| id                        | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name                      | varchar(255)        | NO   |     | NULL    |                |
| email                     | varchar(255)        | NO   | UNI | NULL    |                |
| email_verified_at         | timestamp           | YES  |     | NULL    |                |
| password                  | varchar(255)        | NO   |     | NULL    |                |
| two_factor_secret         | text                | YES  |     | NULL    |                |
| two_factor_recovery_codes | text                | YES  |     | NULL    |                |
| two_factor_confirmed_at   | timestamp           | YES  |     | NULL    |                |
| remember_token            | varchar(100)        | YES  |     | NULL    |                |
| created_at                | timestamp           | YES  |     | NULL    |                |
| updated_at                | timestamp           | YES  |     | NULL    |                |
+---------------------------+---------------------+------+-----+---------+----------------+

## ER図

