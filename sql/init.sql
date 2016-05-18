-- ユーザー情報のテーブル
CREATE TABLE IF NOT EXISTS users (
       id int NOT NULL AUTO_INCREMENT,
       username varchar(32) NOT NULL,   -- ユーザー名
       password varchar(60) NOT NULL,   -- パスワード
       is_admin boolean default false NOT NULL,  -- 管理者フラグ
       PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 管理者だけ最初に登録しておく
INSERT INTO bbs.users (username, password, is_admin) VALUES ("admin", "$2y$10$mXKZyxrlH6dgPBc3JrMppeme.NIrEV6rRNcbz.q8GUvXMbvBOFpb2", true);

-- BBS
CREATE TABLE IF NOT EXISTS bbs (
       id int NOT NULL AUTO_INCREMENT,
       username varchar(32) NOT NULL,  -- 投稿者の名前
       content TEXT NOT NULL,          -- 投稿する内容
       datetime DATETIME NOT NULL,     -- 投稿した時間
       PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
