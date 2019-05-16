-- データベース作成
DROP DATABASE IF EXISTS calorie_mate_db;
CREATE DATABASE calorie_mate_db DEFAULT CHARACTER SET utf8;


-- デフォルトDB指定
USE calorie_mate_db;

SET AUTOCOMMIT=1;

DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS company;


-- mountainテーブル作成
CREATE TABLE IF NOT EXISTS company (
  `company_id` INT AUTO_INCREMENT PRIMARY KEY,
  `company_name` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS student (
  `student_id` INT AUTO_INCREMENT PRIMARY KEY,
  `name_kanji` VARCHAR(50),
  `name_kana` VARCHAR(50),
  `company_id` INT,
  FOREIGN KEY(company_id) REFERENCES company(company_id)
);



-- company_studentテーブルデータインサート
INSERT INTO company (company_id, company_name) VALUES (1, '株式会社コアテック');
INSERT INTO student (student_id, name_kanji, name_kana, company_id) VALUES (1,'吉村　竜之介', 'よしむら　りゅうのすけ', 1);

INSERT INTO company (company_id, company_name) VALUES (2 ,'株式会社エフ.ティ.スクエア');
INSERT INTO student (student_id, name_kanji, name_kana, company_id) VALUES (2,'板山　凌','いたやま　りょう',2);

INSERT INTO company (company_id, company_name) VALUES ( 3,'株式会社コアソフト' );
INSERT INTO student (student_id, name_kanji, name_kana, company_id) VALUES ( 3,'関　修吾' ,'せき　しゅうご' ,3);

INSERT INTO company (company_id, company_name) VALUES ( 4,'ダイナテック株式会社' );
INSERT INTO student (student_id, name_kanji, name_kana, company_id) VALUES ( 4, '室岡　佑美', 'むろおか　ゆみ' ,4);

INSERT INTO company (company_id, company_name) VALUES (1 ,'株式会社コアテック' );
INSERT INTO student (student_id, name_kanji, name_kana, company_id) VALUES (5 , '余　婉慈','よ　えんじ' ,1);


SELECT * FROM student;
SELECT * FROM company;
