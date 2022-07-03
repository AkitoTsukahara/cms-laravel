help:  ## sailコマンドのhelp
	./vendor/bin/sail help

up:  ## 開発環境の立ち上げ
	./vendor/bin/sail up -d

down:  ## 開発環境を落とす
	./vendor/bin/sail down

test:  ## テストを実行する
	./vendor/bin/sail test



up:  ## 開発環境の立ち上げ
	docker-compose up -d

down:  ## 開発環境を落とす
	docker-compose down

test:  ## テストを実行する
	./vendor/bin/sail test
