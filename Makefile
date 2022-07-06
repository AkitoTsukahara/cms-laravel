help:  ## sailコマンドのhelp
	./vendor/bin/sail help

up:  ## 開発環境の立ち上げ
	./vendor/bin/sail up -d

down:  ## 開発環境を落とす
	./vendor/bin/sail down

test:  ## テストを実行する
	./vendor/bin/sail test

shell:  ## dockerのapp操作
	./vendor/bin/sail shell

mysql:  ## dockerのdb操作
	./vendor/bin/sail mysql

composer:  ## dockerのdb操作
	./vendor/bin/sail composer install

mysql:  ## dockerのdb操作
	./vendor/bin/sail mysql
